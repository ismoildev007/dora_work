@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Agreement</h1>
        <form action="{{ route('agreements.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="contract">Contract</label>
                <input type="text" class="form-control" id="contract" name="contract" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="service_name">Service Name</label>
                <input type="text" class="form-control" id="service_name" name="service_name" required>
            </div>
            <div class="form-group">
                <label for="service_type">Service Type</label>
                <select class="form-control" id="service_type" name="service_type" required>
                    <option value="monthly">Monthly</option>
                    <option value="unit">Unit</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
