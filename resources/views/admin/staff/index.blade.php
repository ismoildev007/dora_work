@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Staff List</h1>
        <a href="{{ route('staffs.create') }}" class="btn btn-primary mb-3">Add New Staff</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Manager ID</th>
                <th>Position</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($staffs as $staff)
                <tr>
                    <td>{{ $staff->id }}</td>
                    <td>{{ $staff->user_id }}</td>
                    <td>{{ $staff->manager_id }}</td>
                    <td>{{ $staff->position }}</td>
                    <td>{{ $staff->phone_number }}</td>
                    <td>
                        <a href="{{ route('staffs.edit', $staff->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('staffs.destroy', $staff->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
