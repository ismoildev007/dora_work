@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hisobot Yaratish</h1>
        <form action="{{ route('reports.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="department_id" class="form-label">Bo'lim</label>
                <select class="form-control" id="department_id" name="department_id" required>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="profit" class="form-label">Foyda</label>
                <input type="text" class="form-control" id="profit" name="profit" required>
            </div>
            <div class="mb-3">
                <label for="outlay" class="form-label">Harajat</label>
                <input type="text" class="form-control" id="outlay" name="outlay" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Sana</label>
                <input type="month" class="form-control" id="date" name="date" required>
            </div>
            <button type="submit" class="btn btn-primary">Yuborish</button>
        </form>
    </div>
@endsection
