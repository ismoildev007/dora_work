@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Transactions</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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
                                data-id="{{ $transaction->id }}"
                                data-agreement-id="{{ $transaction->agreement_id }}"
                                data-profit="{{ $transaction->profit }}"
                                {{ $transaction->residual == 0 ? 'disabled' : '' }}>
                            To'lov qilish
                        </button>
{{--                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline">--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
{{--                            <button type="submit" class="btn btn-danger">Delete</button>--}}
{{--                        </form>--}}
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
                    <form id="editTransactionForm" action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        <input type="hidden" name="agreement_id" id="edit_agreement_id">
                        <div class="form-group">
                            <label for="edit_profit">Profit</label>
                            <input type="number" name="profit" id="edit_profit" class="form-control" step="0.01" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const editTransactionModal = document.getElementById('editTransactionModal');
        editTransactionModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const agreementId = button.getAttribute('data-agreement-id');
            const profit = button.getAttribute('data-profit');

            const idInput = editTransactionModal.querySelector('#edit_id');
            const agreementInput = editTransactionModal.querySelector('#edit_agreement_id');
            const profitInput = editTransactionModal.querySelector('#edit_profit');

            idInput.value = id;
            agreementInput.value = agreementId;
            profitInput.value = '';
        });
    </script>
@endsection