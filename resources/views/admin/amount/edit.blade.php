@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Amount</h1>
        <form action="{{ route('amounts.update', $amount->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="project_id">Project</label>
                <select name="project_id" id="project_id" class="form-control">
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ $project->id == $amount->project_id ? 'selected' : '' }}>{{ $project->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status_id">Status</label>
                <select name="status_id" id="status_id" class="form-control">
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ $status->id == $amount->status_id ? 'selected' : '' }}>{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="profit">Profit</label>
                <input type="number" name="profit" id="profit" class="form-control" value="{{ $amount->profit }}">
            </div>
            <div class="form-group">
                <label for="outlay">Outlay</label>
                <input type="number" name="outlay" id="outlay" class="form-control" value="{{ $amount->outlay }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
