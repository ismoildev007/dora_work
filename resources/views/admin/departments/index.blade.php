@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bo‘limlar</h1>
        <a href="{{ route('departments.create') }}" class="btn btn-primary">Bo‘lim Yaratish</a>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nomi</th>
                <th>Harakatlar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>
                        <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;">
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
