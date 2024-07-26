@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Xodim Yaratish</h1>
        <form action="{{ route('staffs.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">Foydalanuvchi</label>
                <select name="user_id" class="form-control" id="user_id">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="manager_id">Menejer</label>
                <select name="manager_id" class="form-control" id="manager_id">
                    @foreach($managers as $manager)
                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="position">Lavozim</label>
                <input type="text" name="position" class="form-control" id="position" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Telefon Raqami</label>
                <input type="text" name="phone_number" class="form-control" id="phone_number" required>
            </div>
            <button type="submit" class="btn btn-primary">Yaratish</button>
        </form>
    </div>
@endsection
