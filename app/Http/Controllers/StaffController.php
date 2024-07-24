<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $this->authorize('viewAny', Staff::class);

        $staffs = Staff::all();
        return view('admin.staff.index', compact('staffs'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $this->authorize('create', Staff::class);

        $managers = User::where('role', 'manager')->get();
        $users = User::where('role', 'staff')->get();
        return view('admin.staff.create', compact([
            'managers',
            'users'
        ]));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $this->authorize('create', Staff::class);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'manager_id' => 'nullable|exists:users,id',
            'position' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        Staff::create($request->all());

        return redirect()->route('staffs.index')->with('success', 'Staff created successfully.');
    }

    // Show the form for editing the specified resource.
    public function edit(Staff $staff)
    {
        $this->authorize('update', $staff);

        $managers = User::where('role', 'manager')->get();
        $users = User::where('role', 'staff');
        return view('admin.staff.edit', compact(
            'staff',
            'managers',
            'users'
        ));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Staff $staff)
    {
        $this->authorize('update', $staff);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'manager_id' => 'nullable|exists:users,id',
            'position' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $staff->update($request->all());

        return redirect()->route('staffs.index')->with('success', 'Staff updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Staff $staff)
    {
        $this->authorize('delete', $staff);
        $staff->delete();

        return redirect()->route('staffs.index')->with('success', 'Staff deleted successfully.');
    }
}
