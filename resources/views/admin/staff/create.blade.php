@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Staff</h1>
        <form action="{{ route('staffs.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="number" name="user_id" class="form-control" id="user_id" required>
            </div>
            <div class="form-group">
                <label for="manager_id">Manager ID</label>
                <input type="number" name="manager_id" class="form-control" id="manager_id">
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" name="position" class="form-control" id="position" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" id="phone_number" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
