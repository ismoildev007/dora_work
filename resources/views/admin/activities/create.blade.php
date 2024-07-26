@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Faoliyat Yaratish</h1>
        <form action="{{ route('activities.store') }}" method="POST" enctype="multipart/form-data" onsubmit="updateEditorContent()">
            @csrf
            <div class="mt-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Tavsif</h4>
                                <div id="editor_uz" style="height: 300px;">
                                    <!-- Quill editor mazmuni -->
                                </div>
                                <input type="hidden" name="description" id="description_uz">
                            </div> <!-- karta tanasining oxiri -->
                        </div> <!-- karta oxiri -->
                    </div><!-- ustun oxiri -->
                </div>
            </div>
            <div class="form-group">
                <label for="activity_type">Faoliyat Turi</label>
                <select name="activity_type" id="activity_type" class="form-control" required>
                    <option value="meeting">Uchrashuv</option>
                    <option value="call">Qo'ng'iroq</option>
                    <option value="email">Elektron Pochta</option>
                    <option value="task">Vazifa</option>
                    <option value="other">Boshqa</option>
                </select>
            </div>
            <div class="form-group">
                <label for="activity_date">Faoliyat Sanasi</label>
                <input type="date" name="activity_date" id="activity_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="staff_id">Xodim</label>
                <select name="staff_id" id="staff_id" class="form-control">
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}">{{ $staff->user->name }}</option>
                    @endforeach
                </select>
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="client_id">Mijoz</label>--}}
{{--                <select name="client_id" id="client_id" class="form-control">--}}
{{--                    @foreach($clients as $client)--}}
{{--                        <option value="{{ $client->id }}">{{ $client->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
            <div class="form-group">
                <label for="project_id">Loyiha</label>
                <select name="project_id" id="project_id" class="form-control">
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="images">Rasmlar (Bir nechta fayllarni tanlashingiz mumkin)</label>
                <input type="file" name="images[]" id="images" class="form-control-file" multiple>
            </div>
            <button type="submit" class="btn btn-primary">Faoliyatni Yaratish</button>
        </form>
    </div>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <script>
        var editorUz = new Quill('#editor_uz', {
            theme: 'snow'
        });

        function updateEditorContent() {
            var descriptionValue = editorUz.root.innerHTML;
            document.getElementById('description_uz').value = descriptionValue;
            console.log('Tavsif Qiymati:', descriptionValue);
        }
    </script>
@endsection
