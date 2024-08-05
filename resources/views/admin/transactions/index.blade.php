@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tranzaksiyalar</h1>
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Shartnoma nomi va kontrakti</th>
                <th>Qoldiq</th>
                <th>Kirim</th>
                <th>Amallar</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->agreement->service_name }} : {{ $transaction->agreement->contract }}</td>
                    <td>{{ $transaction->residual }}</td>
                    <td>{{ $transaction->profit }}</td>
                    <td>
                        @if ($transaction->residual > 0 || $transaction->profit == 0)
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTransactionModal"
                                    data-id="{{ $transaction->id }}"
                                    data-agreement-id="{{ $transaction->agreement_id }}"
                                    data-profit="{{ $transaction->profit }}">
                                To'lov qilish
                            </button>
                        @else
                            <button type="button" class="btn btn-secondary" disabled>To'lov qilish</button>
                        @endif
                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">O'chirish</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tahrirlash Modal -->
    <div class="modal fade" id="editTransactionModal" tabindex="-1" aria-labelledby="editTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTransactionModalLabel">Tranzaksiyani Tahrirlash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTransactionForm" action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        <input type="hidden" name="agreement_id" id="edit_agreement_id">
                        <div class="form-group">
                            <label for="edit_profit">Kirim</label>
                            <input type="number" name="profit" id="edit_profit" class="form-control" step="0.01" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Saqlash</button>
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
            const profit = parseFloat(button.getAttribute('data-profit'));

            const idInput = editTransactionModal.querySelector('#edit_id');
            const agreementInput = editTransactionModal.querySelector('#edit_agreement_id');
            const profitInput = editTransactionModal.querySelector('#edit_profit');

            idInput.value = id;
            agreementInput.value = agreementId;
            profitInput.value = ''; // Input maydonini tozalash
        });

        document.getElementById('editTransactionForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Formani odatiy tarzda yuborishni to'xtatish

            const id = document.querySelector('#edit_id').value;
            const agreementId = document.querySelector('#edit_agreement_id').value;
            const newProfit = parseFloat(document.querySelector('#edit_profit').value);

            // Serverga yangilangan kirimni yuborish (AJAX orqali yoki form orqali)
            document.querySelector('#editTransactionForm').submit();
        });
    </script>
@endsection
