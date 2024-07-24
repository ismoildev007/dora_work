@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manager Details</h1>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $manager->user->name }}</h4>
            <p><strong>Department:</strong> {{ $manager->department }}</p>
            <p><strong>Phone Number:</strong> {{ $manager->phone_number }}</p>
            <a href="{{ route('managers.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('managers.edit', $manager->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('managers.destroy', $manager->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
