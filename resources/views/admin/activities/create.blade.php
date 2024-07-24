@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Activity</h1>
    <form action="{{ route('activities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mt-3">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Description_uz</h4>
                            <div id="editor_uz" style="height: 300px;">
                                <!-- Quill editor content -->
                            </div>
                            <input type="hidden" name="description" id="description_uz">
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div><!-- end col -->
            </div>
        </div>
        <div class="form-group">
            <label for="activity_type">Activity Type</label>
            <select name="activity_type" id="activity_type" class="form-control" required>
                <option value="meeting">Meeting</option>
                <option value="call">Call</option>
                <option value="email">Email</option>
                <option value="task">Task</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="activity_date">Activity Date</label>
            <input type="date" name="activity_date" id="activity_date" class="form-control" required>
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
            <label for="images">Images (You can select multiple files)</label>
            <input type="file" name="images[]" id="images" class="form-control-file" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Create Activity</button>
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
</script>
@endsection