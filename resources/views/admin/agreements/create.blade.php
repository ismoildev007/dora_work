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
            <label for="service_name">Xizmat nomi (Service Name)</label>
            <select class="form-control" id="service_name" name="service_name" required onchange="updateServiceType()">
                <option value="smm">SMM</option>
                <option value="branding">Branding</option>
                <option value="development">Development</option>
                <option value="print">Print</option>
            </select>
        </div>

        <div class="form-group">
            <label for="service_type">Xizmat turi (Service Type)</label>
            <select class="form-control" id="service_type" name="service_type" required disabled>
                <option value="monthly">Monthly</option>
                <option value="unit">Unit</option>
            </select>
        </div>

        <script>
            function updateServiceType() {
                // Get the selected service name
                const serviceName = document.getElementById('service_name').value;

                // Get the service type dropdown
                const serviceTypeDropdown = document.getElementById('service_type');

                // Define the mapping from service names to service types
                const serviceTypeMapping = {
                    'smm': 'monthly',
                    'branding': 'unit',
                    'development': 'unit',
                    'print': 'unit'
                };

                // Get the corresponding service type
                const selectedServiceType = serviceTypeMapping[serviceName];

                // Set the value of the service type dropdown
                serviceTypeDropdown.value = selectedServiceType;
            }

            // Automatically update the service type on page load for the default selection
            document.addEventListener('DOMContentLoaded', updateServiceType);
        </script>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection