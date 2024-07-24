@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit User</h1>
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.users.partials.form', ['submitButtonText' => 'Update User'])
        </form>
    </div>
@endsection
