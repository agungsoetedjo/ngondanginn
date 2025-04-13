@extends('backend.layouts.app')

@section('content')
<div class="container mt-5">
    <h4>Tambah Template Baru</h4>

    @include('backend.designs._form')
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
        var viewPath = name.toLowerCase().replace(/\s+/g, '-');

        // Pastikan viewPath dimulai dengan 'designs.' jika belum ada
        if (!viewPath.startsWith('designs.')) {
            viewPath = 'designs.' + viewPath;
        }

        // Pastikan tidak ada kata '.blade.php', '.php', atau 'blade' pada viewPath
        viewPath = viewPath.replace(/\.blade\.php$|\.php$|blade/g, '');

        document.getElementById('view_path').value = viewPath;
    }

    // Panggil generateViewPath saat halaman dimuat pertama kali
    window.onload = function() {
        generateViewPath();  // Memanggil fungsi untuk update view_path saat halaman dimuat

        // Trigger generateViewPath setiap kali ada inputan nama template (di halaman create)
        document.getElementById('name').addEventListener('input', generateViewPath);
    };
</script>

@endsection
