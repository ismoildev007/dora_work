@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Xodimni Tahrirlash</h1>
        <form action="{{ route('staffs.update', $staff->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="user_id">Foydalanuvchi</label>
                <select name="user_id" class="form-control" id="user_id" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $staff->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="manager_id">Menejer</label>
                <select name="manager_id" class="form-control" id="manager_id">
                    @foreach($managers as $manager)
                        <option value="{{ $manager->id }}" {{ $manager->id == $staff->manager_id ? 'selected' : '' }}>
                            {{ $manager->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="position">Lavozim</label>
                <input type="text" name="position" class="form-control" id="position" value="{{ $staff->position }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Yangilash</button>
        </form>
    </div>
@endsection
