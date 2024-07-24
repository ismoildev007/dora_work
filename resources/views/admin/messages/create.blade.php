@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Message</h1>
        <form action="{{ route('messages.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="conversation_id">Conversation ID</label>
                <input type="number" name="conversation_id" class="form-control" id="conversation_id" required>
            </div>
            <div class="form-group">
                <label for="sender_id">Sender ID</label>
                <input type="number" name="sender_id" class="form-control" id="sender_id" required>
            </div>
            <div class="mt-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Content</h4>
                                <div id="editor_uz" style="height: 300px;">
                                    <!-- Quill editor content -->
                                </div>
                                <input type="hidden" name="content" id="content">
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div><!-- end col -->
                </div>
            </div>
            <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
            <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

            <script>
                var editorUz = new Quill('#editor_uz', {
                    theme: 'snow'
                });

                function updateEditorContent() {
                    document.getElementById('content').value = editorUz.root.innerHTML;
                }
            </script>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
