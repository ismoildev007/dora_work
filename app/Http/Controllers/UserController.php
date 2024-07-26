<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        // Check if the user can view the list of users
        $this->authorize('viewAny', User::class);

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        // Check if the user can create a new user
        $this->authorize('create', User::class);

        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Check if the user can create a new user
        $this->authorize('create', User::class);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,manager,staff',
            'status' => 'nullable|string',
            'phone_number' => 'nullable|string',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        // Check if the user can view this user
        $this->authorize('view', $user);

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        // Check if the user can update this user
        $this->authorize('update', $user);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Check if the user can update this user
        $this->authorize('update', $user);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:admin,manager,staff',
            'status' => 'nullable|string',
            'phone_number' => 'nullable|string',
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Check if the user can delete this user
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
