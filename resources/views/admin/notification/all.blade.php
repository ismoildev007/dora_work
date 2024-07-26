<!-- resources/views/notifications/all.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Barcha Xabarlar</h1>
    <div class="list-group">
        @foreach($notifications as $notification)
            <a href="{{ route('notifications.read', $notification->id) }}" class="list-group-item list-group-item-action {{ $notification->read_at ? '' : 'active' }}">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $notification->data['title'] ?? 'Xabar' }}</h5>
                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $notification->data['message'] ?? '' }}</p>
            </a>
        @endforeach
    </div>
</div>
@endsection
