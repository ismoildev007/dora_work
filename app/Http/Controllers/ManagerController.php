<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $this->authorize('viewAny', Manager::class);

        $managers = Manager::all();
        return view('admin.managers.index', compact('managers'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $this->authorize('create', Manager::class);

        $departments = Department::all();
        $users = User::where('role', 'manager')->get();
        return view('admin.managers.create', compact('departments', 'users'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $this->authorize('create', Manager::class);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'position' => 'required|string|max:20',
        ]);

        Manager::create($request->all());

        return redirect()->route('managers.index')->with('success', 'Manager created successfully.');
    }

    // Show the form for editing the specified resource.
    public function edit(Manager $manager)
    {
        $this->authorize('update', $manager);

        $departments = Department::all();
        $users = User::where('role', 'manager')->get();
        return view('admin.managers.edit', compact('manager', 'departments', 'users'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Manager $manager)
    {
        $this->authorize('update', $manager);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'position' => 'required|string|max:20',
        ]);

        $manager->update($request->all());

        return redirect()->route('managers.index')->with('success', 'Manager updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Manager $manager)
    {
        $this->authorize('delete', $manager);
        $manager->delete();

        return redirect()->route('managers.index')->with('success', 'Manager deleted successfully.');
    }
}