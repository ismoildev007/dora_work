@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mijoz Yaratish</h1>
    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Ism</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="contact_person">Aloqa Shaxsi</label>
            <input type="text" name="contact_person" id="contact_person" class="form-control" required>
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
