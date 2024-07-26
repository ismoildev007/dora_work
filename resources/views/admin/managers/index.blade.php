@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Managerlar ro'yxati</h1>
        <a href="{{ route('managers.create') }}" class="btn btn-primary mb-3">Yangi Manager Qo'shish</a>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Foydalanuvchi</th>
                <th>Bo'lim</th>
                <th>Lavozimi</th>
                <th>Telefon Raqami</th>
                <th>Amallar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($managers as $manager)
                <tr>
                    <td>{{ $manager->id }}</td>
                    <td>{{ $manager->user->name }}</td>
                    <td>{{ $manager->department->name }}</td>
                    <td>{{ $manager->position }}</td>
                    <td>{{ $manager->user->phone_number }}</td>
                    <td>
                        <a href="{{ route('managers.edit', $manager->id) }}" class="btn btn-warning">Tahrirlash</a>
                        <form action="{{ route('managers.destroy', $manager->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">O'chirish</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
