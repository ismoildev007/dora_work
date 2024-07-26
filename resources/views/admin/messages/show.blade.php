@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Xabarni Ko‘rish</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Xabar ID: {{ $message->id }}</h5>
            <p class="card-text">Muloqot: {{ $message->conversation->name ?? 'Yo‘q' }}</p>
            <p class="card-text">Yuboruvchi: {{ $message->sender->name ?? 'Yo‘q' }}</p>
            <p class="card-text">Mazmun: {{ $message->content }}</p>
            <p class="card-text">Yuborilgan Sana: {{ $message->sent_at }}</p>
            <a href="{{ route('messages.index') }}" class="btn btn-primary">Xabarlarga Qaytish</a>
        </div>
    </div>
</div>
@endsection
