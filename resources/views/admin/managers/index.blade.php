@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menejerlar</h1>
    <a href="{{ route('managers.create') }}" class="btn btn-primary mb-3">Menejer Yaratish</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Foydalanuvchi</th>
                <th>Bo‘lim</th>
                <th>Telefon Raqami</th>
                <th>Harakatlar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($managers as $manager)
                <tr>
                    <td>{{ $manager->id }}</td>
                    <td>{{ $manager->user->name }}</td>
                    <td>{{ $manager->department }}</td>
                    <td>{{ $manager->phone_number }}</td>
                    <td>
                        <a href="{{ route('managers.show', $manager->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('managers.edit', $manager->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('managers.destroy', $manager->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
