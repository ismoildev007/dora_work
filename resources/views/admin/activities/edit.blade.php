@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Activity</h1>
    <form action="{{ route('activities.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mt-3">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Description_uz</h4>
                            <div id="editor_uz" style="height: 300px;">
                                <!-- Quill editor content -->
                                {!! old('description', $activity->description) !!}
                            </div>
                            <input type="hidden" name="description" id="description_uz" value="{{ old('description', $activity->description) }}">
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div><!-- end col -->
            </div>
        </div>
        <div class="form-group">
            <label for="activity_type">Activity Type</label>
            <select name="activity_type" id="activity_type" class="form-control" required>
                <option value="meeting" {{ $activity->activity_type == 'meeting' ? 'selected' : '' }}>Meeting</option>
                <option value="call" {{ $activity->activity_type == 'call' ? 'selected' : '' }}>Call</option>
                <option value="email" {{ $activity->activity_type == 'email' ? 'selected' : '' }}>Email</option>
                <option value="task" {{ $activity->activity_type == 'task' ? 'selected' : '' }}>Task</option>
                <option value="other" {{ $activity->activity_type == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="activity_date">Activity Date</label>
            <input type="date" name="activity_date" id="activity_date" class="form-control" required value="{{ old('activity_date', $activity->activity_date->format('Y-m-d')) }}">
        </div>
        <div class="form-group">
            <label for="staff_id">Staff</label>
            <select name="staff_id" id="staff_id" class="form-control">
                <!-- Populate staff options here -->
            </select>
        </div>
        <div class="form-group">
            <label for="client_id">Client</label>
            <select name="client_id" id="client_id" class="form-control">
                <!-- Populate client options here -->
            </select>
        </div>
        <div class="form-group">
            <label for="project_id">Project</label>
            <select name="project_id" id="project_id" class="form-control">
                <!-- Populate project options here -->
            </select>
        </div>
        <div class="form-group">
            <label for="images">Upload New Images (You can select multiple files)</label>
            <input type="file" name="images[]" id="images" class="form-control-file" multiple>
        </div>
        <div class="form-group">
            <label>Existing Images</label>
            <div class="row">
                @foreach($activity->images as $image)
                    <div class="col-md-3">
                        <img src="{{ Storage::url($image->image_path) }}" alt="Activity Image" class="img-thumbnail">
                        <form action="{{ route('activity-images.destroy', $image->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Activity</button>
    </form>
</div>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<script>
    var editorUz = new Quill('#editor_uz', {
        theme: 'snow'
    });

    // Initialize the editor with existing content
    editorUz.root.innerHTML = document.getElementById('description_uz').value;

    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('description_uz').value = editorUz.root.innerHTML;
    });
</script>
@endsection
