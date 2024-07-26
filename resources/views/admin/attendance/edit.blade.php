@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Attendance</h1>

    <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="staff_id">Staff:</label>
            <select id="staff_id" name="staff_id" class="form-control" disabled>
                @foreach($staffMembers as $staff)
                    <option value="{{ $staff->id }}" {{ $attendance->staff_id == $staff->id ? 'selected' : '' }}>
                        {{ $staff->user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" class="form-control" value="{{ $attendance->date->format('Y-m-d') }}" disabled>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" class="form-control" required>
                <option value="present" {{ $attendance->status == 'keldi' ? 'selected' : '' }}>Keldi</option>
                <option value="absent" {{ $attendance->status == 'kelmadi' ? 'selected' : '' }}>Kelmadi</option>
                <option value="sick" {{ $attendance->status == 'kasal' ? 'selected' : '' }}>Kasal</option>
                <option value="leave" {{ $attendance->status == 'ketgan' ? 'selected' : '' }}>Ketgan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Attendance</button>
    </form>
</div>
@endsection
