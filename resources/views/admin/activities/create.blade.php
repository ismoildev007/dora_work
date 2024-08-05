@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Vazifalar biriktirish</h1>
    <form action="{{ route('activities.store') }}" method="POST" enctype="multipart/form-data" onsubmit="updateEditorContent()">
        @csrf
        <div class="mt-3">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Tavsif</h4>
                            <div id="editor_uz" style="height: 300px;"></div>
                            <input type="hidden" name="description" id="description_uz">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="activity_type" class="">Vazifa Turi</label>
            <select name="activity_type" id="activity_type" class="form-control" required>
                <option value="Figma">Figma chizish</option>
                <option value="Web-site">Web-site</option>
                <option value="Smm xizmati">Smm xizmati</option>
                <option value="Vide mantaj">Vide mantaj</option>
                <option value="Mobilo graf">Mobilo graf</option>
            </select>
        </div>
        <div class="form-group">
            <label for="activity_date" class=" mt-3">Qabul qilish sanasi (deadline)</label>
            <input type="date" name="activity_date" id="activity_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="user_ids" class=" mt-3">Xodimlar</label>
            <select name="user_ids[]" id="user_ids" class="form-control" multiple>
                @foreach($users as $staff)
                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="project_id" class=" mt-3">Loyiha</label>
            <select name="project_id" id="project_id" class="form-control">
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->client->company_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="images" class="form-label mt-3">Rasmlar (Bir nechta fayllarni tanlashingiz mumkin)</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Vazifani Yaratish</button>
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
