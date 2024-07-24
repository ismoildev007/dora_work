@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Amounts</h1>
        <a href="{{ route('amounts.create') }}" class="btn btn-primary">Create Amount</a>
        <table class="table mt-4">
            <thead>
            <tr>
                <th>ID</th>
                <th>Project</th>
                <th>Status</th>
                <th>Profit</th>
                <th>Outlay</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($amounts as $amount)
                <tr>
                    <td>{{ $amount->id }}</td>
                    <td>{{ $amount->project->title }}</td>
                    <td>{{ $amount->status->name }}</td>
                    <td>{{ $amount->profit }}</td>
                    <td>{{ $amount->outlay }}</td>
                    <td>
                        <a href="{{ route('amounts.edit', $amount->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('amounts.destroy', $amount->id) }}" method="POST" style="display:inline;">
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
