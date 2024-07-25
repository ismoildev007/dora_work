<!-- resources/views/activities/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Activities</h1>
        @can('create', App\Models\Activity::class)
            <a href="{{ route('activities.create') }}" class="btn btn-primary">Create Activity</a>
        @endcan
        <table class="table mt-4">
            <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Type</th>
                <th>Date</th>
                <th>Staff</th>
{{--                <th>Client</th>--}}
                <th>Project</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity->id }}</td>
                    <td>{{ $activity->description }}</td>
                    <td>{{ $activity->activity_type }}</td>
                    <td>{{ $activity->activity_date }}</td>
                    <td>{{ $activity->staff->user->name ?? 'N/A' }}</td>
{{--                    <td>{{ $activity->client->name ?? 'N/A' }}</td>--}}
                    <td>{{ $activity->project->name ?? 'N/A' }}</td>
                    <td>
                        @can('update', $activity)
                            <a href="{{ route('activities.edit', $activity->id) }}"
                               class="btn btn-warning btn-sm">Edit</a>
                        @endcan
                        <a href="{{ route('activities.show', $activity->id) }}"
                           class="btn btn-info btn-sm">Show</a>
                        @can('delete', $activity)
                            <form action="{{ route('activities.destroy', $activity->id) }}" method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this activity?')">
                                    Delete
                                </button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
