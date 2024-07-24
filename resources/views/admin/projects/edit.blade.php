@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Project</h1>
        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" onsubmit="updateEditorContent()">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $project->name }}" required>
            </div>
            <div class="mt-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Description</h4>
                                <div id="editor_uz" style="height: 300px;">
                                    <!-- Quill editor content -->
                                </div>
                                <input type="hidden" name="description" id="description_uz" value="{{ $project->description }}">
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div><!-- end col -->
                </div>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" class="form-control" id="start_date" value="{{ $project->start_date }}">
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" class="form-control" id="end_date" value="{{ $project->end_date }}">
            </div>
            <div class="form-group">
                <label for="client_id">Client</label>
                <select name="client_id" class="form-control" id="client_id">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $project->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="manager_id">Manager</label>
                <select name="manager_id" class="form-control" id="manager_id">
                    @foreach($managers as $manager)
                        <option value="{{ $manager->id }}" {{ $project->manager_id == $manager->id ? 'selected' : '' }}>{{ $manager->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status" required>
                    <option value="planned" {{ $project->status == 'planned' ? 'selected' : '' }}>Planned</option>
                    <option value="active" {{ $project->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="on_hold" {{ $project->status == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                </select>
            </div>
            <div class="row form-group">
                @foreach($project->images as $image)
                    <div class="col-md-3">
                        <img src="{{ asset('storage/' . $image->image) }}" alt="Activity Image" class="img-thumbnail">
{{--                        <form action="{{ route('project-images.destroy', $image->id) }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
{{--                            <button type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>--}}
{{--                        </form>--}}
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <script>
        var editorUz = new Quill('#editor_uz', {
            theme: 'snow'
        });

        function updateEditorContent() {
            document.getElementById('description_uz').value = editorUz.root.innerHTML;
        }

        // Initialize the editor with existing content for edit form
        editorUz.root.innerHTML = document.getElementById('description_uz').value;
    </script>
@endsection
