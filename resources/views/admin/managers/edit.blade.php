@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menejerni Tahrirlash</h1>
    <form action="{{ route('managers.update', $manager->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_id">Foydalanuvchi</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $manager->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="department">Bo‘lim</label>
            <input type="text" name="department" id="department" class="form-control" value="{{ $manager->department }}" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Telefon Raqami</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $manager->phone_number }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Menejer Yangilash</button>
    </form>
</div>
@endsection
