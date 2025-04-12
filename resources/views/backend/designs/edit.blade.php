{{-- resources/views/backend/designs/edit.blade.php --}}
@extends('backend.layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Template</h2>

    <form action="{{ route('designs.update', $template->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Template</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $template->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="preview_image" class="form-label">Gambar Preview</label>
            <input type="file" name="preview_image" id="preview_image" class="form-control" accept="image/*">
            @if($template->preview_image)
                <img src="{{ asset('images/templates/' . $template->preview_image) }}" alt="Preview" style="max-width: 150px; margin-top: 10px;">
            @endif
        </div>

        <div class="mb-3">
            <label for="view_path" class="form-label">View Path</label>
            <input type="text" name="view_path" id="view_path" class="form-control" value="{{ old('view_path', $template->view_path) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
