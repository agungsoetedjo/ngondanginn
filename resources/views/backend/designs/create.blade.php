@extends('backend.layouts.app')

@section('content')
<div class="container mt-5">
    <h4>Tambah Template Baru</h4>

    <form action="{{ route('designs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama Template -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama Template</label>
            <input type="text" name="name" id="name" class="form-control" required oninput="generateViewPath()">
        </div>

        <!-- Gambar Preview -->
        <div class="mb-3">
            <label for="preview_image" class="form-label">Gambar Preview</label>
            <input type="file" name="preview_image" id="preview_image" class="form-control" accept="image/*" required onchange="previewImage(event)">
            <div class="mt-2">
                <img id="preview" src="#" alt="Preview" style="display: none;" width="120">
            </div>
        </div>

        <!-- View Path -->
        <div class="mb-3">
            <label for="view_path" class="form-label">View Path</label>
            <input type="text" name="view_path" id="view_path" class="form-control" required readonly>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    function generateViewPath() {
        let name = document.getElementById('name').value;
        let viewPath = 'designs.' + name.toLowerCase().replace(/\s+/g, '-');

        // Hapus .blade.php jika ada
        if (viewPath.endsWith('.blade.php')) {
            viewPath = viewPath.replace('.blade.php', '');
        }

        document.getElementById('view_path').value = viewPath;
    }

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Auto-generate view path saat pertama kali load
    window.onload = generateViewPath;
</script>
@endsection
