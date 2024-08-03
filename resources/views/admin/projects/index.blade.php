@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Loyihalar</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">Loyiha Yaratish</a>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Company INN</th>
                <th>Company Name</th>
                <th>Company Person</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Project Status</th>
                <th>Payment Status</th>
                <th>Agreement ID</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->company_inn }}</td>
                    <td>{{ $project->company_name }}</td>
                    <td>{{ $project->company_person }}</td>
                    <td>{{ $project->start_date }}</td>
                    <td>{{ $project->end_date }}</td>
                    <td>{{ $project->project_status }}</td>
                    <td>{{ $project->payment_status }}</td>
                    <td>{{ $project->agreement->service_name }}</td>
                    <td>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
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
