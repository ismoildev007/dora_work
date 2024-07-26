<!-- resources/views/attendance/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Record Attendance for {{ $date->format('Y-m-d') }}</h1>

    <form action="{{ route('attendance.store') }}" method="POST">
        @csrf
        <input type="hidden" name="date" value="{{ $date->format('Y-m-d') }}">

        @foreach($staffMembers as $staff)
            <div class="form-group">
                <label for="staff_{{ $staff->id }}">{{ $staff->name }}:</label>
                <select id="staff_{{ $staff->id }}" name="attendances[{{ $staff->id }}][status]" class="form-control" required>
                    <option value="keldi">Keldi</option>
                    <option value="kelmadi">Kelmadi</option>
                    <option value="kasal">Kasal</option>
                    <option value="ketgan">Ketgan</option>
                </select>
                <input type="hidden" name="attendances[{{ $staff->id }}][staff_id]" value="{{ $staff->id }}">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Record Attendance</button>
    </form>
</div>
@endsection
