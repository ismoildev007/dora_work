@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mijozni Tahrirlash</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('clients.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="company_inn">Kompaniya INN</label>
                <input type="text" name="company_inn" id="company_inn" class="form-control" value="{{ $client->company_inn }}" required>
            </div>
            <div class="form-group">
                <label for="company_name">Kompaniya Nomi</label>
                <input type="text" name="company_name" id="company_name" class="form-control" value="{{ $client->company_name }}" required>
            </div>
            <div class="form-group">
                <label for="company_person">Aloqa Shaxsi</label>
                <input type="text" name="company_person" id="company_person" class="form-control" value="{{ $client->company_person }}" required>
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
            <button type="submit" class="btn btn-primary">Mijozni Tahrirlash</button>
        </form>
    </div>
@endsection
