@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Client Details</h1>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $client->name }}</h4>
            <p><strong>Contact Person:</strong> {{ $client->contact_person }}</p>
            <p><strong>Email:</strong> {{ $client->email }}</p>
            <p><strong>Phone Number:</strong> {{ $client->phone_number }}</p>
            <p><strong>Address:</strong> {{ $client->address }}</p>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
