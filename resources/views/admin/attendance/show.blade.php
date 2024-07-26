<!-- resources/views/attendance/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Attendance Details</h1>

    <div class="card">
        <div class="card-header">
            Attendance Record #{{ $attendance->id }}
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Staff ID:</strong> {{ $attendance->staff_id }}</li>
                <li class="list-group-item"><strong>Date:</strong> {{ $attendance->date->format('Y-m-d') }}</li>
                <li class="list-group-item"><strong>Status:</strong> {{ ucfirst($attendance->status) }}</li>
            </ul>
            <a href="{{ route('attendance.index') }}" class="btn btn-primary mt-3">Back to List</a>
            @can('update', $attendance)
            <a href="{{ route('attendance.edit', $attendance->id) }}" class="btn btn-warning mt-3">Edit</a>
            @endcan
        </div>
    </div>
</div>
@endsection
