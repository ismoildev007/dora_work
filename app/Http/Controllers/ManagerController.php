<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    // Display a listing of the managers
    public function index()
    {
        $managers = Manager::all();
        return view('admin.managers.index', compact('managers'));
    }

    // Show the form for creating a new manager
    public function create()
    {
        $users = User::all(); // Fetch users for the user_id dropdown
        return view('admin.managers.create', compact('users'));
    }

    // Store a newly created manager in storage
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'department' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        Manager::create($request->all());
        return redirect()->route('managers.index')->with('success', 'Manager created successfully.');
    }

    // Display the specified manager
    public function show(Manager $manager)
    {
        return view('admin.managers.show', compact('manager'));
    }

    // Show the form for editing the specified manager
    public function edit(Manager $manager)
    {
        $users = User::all(); // Fetch users for the user_id dropdown
        return view('admin.managers.edit', compact('manager', 'users'));
    }

    // Update the specified manager in storage
    public function update(Request $request, Manager $manager)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'department' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $manager->update($request->all());
        return redirect()->route('managers.index')->with('success', 'Manager updated successfully.');
    }

    // Remove the specified manager from storage
    public function destroy(Manager $manager)
    {
        $manager->delete();
        return redirect()->route('managers.index')->with('success', 'Manager deleted successfully.');
    }
}
