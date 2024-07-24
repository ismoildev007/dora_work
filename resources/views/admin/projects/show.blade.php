@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>View Project</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $project->name }}</h5>
                <p class="card-text">{{ $project->description }}</p>
                <p class="card-text">Start Date: {{ $project->start_date }}</p>
                <p class="card-text">End Date: {{ $project->end_date }}</p>
                <p class="card-text">Client: {{ $project->client->name }}</p>
                <p class="card-text">Manager: {{ $project->manager->name }}</p>
                <p class="card-text">Status: {{ ucfirst($project->status) }}</p>
                <div class="mt-3">
                    <h5>Project Images</h5>
                    <div class="row">
                        @foreach($project->images as $image)
                            <div class="col-md-3">
                                <img src="{{ asset('storage/' . $image->image) }}" class="img-fluid" alt="Project Image">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
