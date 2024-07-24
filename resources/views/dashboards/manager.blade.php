<!-- resources/views/dashboards/manager.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manager Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }}! You have manager-level access.</p>
</div>
@endsection
