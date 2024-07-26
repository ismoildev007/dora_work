<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Department;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('department')->get();
        return view('admin.reports.index', compact('reports'));
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
            'profit' => 'required|numeric',
            'outlay' => 'required|numeric',
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
            'profit' => 'required|numeric',
            'outlay' => 'required|numeric',
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
