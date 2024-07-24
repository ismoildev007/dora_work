<!-- In show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Activity Details</h1>
    <div class="card">
        <div class="card-header">
            Activity #{{ $activity->id }}
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $activity->description }}</p>
            <p><strong>Activity Type:</strong> {{ ucfirst($activity->activity_type) }}</p>
            <p><strong>Activity Date:</strong> {{ $activity->activity_date->format('F j, Y') }}</p>
            <p><strong>Staff:</strong> {{ $activity->staff->user->name ?? 'N/A' }}</p>
            <p><strong>Client:</strong> {{ $activity->client->name ?? 'N/A' }}</p>
            <p><strong>Project:</strong> {{ $activity->project->name ?? 'N/A' }}</p>
            <div class="mt-4">
                <h5>Images</h5>
                @foreach($activity->images as $image)
                    <img src="{{ Storage::url($image->image_path) }}" alt="Activity Image" class="img-thumbnail" style="width: 200px; height: auto;">
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('activities.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
