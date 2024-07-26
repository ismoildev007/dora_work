@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hisobotni Tahrirlash</h1>
        <form action="{{ route('reports.update', $report->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="department_id" class="form-label">Bo'lim</label>
                <select class="form-control" id="department_id" name="department_id" required>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ $report->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="profit" class="form-label">Foyda</label>
                <input type="text" class="form-control" id="profit" name="profit" value="{{ $report->profit }}" required>
            </div>
            <div class="mb-3">
                <label for="outlay" class="form-label">Harajat</label>
                <input type="text" class="form-control" id="outlay" name="outlay" value="{{ $report->outlay }}" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Sana</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $report->date }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Yangilash</button>
        </form>
    </div>
@endsection