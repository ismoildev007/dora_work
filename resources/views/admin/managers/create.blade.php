@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Yangi Manager Qo'shish</h1>
        <form action="{{ route('managers.store') }}" method="POST">
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
                <label for="department_id">Bo'lim</label>
                <select name="department_id" class="form-control" id="department_id">
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="position">Lavozimi</label>
                <input type="text" name="position" class="form-control" id="position" required>
            </div>
            <button type="submit" class="btn btn-primary">Saqlash</button>
        </form>
    </div>
@endsection
