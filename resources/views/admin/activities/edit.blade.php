@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Faoliyatni Tahrirlash</h1>
        <form action="{{ route('activities.update', $activity->id) }}" method="POST" enctype="multipart/form-data" onsubmit="updateEditorContent()">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="activity_type">Faoliyat Turi</label>
                <select name="activity_type" class="form-control" id="activity_type" required>
                    <option value="meeting" {{ $activity->activity_type == 'meeting' ? 'selected' : '' }}>Uchrashuv</option>
                    <option value="call" {{ $activity->activity_type == 'call' ? 'selected' : '' }}>Qo'ng'iroq</option>
                    <option value="email" {{ $activity->activity_type == 'email' ? 'selected' : '' }}>Elektron Pochta</option>
                    <option value="task" {{ $activity->activity_type == 'task' ? 'selected' : '' }}>Vazifa</option>
                    <option value="other" {{ $activity->activity_type == 'other' ? 'selected' : '' }}>Boshqa</option>
                </select>
            </div>

            <div class="form-group">
                <label for="activity_date">Faoliyat Sanasi</label>
                <input type="date" name="activity_date" class="form-control" id="activity_date" value="{{ $activity->activity_date }}">
            </div>

            <div class="form-group">
                <label for="user_id">Xodim</label>
                <select name="user_id" class="form-control" id="user_id">
                    @foreach($users as $staff)
                        <option value="{{ $staff->id }}" {{ $activity->user_id == $staff->id ? 'selected' : '' }}>{{ $staff->name }}</option>
                    @endforeach
                </select>
            </div>

{{--            <div class="form-group">--}}
{{--                <label for="client_id">Mijoz</label>--}}
{{--                <select name="client_id" class="form-control" id="client_id">--}}
{{--                    <option value="">Mijozni Tanlang</option>--}}
{{--                    @foreach($clients as $client)--}}
{{--                        <option value="{{ $client->id }}" {{ $activity->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}

            <div class="form-group">
                <label for="project_id">Loyiha</label>
                <select name="project_id" class="form-control" id="project_id">
                    <option value="">Loyihani Tanlang</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ $activity->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Tavsif</h4>
                                <div id="editor_uz" style="height: 300px;">
                                    <!-- Quill editor mazmuni -->
                                </div>
                                <input type="hidden" name="description" id="description_uz" value="{{ $activity->description }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row form-group">
                @foreach($activity->images as $image)
                    <div class="col-md-3">
                        <img src="{{ asset('storage/' . $image->image) }}" alt="Faoliyat Rasmi" class="img-thumbnail">
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label for="images">Qo'shimcha Rasmlar</label>
                <input type="file" name="images[]" class="form-control" id="images" multiple>
            </div>

            <button type="submit" class="btn btn-primary">Yangilash</button>
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

        // Tahrir shakli uchun mavjud mazmun bilan tahrirlashni boshlash
        editorUz.root.innerHTML = document.getElementById('description_uz').value;

        // updateEditorContent() funksiyasining to'g'ri chaqirilishini ta'minlash
        document.querySelector('form').addEventListener('submit', function (event) {
            updateEditorContent();
        });
    </script>

@endsection
