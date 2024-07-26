<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Report;
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
    public function adminDashboard(Request $request)
{
    // Get the department_id and period from the request
    $departmentId = $request->input('department_id');
    $period = $request->input('period', 'monthly'); // Default to 'monthly'

    // Fetch all departments for the dropdown
    $departments = Department::all();

    // Determine the date range based on the selected period
    $endDate = now(); // Current date
    $startDate = clone $endDate; // Clone to calculate the start date

    switch ($period) {
        case 'quarterly':
            $startDate->subMonths(3); // Include current and last 2 months (total 3 months)
            break;
        case 'semi-annual':
            $startDate->subMonths(6); // Include current and last 5 months (total 6 months)
            break;
        case 'yearly':
            $startDate->subYear()->addMonth(); // Include the last 12 months, from the start of the current month last year
            break;
        default: // 'monthly'
            $startDate->subMonth(); // Last full month
            break;
    }

    // Fetch reports based on department filter and period
    $query = Report::whereBetween('date', [$startDate->startOfMonth(), $endDate->endOfMonth()]);

    if ($departmentId) {
        $query->where('department_id', $departmentId);
    }

    // Include the department name and order by date
    $reports = $query->with('department')->orderBy('date', 'asc')->get();

    // Fetch future targets from the reports table if they exist
    $futureDateEnd = $endDate->copy()->addMonths(3); // Look ahead 3 months
    $futureTargets = Report::whereBetween('date', [$endDate->format('Y-m-d'), $futureDateEnd->format('Y-m-d')])
        ->when($departmentId, function ($query) use ($departmentId) {
            return $query->where('department_id', $departmentId);
        })
        ->with('department')
        ->orderBy('date', 'desc')
        ->get();

    // Format report dates for display and include department name if not filtered by a specific department
    $reports->transform(function ($report) use ($departmentId) {
        $report->date = \Carbon\Carbon::parse($report->date)->format('F Y'); // Month name and year
        if (!$departmentId) {
            $report->department_name = $report->department->name;
        }
        return $report;
    });

    $futureTargets->transform(function ($report) use ($departmentId) {
        $report->date = \Carbon\Carbon::parse($report->date)->format('F Y'); // Month name and year
        if (!$departmentId) {
            $report->department_name = $report->department->name;
        }
        return $report;
    });

    return view('dashboards.admin', compact('reports', 'departments', 'period', 'departmentId', 'futureTargets')); // Ensure futureTargets is passed to the view
}

    





    // Staff dashboard
    public function staffDashboard()
    {
        return view('dashboards.staff'); // Points to the staff dashboard view
    }
}
