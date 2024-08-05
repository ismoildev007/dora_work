@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Projects</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">+ Add New Project</a>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Project Status</th>
                <th>Payment Status</th>
                <th>Client</th>
                <th>Manager</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->start_date }}</td>
                    <td>{{ $project->end_date }}</td>
                    <td>{{ $project->project_status }}</td>
                    <td>{{ $project->payment_status }}</td>
                    <td>{{ $project->client->company_name }}</td>
                    <td>{{ $project->manager->name }}</td>
                    <td>
                        <a href="{{ route('projects.show', $project) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <!-- Button to trigger add agreement modal -->
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addAgreementModal"
                                data-project-id="{{ $project->id }}">
                            + Add Agreement
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Agreement Modal -->
    <div class="modal fade" id="addAgreementModal" tabindex="-1" aria-labelledby="addAgreementModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAgreementModalLabel">Add Agreement to Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addAgreementForm" action="{{ route('agreements.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="project_id" id="modal_project_id">
                        <div class="form-group">
                            <label for="contract">Contract</label>
                            <input type="text" name="contract" id="contract" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="service_name">Xizmat nomi (Service Name)</label>
                            <select class="form-control" id="service_name" name="service_name" required onchange="updateServiceType()">
                                <option value="">Select Service Name</option>
                                <option value="smm">SMM</option>
                                <option value="branding">Branding</option>
                                <option value="development">Development</option>
                                <option value="print">Print</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="service_type">Xizmat turi (Service Type)</label>
                            <select class="form-control" id="service_type" name="service_type" required>
                                <!-- Options will be populated dynamically based on service_name -->
                            </select>
                        </div>

                        <script>
                            function updateServiceType() {
                                // Get the selected service name
                                const serviceName = document.getElementById('service_name').value;

                                // Get the service type dropdown
                                const serviceTypeDropdown = document.getElementById('service_type');

                                // Define the mapping from service names to service types
                                const serviceTypeOptions = {
                                    'smm': ['monthly'],
                                    'branding': ['unit'],
                                    'development': ['unit'],
                                    'print': ['unit']
                                };

                                // Clear existing options
                                serviceTypeDropdown.innerHTML = '';

                                // Populate new options based on the selected service name
                                if (serviceName in serviceTypeOptions) {
                                    serviceTypeOptions[serviceName].forEach(type => {
                                        const option = document.createElement('option');
                                        option.value = type;
                                        option.textContent = type.charAt(0).toUpperCase() + type.slice(1); // Capitalize first letter
                                        serviceTypeDropdown.appendChild(option);
                                    });
                                } else {
                                    // Handle cases where no service name is selected or matched
                                    const defaultOption = document.createElement('option');
                                    defaultOption.value = '';
                                    defaultOption.textContent = 'Select Service Type';
                                    serviceTypeDropdown.appendChild(defaultOption);
                                }

                                // Enable the dropdown once options are added
                                serviceTypeDropdown.disabled = false;
                            }

                            // Automatically update the service type on page load if there's a default selection
                            document.addEventListener('DOMContentLoaded', updateServiceType);
                        </script>

                        <button type="submit" class="btn btn-primary">Add Agreement</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addAgreementModal = document.getElementById('addAgreementModal');
            addAgreementModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const projectId = button.getAttribute('data-project-id');

                // Set the project ID in the modal form
                document.getElementById('modal_project_id').value = projectId;
            });
        });
    </script>
@endsection
