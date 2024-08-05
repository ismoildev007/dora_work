<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Agreement;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('agreement')->get();
        $agreements = Agreement::all();
        return view('admin.transactions.index', compact('transactions', 'agreements'));
    }

    public function store(Request $request)
    {
        $transactionId = $request->input('id');
        $newProfit = $request->input('profit');
        $agreementId = $request->input('agreement_id');

        $agreement = Agreement::find($agreementId);
        if (!$agreement) {
            return redirect()->route('transactions.index')->with('error', 'Agreement not found.');
        }

        if ($transactionId) {
            $transaction = Transaction::find($transactionId);
            if ($transaction) {
                $newTotalProfit = $transaction->profit + $newProfit;
                $newResidual = $agreement->price - $newTotalProfit;

                if ($newResidual < 0) {
                    return redirect()->route('transactions.index')->with('error', 'Siz belgilangan qiymatdan ko`p miqdorda pul kirtitishingiz mumkin emas');
                }

                $transaction->profit = $newTotalProfit;
                $transaction->residual = $newResidual;
                $transaction->save();
            }
        } else {
            $newResidual = $agreement->price - $newProfit;

            if ($newResidual < 0) {
                return redirect()->route('transactions.index')->with('error', 'Siz belgilangan qiymatdan ko`p miqdorda pul kirtitishingiz mumkin emas');
            }

            $transaction = new Transaction();
            $transaction->agreement_id = $agreementId;
            $transaction->profit = $newProfit;
            $transaction->residual = $newResidual;
            $transaction->save();
        }

        return redirect()->route('transactions.index')->with('success', 'To`lov muvoffaqiyatli amalga oshirildi');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'To`lov muvoffaqiyatli amalga oshirildi');
    }
}
