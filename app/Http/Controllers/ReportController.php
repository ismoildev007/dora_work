<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $departmentId = $request->input('department_id');
        $month = $request->input('month');
        $year = $request->input('year');

        // Fetch all departments for the dropdown
        $departments = Department::all();

        // Fetch distinct years for the dropdown
        $years = DB::table('reports')
            ->select(DB::raw('DISTINCT SUBSTR(date, 1, 4) as year')) // Extract year from YYYY-MM
            ->pluck('year')
            ->sortDesc(); // Optional: sort years in descending order

        // Fetch distinct months for the dropdown
        $months = DB::table('reports')
            ->select(DB::raw('DISTINCT SUBSTR(date, 6, 2) as month')) // Extract month from YYYY-MM
            ->pluck('month')
            ->sortDesc(); // Optional: sort months in descending order

        // Determine the date range based on the selected month and year
        $startDate = now()->startOfYear(); // Default to the start of the current year
        $endDate = now(); // Current date

        if ($year) {
            $startDate = Carbon::create($year, 1, 1);
            $endDate = Carbon::create($year, 12, 31);
        }

        if ($month) {
            $startDate = Carbon::create($year ?? now()->year, $month, 1);
            $endDate = $startDate->copy()->endOfMonth();
        }
        
        

        // Fetch reports based on department filter and date range
        $query = Report::whereBetween('date', [$startDate->format('Y-m'), $endDate->format('Y-m')]);

        if ($departmentId) {
            $query->where('department_id', $departmentId);
        }

        // Apply sorting
        $reports = $query->orderBy('date', 'desc')->get();
        // Format report dates for display
        $reports->transform(function ($report) {
            $report->date = Carbon::parse($report->date)->formatUzbekMonth();
            return $report;
        });


        return view('admin.reports.index', compact('reports', 'departments', 'years', 'months'));
    }


    public function create()
    {
        $departments = Department::all();
        return view('admin.reports.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'target' => 'required|numeric',
            'profit' => 'nullable|numeric',
            'outlay' => 'nullable|numeric',
            'date' => 'required|date_format:Y-m', // Faqat yil va oy
        ]);

        // Parse the date to check for existing reports in the same month
        $date = \Carbon\Carbon::parse($validated['date']);
        $formattedDate = $date->format('Y-m'); // Yil va oyni formatlash

        $exists = Report::where('department_id', $validated['department_id'])
            ->where('date', $formattedDate) // String sifatida tekshirish
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['date' => 'Bu oyda hisobot allaqachon kiritilgan. Iltimos, boshqa oyni tanlang.'])->withInput();
        }

        $validated['date'] = $formattedDate; // Formatlangan sanani saqlash

        Report::create($validated);

        return redirect()->route('reports.index')->with('success', 'Report created successfully.');
    }

    public function show(Report $report)
    {
        return view('admin.reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        $departments = Department::all();
        return view('admin.reports.edit', compact('report', 'departments'));
    }

    public function update(Request $request, Report $report)
    {
        // Validate the request data
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'target' => 'required|numeric',
            'profit' => 'nullable|numeric',
            'outlay' => 'nullable|numeric',
            'date' => 'required|date_format:Y-m', // Ensure date format matches the expected format
        ]);

        // Convert the date to 'Y-m' format for consistency
        $date = \Carbon\Carbon::parse($validated['date']);
        $formattedDate = $date->format('Y-m');

        // Check if a report exists for the same department and month, excluding the current report
        $exists = Report::where('department_id', $validated['department_id'])
            ->where('date', $formattedDate) // Use the formatted date for comparison
            ->where('id', '!=', $report->id) // Exclude the current report ID
            ->exists();

        // If a report already exists, redirect with an error
        if ($exists) {
            return redirect()->back()->withErrors(['date' => 'Bu oyda hisobot allaqachon kiritilgan. Iltimos, boshqa oyni tanlang.'])->withInput();
        }

        // Update the report
        $report->update($validated);

        // Redirect with success message
        return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
    }


    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }
}
