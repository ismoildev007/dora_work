@extends('layouts.app')

@section('content')
<style>
    /* Ensures icons are displayed inline and adds spacing */
    td .btn {
        margin-right: 5px; /* Adds space between buttons */
        vertical-align: middle; /* Aligns buttons vertically in the middle */
    }

    /* Optional: Adjust icon size */
    .btn i {
        font-size: 16px; /* Adjust to your preference */
    }

    /* Ensures all action buttons are displayed inline within a cell */
    td .action-buttons {
        display: flex; /* Uses flexbox to align buttons horizontally */
        align-items: center; /* Vertically centers the buttons */
    }

    /* Optional: Adjust button spacing if needed */
    td .action-buttons > * {
        margin-right: 5px; /* Space between buttons */
    }

    /* Optional: Responsive table */
    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }
    }
</style>

<div class="container">
    <h1>Faoliyatlar</h1>
    
    @can('create', App\Models\Activity::class)
    <a href="{{ route('activities.create') }}" class="btn btn-primary mb-3">Vazifalar Yaratish</a>
    @endcan

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tavsif</th>
                    <th>Turi</th>
                    <th>Sana</th>
                    <th>Xodimlar</th>
                    {{-- <th>Mijoz</th> --}}
                    <th>Loyiha</th>
                    <th>Harakatlar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity->id }}</td>
                    <td>{!! Str::limit($activity->description, 50) !!}</td> <!-- Shortened description for readability -->
                    <td>{{ ucfirst($activity->activity_type) }}</td> <!-- Capitalize first letter of activity_type -->
                    <td>{{ \Carbon\Carbon::parse($activity->activity_date)->format('d-m-Y') }}</td> <!-- Formatted date -->
                    <td>
                        @foreach($activity->staff as $staff)
                            <span class="badge bg-primary">{{ $staff->name }}</span>
                        @endforeach
                    </td>
                    {{-- <td>{{ $activity->client->name ?? 'Mavjud Emas' }}</td> --}}
                    <td>{{ $activity->project->client->company_name ?? 'Mavjud Emas' }}</td>
                    <td>
                        <div class="action-buttons">
                            @can('update', $activity)
                            <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endcan
                            <a href="{{ route('activities.show', $activity->id) }}" class="btn btn-info btn-sm" title="Show">
                                <i class="fas fa-eye"></i>
                            </a>
                            @can('delete', $activity)
                            <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Ushbu faoliyatni o‘chirishni xohlaysizmi?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
