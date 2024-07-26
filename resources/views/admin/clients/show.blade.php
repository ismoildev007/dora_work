@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mijoz Tafsilotlari</h1>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $client->name }}</h4>
            <p><strong>Aloqa Shaxsi:</strong> {{ $client->contact_person }}</p>
            <p><strong>Email:</strong> {{ $client->email }}</p>
            <p><strong>Telefon Raqami:</strong> {{ $client->phone_number }}</p>
            <p><strong>Manzil:</strong> {{ $client->address }}</p>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">Ro'yxatga Qaytish</a>
            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">Tahrirlash</a>
            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">O'chirish</button>
            </form>
        </div>
    </div>
</div>
@endsection
