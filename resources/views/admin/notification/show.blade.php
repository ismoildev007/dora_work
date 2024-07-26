@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Xabar Tafsilotlari</h1>
    <div class="card">
        <div class="card-header">
            {{ $notification->data['title'] ?? 'Xabar' }}
        </div>
        <div class="card-body">
            <p class="card-text">{{ $notification->data['message'] ?? '' }}</p>
            <p class="card-text"><strong>Faoliyat Turi:</strong> {{ $notification->data['activity_type'] ?? '' }}</p>
            <p class="card-text"><strong>Faoliyat Sanasi:</strong> {{ $notification->data['activity_date'] ?? '' }}</p>
            <p class="card-text"><strong>Tavsif:</strong> {{ $notification->data['description'] ?? '' }}</p>
            @if(isset($notification->data['staff_id']))
                <p class="card-text"><strong>Xodim ID:</strong> {{ $notification->data['staff_id'] }}</p>
            @endif
            @if(isset($notification->data['client_id']))
                <p class="card-text"><strong>Mijoz ID:</strong> {{ $notification->data['client_id'] }}</p>
            @endif
            @if(isset($notification->data['project_id']))
                <p class="card-text"><strong>Loyiha ID:</strong> {{ $notification->data['project_id'] }}</p>
            @endif
            <a href="{{ route('notifications.index') }}" class="btn btn-primary">Xabarlarga Orqaga</a>
        </div>
        <div class="card-footer text-muted">
            {{ $notification->created_at->diffForHumans() }}
        </div>
    </div>
</div>
@endsection
