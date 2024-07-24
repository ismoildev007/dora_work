<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login'); // This should point to your login view
    }

    // Handle login request
    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication was successful
            $user = Auth::user();

            // Redirect based on role
            switch ($user->role) {
                case 'manager':
                    return redirect()->route('manager.dashboard');
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'staff':
                    return redirect()->route('staff.dashboard');
                default:
                    Auth::logout(); // Logout the user if role is not recognized
                    return redirect()->route('login')->withErrors(['role' => 'Invalid role assigned to the user.']);
            }
        }

        // Authentication failed
        return redirect()->route('login')->withErrors(['email' => 'Invalid credentials.']);
    }

    // Logout the user
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // Manager dashboard
    public function managerDashboard()
    {
        return view('dashboards.manager'); // Points to the manager dashboard view
    }

    // Admin dashboard
    public function adminDashboard()
    {
        return view('dashboards.admin'); // Points to the admin dashboard view
    }

    // Staff dashboard
    public function staffDashboard()
    {
        return view('dashboards.staff'); // Points to the staff dashboard view
    }
}
