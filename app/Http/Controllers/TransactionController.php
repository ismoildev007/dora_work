<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Agreement;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('agreement')->get(); // Agreement bilan birga olish
        $agreements = Agreement::all(); // Create va Edit formalar uchun agreements
        return view('admin.transactions.index', compact('transactions', 'agreements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'agreement_id' => 'required|exists:agreements,id',
            'profit' => 'required|numeric'
        ]);

        $agreement = Agreement::find($request->agreement_id);

        // Avvalgi barcha to'lovlarni olish
        $totalProfit = Transaction::where('agreement_id', $request->agreement_id)->sum('profit');

        // Yangi to'lovni qo'shish
        $newTotalProfit = $totalProfit + $request->profit;

        // Residualni hisoblash
        $residual = $agreement->price - $newTotalProfit;

        // Mavjud transaksiyani topish yoki yangi yaratish
        $transaction = Transaction::updateOrCreate(
            ['agreement_id' => $request->agreement_id], // Shart: agar mavjud bo'lsa
            [
                'residual' => $residual,
                'profit' => $newTotalProfit // Jami profitni yangilash
            ]
        );

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }



    public function edit($id)
    {
        $transaction = Transaction::with('agreement')->findOrFail($id);
        return response()->json([
            'id' => $transaction->id,
            'agreement_id' => $transaction->agreement_id,
            'service_name' => $transaction->agreement->service_name,
            'profit' => $transaction->profit
        ]);
    }



    public function update(Request $request, $id)
    {
        dd($request->all());
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['error' => 'Transaction not found'], 404);
        }

        // Validate the incoming data
        $request->validate([
            'profit' => 'required|numeric|min:0',
            // Add other validation rules if necessary
        ]);

        // Update the transaction
        $transaction->profit = $request->input('profit');
        $transaction->agreement_id = $request->input('agreement_id');
        $transaction->save();

        return response()->json(['success' => true]);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}