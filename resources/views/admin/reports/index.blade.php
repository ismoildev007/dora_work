@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hisobotlar</h1>
        <a href="{{ route('reports.create') }}" class="btn btn-primary">Hisobot Yaratish</a>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Bo'lim</th>
                <th>Foyda</th>
                <th>Harajat</th>
                <th>Sana</th>
                <th>Amallar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->department->name }}</td>
                    <td>{{ $report->profit }}</td>
                    <td>{{ $report->outlay }}</td>
                    <td>{{ $report->date }}</td>
                    <td>
                        <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display:inline;">
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
