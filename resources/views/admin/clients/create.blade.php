@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mijoz Yaratish</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('clients.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="company_inn">Kompaniya INN</label>
                <input type="text" name="company_inn" id="company_inn" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="company_name">Kompaniya Nomi</label>
                <input type="text" name="company_name" id="company_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="company_person">Aloqa Shaxsi</label>
                <input type="text" name="company_person" id="company_person" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Telefon Raqami</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Manzil</label>
                <textarea name="address" id="address" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Mijoz Yaratish</button>
        </form>
    </div>
@endsection