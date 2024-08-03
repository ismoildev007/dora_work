@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Loyiha Yaratish</h1>
        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="company_inn">Company INN</label>
                <input type="text" class="form-control" id="company_inn" name="company_inn" required>
            </div>
            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name" required>
            </div>
            <div class="form-group">
                <label for="company_person">Company Person</label>
                <input type="text" class="form-control" id="company_person" name="company_person" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
            <div class="form-group">
                <label for="client_id">Mijoz</label>
                <select name="client_id" class="form-control" id="client_id">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="manager_id">Boshqaruvchi</label>
                <select name="manager_id" class="form-control" id="manager_id">
                    @foreach($managers as $manager)
                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="agreement_id">Agreement</label>
                <select class="form-control" id="agreement_id" name="agreement_id">
                    <option value="">None</option>
                    @foreach ($agreements as $agreement)
                        <option value="{{ $agreement->id }}">{{ $agreement->contract }}</option>
                    @endforeach
                </select>
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
            <button type="submit" class="btn btn-primary">Yaratish</button>
        </form>
    </div>
@endsection
