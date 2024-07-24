@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>View Message</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Message ID: {{ $message->id }}</h5>
                <p class="card-text">Conversation: {{ $message->conversation->name ?? 'N/A' }}</p>
                <p class="card-text">Sender: {{ $message->sender->name ?? 'N/A' }}</p>
                <p class="card-text">Content: {{ $message->content }}</p>
                <p class="card-text">Sent At: {{ $message->sent_at }}</p>
                <a href="{{ route('messages.index') }}" class="btn btn-primary">Back to Messages</a>
            </div>
        </div>
    </div>
@endsection
