{{-- resources/views/backend/designs/create.blade.php --}}
@extends('backend.layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Tambah Template Baru</h2>

    <form action="{{ route('designs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Template</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="preview_image" class="form-label">Gambar Preview</label>
            <input type="file" name="preview_image" id="preview_image" class="form-control" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label for="view_path" class="form-label">View Path</label>
            <input type="text" name="view_path" id="view_path" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
