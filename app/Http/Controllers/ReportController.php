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
            'profit' => 'required|numeric',
            'outlay' => 'required|numeric',
            'date' => 'required|date',
        ]);

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
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'profit' => 'required|numeric',
            'outlay' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $report->update($validated);

        return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
    }

    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }
}
