@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Foydalanuvchi yaratish</h1>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            @include('admin.users.partials.form', ['submitButtonText' => 'Create User'])
        </form>
    </div>
@endsection
