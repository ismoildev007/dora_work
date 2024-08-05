<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\Project;
use Illuminate\Http\Request;

class AgreementController extends Controller
{
    public function index()
    {
        $agreements = Agreement::with('project')->get();
        return view('admin.agreements.index', compact('agreements'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('admin.agreements.create', compact('projects'));
    }

    public function store(Request $request)
    {
        // Validate the request if necessary
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'contract' => 'required|string',
            'price' => 'required|numeric',
            'service_name' => 'required|string',
            'service_type' => 'required|string',
        ]);

        // Create the agreement
        $agreement = Agreement::create($validated);

        return redirect()->route('projects.index')->with('success', 'Agreement created successfully.');
    }


    public function show(Agreement $agreement)
    {
        $agreement->load('project', 'transactions');
        return view('admin.agreements.show', compact('agreement'));
    }

    public function edit(Agreement $agreement)
    {
        return response()->json($agreement);
    }

    public function update(Request $request, Agreement $agreement)
    {
        $request->validate([
            'contract' => 'required',
            'price' => 'required|numeric',
            'service_name' => 'required',
            'service_type' => 'required',
        ]);

        $agreement->update($request->all());
        return redirect()->route('projects.edit', $agreement->project_id)->with('success', 'Agreement updated successfully.');
    }

    public function destroy(Agreement $agreement)
    {
        $agreement->delete();
        return redirect()->route('agreements.index')->with('success', 'Agreement deleted successfully.');
    }
}
