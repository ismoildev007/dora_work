<!-- resources/views/attendance/index.blade.php -->

@extends('layouts.app')

@section('content')
<style>
    /* Ensures icons are displayed inline and adds spacing */
    td .btn {
        margin-right: 5px; /* Adds space between buttons */
        vertical-align: middle; /* Aligns buttons vertically in the middle */
    }

    /* Optional: Adjust icon size */
    .btn i {
        font-size: 16px; /* Adjust to your preference */
    }

    /* Ensures all action buttons are displayed inline within a cell */
    td .action-buttons {
        display: flex; /* Uses flexbox to align buttons horizontally */
        align-items: center; /* Vertically centers the buttons */
    }

    /* Optional: Adjust button spacing if needed */
    td .action-buttons > * {
        margin-right: 5px; /* Space between buttons */
    }
</style>

<div class="container">
    <h1>Attendance Records</h1>
    <a href="{{ route('attendance.create') }}" class="btn btn-primary">Record Attendance</a>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Staff ID</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->id }}</td>
                <td>{{ $attendance->staff_id }}</td>
                <td>{{ $attendance->date->format('Y-m-d') }}</td>
                <td>{{ ucfirst($attendance->status) }}</td>
                <td>
                    <div class="action-buttons">
                        @can('update', $attendance)
                        <a href="{{ route('attendance.edit', $attendance->id) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endcan
                        <a href="{{ route('attendance.show', $attendance->id) }}" class="btn btn-info btn-sm" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        @can('delete', $attendance)
                        <form action="{{ route('attendance.destroy', $attendance->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this record?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @endcan
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
