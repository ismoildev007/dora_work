<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agreement;
use App\Models\Transaction;

class AgreementController extends Controller
{
    public function index()
    {
        $agreements = Agreement::all();
        return view('admin.agreements.index', compact('agreements'));
    }

    public function create()
    {
        return view('admin.agreements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'contract' => 'required|string|max:255',
            'price' => 'required|numeric',
            'service_name' => 'required|string|max:255',
            'service_type' => 'required|in:monthly,unit',
        ]);

        $agreement = Agreement::create($request->all());

        // Create a default transaction with profit and residual set to 0
        Transaction::create([
            'agreement_id' => $agreement->id,
            'profit' => 0,
            'residual' => 0
        ]);

        return redirect()->route('agreements.index')->with('success', 'Agreement created successfully.');
    }

    public function edit(Agreement $agreement)
    {
        return view('admin.agreements.edit', compact('agreement'));
    }

    public function update(Request $request, Agreement $agreement)
    {
        $request->validate([
            'contract' => 'required|string|max:255',
            'price' => 'required|numeric',
            'service_name' => 'required|string|max:255',
            'service_type' => 'required|in:monthly,unit',
        ]);

        $agreement->update($request->all());

        // Update residual and profit based on transactions
        $totalProfit = Transaction::where('agreement_id', $agreement->id)->sum('profit');
        $transaction = Transaction::where('agreement_id', $agreement->id)->first();
        $transaction->residual = $agreement->price - $totalProfit;
        $transaction->save();

        return redirect()->route('agreements.index')->with('success', 'Agreement updated successfully.');
    }

    public function destroy(Agreement $agreement)
    {
        $agreement->delete();
        return redirect()->route('agreements.index')->with('success', 'Agreement deleted successfully.');
    }
}