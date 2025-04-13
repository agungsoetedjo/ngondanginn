@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Edit Template: {{ $template->name }}</h4>
    </div>

    @include('backend.designs._form', ['template' => $template])
</div>

<script>
    // Fungsi untuk menampilkan preview gambar yang dipilih
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview');
            output.src = reader.result; // Update src image dengan gambar baru
            output.style.display = 'block'; // Pastikan gambar preview ditampilkan
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Fungsi untuk otomatis mengupdate view_path berdasarkan nama template
    function generateViewPath() {
        var name = document.getElementById('name').value;

        // Pastikan view_path selalu dimulai dengan 'designs.'
        var viewPath = 'designs.' + name.toLowerCase().replace(/\s+/g, '-');

        // Pastikan tidak ada kata '.blade.php', '.php', atau 'blade' pada viewPath
        viewPath = viewPath.replace(/\.blade\.php$|\.php$|blade/g, '');

        // Update view_path hanya jika belum ada 'designs.' di depannya
        if (!viewPath.startsWith('designs.')) {
            viewPath = 'designs.' + viewPath;
        }

        document.getElementById('view_path').value = viewPath;
    }

    // Panggil generateViewPath saat halaman dimuat pertama kali
    window.onload = function() {
        generateViewPath();  // Memanggil fungsi untuk update view_path saat halaman dimuat

        // Trigger generateViewPath setiap kali ada inputan nama template (di halaman edit)
        document.getElementById('name').addEventListener('input', generateViewPath);
    };
</script>

@endsection
