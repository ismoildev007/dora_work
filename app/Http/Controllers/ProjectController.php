<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Project;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('client', 'manager')->get();
        $clients = Client::all();
        $managers = Manager::all();
        return view('admin.projects.index', compact('projects', 'clients', 'managers'));
    }

    public function create()
    {
        $clients = Client::all();
        $managers = User::where('role', 'manager')->get();
        return view('admin.projects.create', compact('clients', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'project_status' => 'required',
            'payment_status' => 'required',
            'client_id' => 'required|exists:clients,id',
            'manager_id' => 'required|exists:users,id',
        ]);

        Project::create($request->all());
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $project->load('client', 'manager');
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $clients = Client::all();
        $managers = User::where('role', 'manager')->get();
        return view('admin.projects.edit', compact('project', 'clients', 'managers'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'project_status' => 'required',
            'payment_status' => 'required',
            'client_id' => 'required|exists:clients,id',
            'manager_id' => 'required|exists:users,id',
        ]);

        $project->update($request->all());
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
