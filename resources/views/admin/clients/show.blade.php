@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Client Details</h1>
        <div class="card">
            <div class="card-header">
                Client #{{ $client->id }}
            </div>
            <div class="card-body">
                <p><strong>Company INN:</strong> {{ $client->company_inn }}</p>
                <p><strong>Company Name:</strong> {{ $client->company_name }}</p>
                <p><strong>Company Person:</strong> {{ $client->company_person }}</p>
                <p><strong>Email:</strong> {{ $client->email }}</p>
                <p><strong>Phone Number:</strong> {{ $client->phone_number }}</p>
                <p><strong>Address:</strong> {{ $client->address }}</p>
                <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
