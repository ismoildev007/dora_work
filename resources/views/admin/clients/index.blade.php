@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mijozlar</h1>
        <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Mijoz Yaratish</a>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Kompaniya Nomi</th>
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
                    <td>{{ $client->company_name }}</td>
                    <td>{{ $client->company_person }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone_number }}</td>
                    <td>{{ $client->address }}</td>
                    <td>
                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
