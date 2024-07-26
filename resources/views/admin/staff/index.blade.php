@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Xodimlar Roʻyxati</h1>
        <a href="{{ route('staffs.create') }}" class="btn btn-primary mb-3">Yangi Xodim Qoʻshish</a>
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
                <th>Menejer</th>
                <th>Lavozim</th>
                <th>Telefon Raqami</th>
                <th>Harakatlar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($staffs as $staff)
                <tr>
                    <td>{{ $staff->id }}</td>
                    <td>{{ $staff->user->name }}</td>
                    <td>{{ $staff->manager->name }}</td>
                    <td>{{ $staff->position }}</td>
                    <td>{{ $staff->user->phone_number }}</td>
                    <td>
                        <a href="{{ route('staffs.edit', $staff->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('staffs.destroy', $staff->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
