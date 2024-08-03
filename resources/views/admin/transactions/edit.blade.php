@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($transaction) ? 'Edit' : 'Create' }} Transaction</h1>
        <form action="{{ isset($transaction) ? route('transactions.update', $transaction->id) : route('transactions.store') }}" method="POST">
            @csrf
            @if(isset($transaction))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="agreement_id">Agreement</label>
                <select name="agreement_id" id="agreement_id" class="form-control" required>
                    @foreach($agreements as $agreement)
                        <option value="{{ $agreement->id }}" {{ (isset($transaction) && $transaction->agreement_id == $agreement->id) ? 'selected' : '' }}>
                            {{ $agreement->service_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="profit">Profit</label>
                <input type="number" name="profit" id="profit" class="form-control" step="0.01" value="{{ isset($transaction) ? $transaction->profit : '' }}" required>
            </div>
            <div class="form-group">
                <label for="residual">Residual</label>
                <input type="number" name="residual" id="residual" class="form-control" step="0.01" value="{{ isset($transaction) ? $transaction->residual : '' }}" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($transaction) ? 'Update' : 'Create' }}</button>
        </form>
    </div>
@endsection
