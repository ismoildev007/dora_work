@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Xodim Yaratish</h1>
        <form action="{{ route('staffs.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">Foydalanuvchi</label>
                <select name="user_id[]" class="form-control" id="user_id" multiple>
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
            <button type="submit" class="btn btn-primary">Yaratish</button>
        </form>
    </div>
@endsection
