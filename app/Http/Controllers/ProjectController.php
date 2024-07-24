<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
use App\Models\Manager;
use App\Models\ProjectImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('admin.projects.create', compact('clients', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'client_id' => 'nullable|exists:clients,id',
            'manager_id' => 'nullable|exists:users,id',
            'status' => 'required|in:planned,active,completed,on_hold',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);


        $project = Project::create($request->all());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('project_images', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => $path,
                ]);
            }
        }

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
        return view('admin.projects.edit', compact('project', 'clients', 'managers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'client_id' => 'nullable|exists:clients,id',
            'manager_id' => 'nullable|exists:users,id',
            'status' => 'required|in:planned,active,completed,on_hold',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->all());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('project_images', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    public function destroyImage(ProjectImage $projectImage)
    {

        if (!is_null($projectImage->image)) {
            Storage::delete($projectImage->image);
            dd('salom');
        }
        $projectImage->delete();

        return back()->with('success', 'Image deleted successfully.');
    }

}
