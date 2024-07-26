@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mijozni Tahrirlash</h1>
    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Ism</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $client->name }}" required>
        </div>
        <div class="form-group">
            <label for="contact_person">Aloqa Shaxsi</label>
            <input type="text" name="contact_person" id="contact_person" class="form-control" value="{{ $client->contact_person }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $client->email }}" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Telefon Raqami</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $client->phone_number }}" required>
        </div>
        <div class="form-group">
            <label for="address">Manzil</label>
            <textarea name="address" id="address" class="form-control">{{ $client->address }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Mijozni Yangilash</button>
    </form>
</div>
@endsection
