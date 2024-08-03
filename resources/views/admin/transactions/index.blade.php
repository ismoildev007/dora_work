@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Transactions</h1>
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
                    <td>{{ $transaction->agreement->service_name }}</td>
                    <td>{{ $transaction->residual }}</td>
                    <td>{{ $transaction->profit }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTransactionModal"
                                data-id="{{ $transaction->id }}">
                            Edit
                        </button>
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

    <!-- Edit Transaction Modal -->
    <div class="modal fade" id="editTransactionModal" tabindex="-1" aria-labelledby="editTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTransactionModalLabel">Edit Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTransactionForm" action="{{ route('transactions.update', 'transaction_id_placeholder') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="edit_id">
                        <div class="form-group">
                            <label for="edit_agreement_name">Agreement</label>
                            <input type="text" name="agreement_name" id="edit_agreement_name" class="form-control" readonly>
                            <input type="hidden" name="agreement_id" id="edit_agreement_id">
                        </div>
                        <div class="form-group">
                            <label for="edit_profit">Profit</label>
                            <input type="number" name="profit"  class="form-control" step="0.01" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editTransactionModal = document.getElementById('editTransactionModal');
            editTransactionModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const transactionId = button.getAttribute('data-id');

                fetch(`/transactions/${transactionId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('edit_id').value = data.id;
                        document.getElementById('edit_agreement_name').value = data.agreement.service_name;
                        document.getElementById('edit_agreement_id').value = data.agreement.id;
                        document.getElementById('edit_profit').value = data.profit;

                        const form = document.getElementById('editTransactionForm');
                        form.action = form.action.replace('transaction_id_placeholder', data.id);
                    })
                    .catch(error => console.error('Error fetching transaction data:', error));
            });
        });
    </script>
@endsection
