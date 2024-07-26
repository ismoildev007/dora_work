@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Xabarni Tahrirlash</h1>
    <form action="{{ route('messages.update', $message->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="conversation_id">Muloqot ID</label>
            <input type="number" name="conversation_id" class="form-control" id="conversation_id" value="{{ $message->conversation_id }}" required>
        </div>
        <div class="form-group">
            <label for="sender_id">Yuboruvchi ID</label>
            <input type="number" name="sender_id" class="form-control" id="sender_id" value="{{ $message->sender_id }}" required>
        </div>
        <div class="mt-3">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Mazmuni</h4>
                            <div id="editor_uz" style="height: 300px;">
                                <!-- Quill tahrirchisi mazmuni -->
                            </div>
                            <input type="hidden" name="content" id="content" value="{{ $message->content }}">
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

            // Tahrirchining mazmunini mavjud qiymatga o‘rnatish
            editorUz.root.innerHTML = document.getElementById('content').value;

            function updateEditorContent() {
                document.getElementById('content').value = editorUz.root.innerHTML;
            }

            // Formani yuborishda yashirin inputni yangilash
            document.querySelector('form').addEventListener('submit', updateEditorContent);
        </script>

        <button type="submit" class="btn btn-primary">Yangilash</button>
    </form>
</div>
@endsection
