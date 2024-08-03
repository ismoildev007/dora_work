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



    public function edit(Transaction $transaction)
    {
        // Edit modal uchun ma'lumotlarni ko'rsatadi
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'agreement_id' => 'required|exists:agreements,id',
            'profit' => 'required|numeric'
        ]);

        // Avvalgi barcha to'lovlarni olish (yangi to'lovdan tashqari)
        $totalProfit = Transaction::where('agreement_id', $request->agreement_id)
            ->where('id', '!=', $transaction->id)
            ->sum('profit');

        // Yangi to'lovni qo'shish
        $newProfit = $totalProfit + $request->profit;

        // Residualni hisoblash
        $agreement = Agreement::find($request->agreement_id);
        $residual = $agreement->price - $newProfit;

        $transaction->update([
            'agreement_id' => $request->agreement_id,
            'residual' => $residual,
            'profit' => $request->profit
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}