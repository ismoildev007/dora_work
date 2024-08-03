@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Loyihani Tahrirlash</h1>
        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="company_inn">Company INN</label>
                <input type="text" class="form-control" id="company_inn" name="company_inn" value="{{ $project->company_inn }}" required>
            </div>
            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $project->company_name }}" required>
            </div>
            <div class="form-group">
                <label for="company_person">Company Person</label>
                <input type="text" class="form-control" id="company_person" name="company_person" value="{{ $project->company_person }}" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $project->start_date }}" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $project->end_date }}" required>
            </div>
            <div class="form-group">
                <label for="client_id">Mijoz</label>
                <select name="client_id" class="form-control" id="client_id">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $client->id == $project->client_id ? 'selected' : '' }}>{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="manager_id">Boshqaruvchi</label>
                <select name="manager_id" class="form-control" id="manager_id">
                    @foreach($managers as $manager)
                        <option value="{{ $manager->id }}" {{ $manager->id == $project->manager_id ? 'selected' : '' }}>{{ $manager->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="agreement_id">Agreement</label>
                <select class="form-control" id="agreement_id" name="agreement_id">
                    <option value="">None</option>
                    @foreach ($agreements as $agreement)
                        <option value="{{ $agreement->id }}" {{ $agreement->id == $project->agreement_id ? 'selected' : '' }}>{{ $agreement->contract }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="project_status">Project Status</label>
                <select class="form-control" id="project_status" name="project_status" required>
                    <option value="completed" {{ $project->project_status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="in_progress" {{ $project->project_status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="on_hold" {{ $project->project_status == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                    <option value="cancelled" {{ $project->project_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="form-group">
                <label for="payment_status">Payment Status</label>
                <select class="form-control" id="payment_status" name="payment_status" required>
                    <option value="paid" {{ $project->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="partially_paid" {{ $project->payment_status == 'partially_paid' ? 'selected' : '' }}>Partially Paid</option>
                    <option value="unpaid" {{ $project->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Yangilash</button>
        </form>
    </div>
@endsection
