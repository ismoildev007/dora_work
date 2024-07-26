<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    
    public function index()
    {
        // Retrieve all attendance records
        $attendances = Attendance::all();
        
        // Pass records to the view
        return view('admin.attendance.index', compact('attendances'));
    }

    
    public function create()
    {
        $date = Carbon::now(); // Or any specific date you want
        $staffMembers = User::where('role', 'staff')->get(); // Fetch all staff members
        return view('admin.attendance.create', compact('staffMembers', 'date'));
    }

    
    public function store(Request $request)
    {
        $date = $request->input('date');
        $attendances = $request->input('attendances');

        foreach ($attendances as $staffId => $attendanceData) {
            // Validate data
            $validatedData = $request->validate([
                'date' => 'required|date',
                'attendances.*.status' => 'required|in:keldi,kelmadi,kasal,ketgan',
            ]);

            // Check if attendance already exists for this staff member and date
            $existingAttendance = Attendance::where('staff_id', $staffId)
                ->whereDate('date', $date)
                ->first();

            if ($existingAttendance) {
                // Update existing record
                $existingAttendance->update([
                    'status' => $attendanceData['status'],
                    'description' => $attendanceData['description'] ?? null,
                ]);
            } else {
                // Create new record
                Attendance::create([
                    'staff_id' => $staffId,
                    'date' => $date,
                    'status' => $attendanceData['status'],
                    'description' => $attendanceData['description'] ?? null,
                ]);
            }
        }

        return redirect()->route('attendance.index')->with('success', 'Attendance records have been saved successfully.');
    }

    
    public function edit($id)
    {
        // Find the attendance record
        $attendance = Attendance::find($id);
        $staffMembers = User::where('role', 'staff')->get();

        if (!$attendance) {
            return redirect()->route('attendance.index')->with('error', 'Attendance record not found');
        }

        return view('admin.attendance.edit', compact('attendance', 'staffMembers'));
    }

   
    public function update(Request $request, $id)
    {
        // Validate request data
        $request->validate([
            'status' => 'required|in:present,absent,sick,leave',
        ]);

        // Find and update the attendance record
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return redirect()->route('attendance.index')->with('error', 'Attendance record not found');
        }

        $attendance->status = $request->status;
        $attendance->save();

        return redirect()->route('attendance.index')->with('message', 'Attendance updated successfully');
    }

    
    public function destroy($id)
    {
        // Find and delete the attendance record
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return redirect()->route('attendance.index')->with('error', 'Attendance record not found');
        }

        $attendance->delete();

        return redirect()->route('attendance.index')->with('message', 'Attendance deleted successfully');
    }
}
