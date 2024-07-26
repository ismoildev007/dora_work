@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Managerni Tahrirlash</h1>
        <form action="{{ route('managers.update', $manager->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="user_id">Foydalanuvchi</label>
                <select name="user_id" class="form-control" id="user_id">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $manager->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="department_id">Bo'lim</label>
                <select name="department_id" class="form-control" id="department_id">
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ $department->id == $manager->department_id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="position">Lavozimi</label>
                <input type="text" name="position" class="form-control" id="position" value="{{ $manager->position }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Yangilash</button>
        </form>
    </div>
@endsection
