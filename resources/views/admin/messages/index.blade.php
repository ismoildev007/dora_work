@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Messages</h1>
        <a href="{{ route('messages.create') }}" class="btn btn-primary">Create Message</a>
        <table class="table mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Conversation</th>
                <th>Sender</th>
                <th>Content</th>
                <th>Sent At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($messages as $message)
                <tr>
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->conversation->name ?? 'N/A' }}</td>
                    <td>{{ $message->sender->name ?? 'N/A' }}</td>
                    <td>{{ $message->content }}</td>
                    <td>{{ $message->sent_at }}</td>
                    <td>
                        <a href="{{ route('messages.show', $message->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('messages.edit', $message->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('messages.destroy', $message->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
