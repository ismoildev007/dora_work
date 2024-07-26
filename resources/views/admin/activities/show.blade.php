<!-- resources/views/activities/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Faoliyat Tafsilotlari</h1>
    <div class="card">
        <div class="card-header">
            Faoliyat #{{ $activity->id }}
        </div>
        <div class="card-body">
            <p><strong>Tavsif:</strong> {{ $activity->description }}</p>
            <p><strong>Faoliyat Turi:</strong> {{ ucfirst($activity->activity_type) }}</p>
            <p><strong>Faoliyat Sanasi:</strong> {{ $activity->activity_date }}</p>
            <p><strong>Xodim:</strong> {{ $activity->staff->user->name ?? 'Mavjud Emas' }}</p>
{{--            <p><strong>Mijoz:</strong> {{ $activity->client->name ?? 'Mavjud Emas' }}</p>--}}
            <p><strong>Loyiha:</strong> {{ $activity->project->name ?? 'Mavjud Emas' }}</p>
            <div class="mt-4">
                <h5>Rasmlar</h5>
                @foreach($activity->images as $image)
                    <img src="{{ asset('storage/' . $image->image) }}" alt="Faoliyat Rasmi" class="img-thumbnail" style="width: 200px; height: auto;">
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('activities.index') }}" class="btn btn-secondary">Ro'yxatga qaytish</a>
            <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-warning">Tahrirlash</a>
        </div>
    </div>
</div>
@endsection
