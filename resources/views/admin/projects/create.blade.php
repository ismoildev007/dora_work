@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Project</h1>

        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="project_status">Project Status</label>
                <select class="form-control" id="project_status" name="project_status" required>
                    <option value="completed">Yakunlangan</option>
                    <option value="in_progress">Jarayonda</option>
                    <option value="on_hold">Kutishda</option>
                    <option value="cancelled">Bekor qilingan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="payment_status">Payment Status</label>
                <select class="form-control" id="payment_status" name="payment_status" required>
                    <option value="paid">Paid</option>
                    <option value="partially_paid">Partially Paid</option>
                    <option value="unpaid">Unpaid</option>
                </select>
            </div>
            <div class="form-group">
                <label for="client_id">Client</label>
                <select name="client_id" class="form-control" required>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->company_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="manager_id">Manager</label>
                <select name="manager_id" class="form-control" required>
                    @foreach ($managers as $manager)
                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                    @endforeach
                </select>
            </div>


            <button type="submit" class="btn btn-primary mt-3">Create Project</button>
        </form>
    </div>

    <!-- Add Agreement Modal -->
    <div class="modal fade" id="addAgreementModal" tabindex="-1" aria-labelledby="addAgreementModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAgreementModalLabel">Add Agreement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('agreements.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="project_id" id="modal_project_id" value="">
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
                            <select class="form-control" id="modal_service_name" name="service_name" required>
                                <option value="smm">SMM</option>
                                <option value="branding">Branding</option>
                                <option value="development">Development</option>
                                <option value="print">Print</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="service_type">Service Type</label>
                            <select class="form-control" id="modal_service_type" name="service_type" required>
                                <!-- Options will be dynamically populated -->
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


