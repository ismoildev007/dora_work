@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Agreements</h1>
        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Contract</th>
                <th>Price</th>
                <th>Service Name</th>
                <th>Service Type</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($agreements as $agreement)
                <tr>
                    <td>{{ $agreement->id }}</td>
                    <td>{{ $agreement->contract }}</td>
                    <td>{{ $agreement->price }}</td>
                    <td>{{ $agreement->service_name }}</td>
                    <td>{{ $agreement->service_type }}</td>
                    <td>
                        <form action="{{ route('agreements.destroy', $agreement->id) }}" method="POST" class="d-inline">
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
