<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
use App\Models\Manager;
use App\Models\ProjectImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Agreement;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('client', 'manager')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $clients = Client::all();
        $managers = User::where('role', 'manager')->get();
        $agreements = Agreement::all();
        return view('admin.projects.create', compact('clients', 'managers', 'agreements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_inn' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_person' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'project_status' => 'required|in:completed,in_progress,on_hold,cancelled',
            'payment_status' => 'required|in:paid,partially_paid,unpaid',
            'agreement_id' => 'nullable|exists:agreements,id',
            'client_id' => 'nullable|exists:clients,id',
            'manager_id' => 'nullable|exists:users,id',
        ]);

        $project = Project::create($request->all());

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show($id)
    {
        $project = Project::with('client', 'manager', 'activities', 'images')->findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $clients = Client::all();
        $managers = User::where('role', 'manager')->get();
        $agreements = Agreement::all();
        return view('admin.projects.edit', compact('project', 'clients', 'managers', 'agreements'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'company_inn' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_person' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'project_status' => 'required|in:completed,in_progress,on_hold,cancelled',
            'payment_status' => 'required|in:paid,partially_paid,unpaid',
            'agreement_id' => 'nullable|exists:agreements,id',
            'client_id' => 'nullable|exists:clients,id',
            'manager_id' => 'nullable|exists:users,id',
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
