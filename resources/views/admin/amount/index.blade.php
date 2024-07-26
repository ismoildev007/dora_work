@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Miqdorlar</h1>
        <a href="{{ route('amounts.create') }}" class="btn btn-primary">Miqdor Yaratish</a>
        <table class="table mt-4">
            <thead>
            <tr>
                <th>ID</th>
                <th>Loyiha</th>
                <th>Holat</th>
                <th>Foyda</th>
                <th>Xarajat</th>
                <th>Harakatlar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($amounts as $amount)
                <tr>
                    <td>{{ $amount->id }}</td>
                    <td>{{ $amount->project->title }}</td>
                    <td>{{ $amount->status->name }}</td>
                    <td>{{ $amount->profit }}</td>
                    <td>{{ $amount->outlay }}</td>
                    <td>
                        <a href="{{ route('amounts.edit', $amount->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('amounts.destroy', $amount->id) }}" method="POST" style="display:inline;">
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
