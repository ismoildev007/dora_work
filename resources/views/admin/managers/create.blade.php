@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menejer Yaratish</h1>
    <form action="{{ route('managers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">Foydalanuvchi</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="department">Bo‘lim</label>
            <input type="text" name="department" id="department" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Telefon Raqami</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Menejer Yaratish</button>
    </form>
</div>
@endsection
