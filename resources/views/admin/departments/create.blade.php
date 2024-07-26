@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bo'lim Yaratish</h1>
        <form action="{{ route('departments.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nomi</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Yuborish</button>
        </form>
    </div>
@endsection
