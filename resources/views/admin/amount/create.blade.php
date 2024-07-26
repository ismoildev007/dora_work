<!-- resources/views/amounts/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Miqdor Yaratish</h1>
        <form action="{{ route('amounts.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="project_id">Loyiha</label>
                <select name="project_id" id="project_id" class="form-control">
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status_id">Holat</label>
                <select name="status_id" id="status_id" class="form-control">
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="profit">Foyda</label>
                <input type="number" name="profit" id="profit" class="form-control">
            </div>
            <div class="form-group">
                <label for="outlay">Xarajat</label>
                <input type="number" name="outlay" id="outlay" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Yaratish</button>
        </form>
    </div>
@endsection
