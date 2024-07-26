@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Xabarlar</h1>
    <a href="{{ route('messages.create') }}" class="btn btn-primary">Xabar Yaratish</a>
    <table class="table mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Muloqot</th>
            <th>Yuboruvchi</th>
            <th>Mazmun</th>
            <th>Yuborilgan Sana</th>
            <th>Harakatlar</th>
        </tr>
        </thead>
        <tbody>
        @foreach($messages as $message)
            <tr>
                <td>{{ $message->id }}</td>
                <td>{{ $message->conversation->name ?? 'Yo‘q' }}</td>
                <td>{{ $message->sender->name ?? 'Yo‘q' }}</td>
                <td>{{ $message->content }}</td>
                <td>{{ $message->sent_at }}</td>
                <td>
                    <a href="{{ route('messages.show', $message->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('messages.edit', $message->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('messages.destroy', $message->id) }}" method="POST" style="display:inline-block;">
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
