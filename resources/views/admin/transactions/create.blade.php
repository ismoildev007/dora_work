@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Transaction</h1>
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="agreement_id">Agreement</label>
                <select name="agreement_id" id="agreement_id" class="form-control" required>
                    @foreach($agreements as $agreement)
                        <option value="{{ $agreement->id }}">{{ $agreement->service_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="profit">Profit</label>
                <input type="number" name="profit" id="profit" class="form-control" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
