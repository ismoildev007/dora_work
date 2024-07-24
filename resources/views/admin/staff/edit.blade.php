@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Staff</h1>
        <form action="{{ route('staffs.update', $staff->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="number" name="user_id" class="form-control" id="user_id" value="{{ $staff->user_id }}" required>
            </div>
            <div class="form-group">
                <label for="manager_id">Manager ID</label>
                <input type="number" name="manager_id" class="form-control" id="manager_id" value="{{ $staff->manager_id }}">
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" name="position" class="form-control" id="position" value="{{ $staff->position }}" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" id="phone_number" value="{{ $staff->phone_number }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
