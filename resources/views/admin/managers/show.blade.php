@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menejer Tafsilotlari</h1>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $manager->user->name }}</h4>
            <p><strong>Bo‘lim:</strong> {{ $manager->department }}</p>
            <p><strong>Telefon Raqami:</strong> {{ $manager->phone_number }}</p>
            <a href="{{ route('managers.index') }}" class="btn btn-secondary">Ro‘yxatga Qaytish</a>
            <a href="{{ route('managers.edit', $manager->id) }}" class="btn btn-warning">Tahrirlash</a>
            <form action="{{ route('managers.destroy', $manager->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">O‘chirish</button>
            </form>
        </div>
    </div>
</div>
@endsection
