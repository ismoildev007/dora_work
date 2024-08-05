@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Project</h1>

        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ $project->start_date }}" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ $project->end_date }}" required>
            </div>
            <div class="form-group">
                <label for="project_status">Project Status</label>
                <input type="text" name="project_status" class="form-control" value="{{ $project->project_status }}" required>
            </div>
            <div class="form-group">
                <label for="payment_status">Payment Status</label>
                <input type="text" name="payment_status" class="form-control" value="{{ $project->payment_status }}" required>
            </div>
            <div class="form-group">
                <label for="client_id">Client</label>
                <select name="client_id" class="form-control" required>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ $client->id == $project->client_id ? 'selected' : '' }}>{{ $client->company_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="manager_id">Manager</label>
                <select name="manager_id" class="form-control" required>
                    @foreach ($managers as $manager)
                        <option value="{{ $manager->id }}" {{ $manager->id == $project->manager_id ? 'selected' : '' }}>{{ $manager->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Project</button>
        </form>

        <hr>
        <h2>Agreements</h2>
        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Contract</th>
                <th>Price</th>
                <th>Service Name</th>
                <th>Service Type</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($project->agreements as $agreement)
                <tr>
                    <td>{{ $agreement->id }}</td>
                    <td>{{ $agreement->contract }}</td>
                    <td>{{ $agreement->price }}</td>
                    <td>{{ $agreement->service_name }}</td>
                    <td>{{ $agreement->service_type }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editAgreementModal"
                                data-id="{{ $agreement->id }}">
                            Edit
                        </button>
                        <form action="{{ route('agreements.destroy', $agreement->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

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
                            <button type="submit" class="btn btn-primary mt-3">Add Agreement</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Agreement Modal -->
        <div class="modal fade" id="editAgreementModal" tabindex="-1" role="dialog" aria-labelledby="editAgreementModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAgreementModalLabel">Edit Agreement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editAgreementForm" action="{{ route('agreements.update', 0) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="edit_agreement_id">
                            <div class="form-group">
                                <label for="edit_contract">Contract</label>
                                <input type="text" name="contract" id="edit_contract" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_price">Price</label>
                                <input type="number" name="price" id="edit_price" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_service_name">Service Name</label>
                                <input type="text" name="service_name" id="edit_service_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_service_type">Service Type</label>
                                <input type="text" name="service_type" id="edit_service_type" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Update Agreement</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        const editAgreementModal = document.getElementById('editAgreementModal');
        editAgreementModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const agreementId = button.getAttribute('data-id');

            fetch(`/agreements/${agreementId}/edit`)
                .then(response => response.json())
                .then(data => {
                    const formAction = `/agreements/${data.id}`;
                    document.getElementById('editAgreementForm').action = formAction;
                    document.getElementById('edit_agreement_id').value = data.id;
                    document.getElementById('edit_contract').value = data.contract;
                    document.getElementById('edit_price').value = data.price;
                    document.getElementById('edit_service_name').value = data.service_name;
                    document.getElementById('edit_service_type').value = data.service_type;
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
