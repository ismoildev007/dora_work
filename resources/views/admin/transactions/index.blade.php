@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Transactions</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTransactionModal">
            Create Transaction
        </button>
        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Agreement</th>
                <th>Residual</th>
                <th>Profit</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->agreement->contract }}</td>
                    <td>{{ $transaction->residual }}</td>
                    <td>{{ $transaction->profit }}</td>
                    <td>
{{--                        <button class="btn btn-warning btn-edit" data-transaction-id="{{ $transaction->id }}" data-bs-toggle="modal" data-bs-target="#editTransactionModal">Edit</button>--}}
                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create Transaction Modal -->
    <div class="modal fade" id="createTransactionModal" tabindex="-1" aria-labelledby="createTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTransactionModalLabel">Create Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createTransactionForm" action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="create_agreement_id">Agreement</label>
                            <select name="agreement_id" id="create_agreement_id" class="form-control" required>
                                @foreach($agreements as $agreement)
                                    <option value="{{ $agreement->id }}">{{ $agreement->service_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="create_profit">Profit</label>
                            <input type="number" name="profit" id="create_profit" class="form-control" step="0.01" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Transaction Modal -->
    <div class="modal fade" id="editTransactionModal" tabindex="-1" aria-labelledby="editTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTransactionModalLabel">Edit Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTransactionForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit_agreement_id">Agreement</label>
                            <select name="agreement_id" id="edit_agreement_id" class="form-control" required>
                                @foreach($agreements as $agreement)
                                    <option value="{{ $agreement->id }}">{{ $agreement->service_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_profit">Profit</label>
                            <input type="number" name="profit" id="edit_profit" class="form-control" step="0.01" required>
                        </div>
                        <input type="hidden" id="edit_transaction_id" name="transaction_id">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create Transaction Form
            document.getElementById('createTransactionForm').addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                fetch('{{ route('transactions.store') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            console.error('Error creating transaction:', data.error);
                            alert('Error creating transaction');
                        }
                    })
                    .catch(error => console.error('Fetch error:', error));
            });

            // Edit Transaction Form
            document.getElementById('editTransactionForm').addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                const transactionId = document.getElementById('edit_transaction_id').value;
                fetch(`/transactions/${transactionId}`, {
                    method: 'PUT',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            console.error('Error updating transaction:', data.error);
                            alert('Error updating transaction');
                        }
                    })
                    .catch(error => console.error('Fetch error:', error));
            });

            // Open Edit Modal with Data
            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', function() {
                    const transactionId = this.dataset.transactionId;
                    fetch(`/transactions/${transactionId}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('edit_agreement_id').value = data.agreement_id;
                            document.getElementById('edit_profit').value = data.profit;
                            document.getElementById('edit_transaction_id').value = data.id;
                            new bootstrap.Modal(document.getElementById('editTransactionModal')).show();
                        })
                        .catch(error => console.error('Fetch error:', error));
                });
            });
        });
    </script>
@endsection
