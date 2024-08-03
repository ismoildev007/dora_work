@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Agreement</h1>
        <form action="{{ route('agreements.update', $agreement->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="contract">Contract</label>
                <input type="text" class="form-control" id="contract" name="contract" value="{{ $agreement->contract }}" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ $agreement->price }}" required>
            </div>
            <div class="form-group">
                <label for="service_name">Service Name</label>
                <input type="text" class="form-control" id="service_name" name="service_name" value="{{ $agreement->service_name }}" required>
            </div>
            <div class="form-group">
                <label for="service_type">Service Type</label>
                <select class="form-control" id="service_type" name="service_type" required>
                    <option value="monthly" @if($agreement->service_type == 'monthly') selected @endif>Monthly</option>
                    <option value="unit" @if($agreement->service_type == 'unit') selected @endif>Unit</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
