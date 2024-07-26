@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Loyihalar</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">Loyiha Yaratish</a>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nomi</th>
                <th>Mijoz</th>
                <th>Boshqaruvchi</th>
                <th>Holat</th>
                <th>Harakatlar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->client->name ?? 'N/A' }}</td>
                    <td>{{ $project->manager->name ?? 'N/A' }}</td>
                    <td>{{ $project->status }}</td>
                    <td>
                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">
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
