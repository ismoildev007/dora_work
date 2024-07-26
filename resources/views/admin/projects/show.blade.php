@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Loyihani Ko'rish</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $project->name }}</h5>
                <p class="card-text">{{ $project->description }}</p>
                <p class="card-text">Boshlanish sanasi: {{ $project->start_date }}</p>
                <p class="card-text">Tugash sanasi: {{ $project->end_date }}</p>
                <p class="card-text">Mijoz: {{ $project->client->name }}</p>
                <p class="card-text">Boshqaruvchi: {{ $project->manager->name }}</p>
                <p class="card-text">Holat: {{ ucfirst($project->status) }}</p>
                <div class="mt-3">
                    <h5>Loyiha Rasmlari</h5>
                    <div class="row">
                        @foreach($project->images as $image)
                            <div class="col-md-3">
                                <img src="{{ asset('storage/' . $image->image) }}" class="img-fluid" alt="Loyiha Rasm">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
