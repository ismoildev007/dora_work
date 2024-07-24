<!-- resources/views/dashboards/staff.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Staff Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }}! You have staff-level access.</p>
</div>
@endsection
