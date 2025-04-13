@extends('backend.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Template: {{ $template->name }}</h2>
    </div>

    <form action="{{ route('designs.update', $template->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Input untuk Nama Template -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama Template</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $template->name) }}" required oninput="generateViewPath()">
        </div>

        <!-- Input untuk View Path -->
        <div class="mb-3">
            <label for="view_path" class="form-label">View Path</label>
            <input type="text" class="form-control" id="view_path" name="view_path" value="{{ old('view_path', 'design.' . $template->view_path) }}" required readonly>
        </div>

        <!-- Input untuk Gambar Preview -->
        <div class="mb-3">
            <label for="preview_image" class="form-label">Gambar Preview</label>
            <input type="file" class="form-control" id="preview_image" name="preview_image" onchange="previewImage(event)">
            
            @if($template->preview_image)
                <div class="mt-2">
                    <img id="preview" src="{{ asset('images/templates/' . $template->preview_image) }}" alt="Preview" width="120">
                </div>
            @else
                <div class="mt-2">
                    <em>Tidak ada gambar preview</em>
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Template</button>
    </form>
</div>

<script>
    // Fungsi untuk menampilkan preview gambar yang dipilih
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview');
            output.src = reader.result; // Update src image dengan gambar baru
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Fungsi untuk otomatis mengupdate view_path berdasarkan nama template
    function generateViewPath() {
        var name = document.getElementById('name').value;
        var viewPath = 'design.' + name.toLowerCase().replace(/\s+/g, '-');

        // Pastikan view_path tidak diakhiri dengan '.blade.php'
        if (viewPath.endsWith('.blade.php')) {
            viewPath = viewPath.replace('.blade.php', ''); // Menghapus '.blade.php' jika ada
        }

        document.getElementById('view_path').value = viewPath;
    }

    // Panggil generateViewPath saat halaman dimuat pertama kali
    window.onload = generateViewPath;
</script>

@endsection
