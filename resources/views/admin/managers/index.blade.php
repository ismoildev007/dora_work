@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Managers</h1>
    <a href="{{ route('managers.create') }}" class="btn btn-primary mb-3">Create Manager</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Department</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($managers as $manager)
                <tr>
                    <td>{{ $manager->id }}</td>
                    <td>{{ $manager->user->name }}</td>
                    <td>{{ $manager->department }}</td>
                    <td>{{ $manager->phone_number }}</td>
                    <td>
                        <a href="{{ route('managers.show', $manager->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('managers.edit', $manager->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('managers.destroy', $manager->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
