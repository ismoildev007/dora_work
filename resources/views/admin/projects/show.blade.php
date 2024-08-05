@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Project Details</h1>

        <div class="card">
            <div class="card-header">
                Project #{{ $project->id }}
            </div>
            <div class="card-body">
                <p><strong>Start Date:</strong> {{ $project->start_date }}</p>
                <p><strong>End Date:</strong> {{ $project->end_date }}</p>
                <p><strong>Project Status:</strong> {{ $project->project_status }}</p>
                <p><strong>Payment Status:</strong> {{ $project->payment_status }}</p>
                <p><strong>Client:</strong> {{ $project->client->company_name }}</p>
                <p><strong>Manager:</strong> {{ $project->manager->name }}</p>

                <h3>Agreements</h3>
                <ul class="list-group mb-3">
                    @foreach ($project->agreements as $agreement)
                        <li class="list-group-item">
                            <strong>Contract:</strong> {{ $agreement->contract }} <br>
                            <strong>Price:</strong> {{ $agreement->price }} <br>
                            <strong>Service Name:</strong> {{ $agreement->service_name }} <br>
                            <strong>Service Type:</strong> {{ $agreement->service_type }}
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>

    <!-- Add Agreement Modal -->
    <div class="modal fade" id="addAgreementModal" tabindex="-1" role="dialog" aria-labelledby="addAgreementModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAgreementModalLabel">Add Agreement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('agreements.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="form-group">
                            <label for="contract">Contract</label>
                            <input type="text" name="contract" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="service_name">Service Name</label>
                            <input type="text" name="service_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="service_type">Service Type</label>
                            <input type="text" name="service_type" class="form-control" required>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
