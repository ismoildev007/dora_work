<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Agreement;

class TransactionController extends Controller
{
    public function index(Transaction $transaction)
    {
        $transactions = Transaction::with('agreement')->get(); // Agreement bilan birga olish
        $agreements = Agreement::all(); // Create va Edit formalar uchun agreements
        return view('admin.transactions.index', compact('transactions', 'agreements', 'transaction'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'agreement_id' => 'required|exists:agreements,id',
            'profit' => 'required|numeric|min:0',
        ]);

        $agreement = Agreement::find($request->agreement_id);

        // Fetch the total profit from existing transactions for the agreement
        $totalProfit = Transaction::where('agreement_id', $request->agreement_id)->sum('profit');

        // Calculate new total profit
        $newTotalProfit = $totalProfit + $request->profit;

        // Calculate residual
        $residual = $agreement->price - $newTotalProfit;

        // Validate profit does not exceed residual
        if ($request->profit > $residual) {
            return redirect()->back()->withErrors(['profit' => 'Kechirasiz, siz belgilangan qiymatdan ko\'p miqdorda pul kiritdingiz. To\'g\'ri summa kiriting.']);
        }


        // Update or create the transaction
        $transaction = Transaction::updateOrCreate(
            ['agreement_id' => $request->agreement_id], // Find by agreement_id
            [
                'residual' => $residual,
                'profit' => $request->profit // Update with the new profit value
            ]
        );

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}