@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mijozlar</h1>
    <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Mijoz Yaratish</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ism</th>
                <th>Aloqa Shaxsi</th>
                <th>Email</th>
                <th>Telefon Raqami</th>
                <th>Manzil</th>
                <th>Harakatlar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->contact_person }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone_number }}</td>
                    <td>{{ $client->address }}</td>
                    <td>
                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
