@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reports</h1>
        <a href="{{ route('reports.create') }}" class="btn btn-primary">Create Report</a>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Department</th>
                <th>Profit</th>
                <th>Outlay</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->department->name }}</td>
                    <td>{{ $report->profit }}</td>
                    <td>{{ $report->outlay }}</td>
                    <td>{{ $report->date }}</td>
                    <td>
                        <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display:inline;">
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
