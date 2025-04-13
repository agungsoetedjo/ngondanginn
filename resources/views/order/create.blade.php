@extends('layouts.app')

@section('content')
<section id="starter-section" class="starter-section section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <span>Pesan Undangan Digital</span>
        <h2>Pesan Undangan Digital</h2>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up">
        <form action="{{ route('order.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="bride_name" class="form-label">Nama Mempelai Wanita</label>
                <input type="text" name="bride_name" id="bride_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="groom_name" class="form-label">Nama Mempelai Pria</label>
                <input type="text" name="groom_name" id="groom_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="wedding_date" class="form-label">Tanggal dan Waktu Pernikahan</label>
                <input type="datetime-local" name="wedding_date" id="wedding_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Lokasi Acara</label>
                <input type="text" name="location" id="location" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="place_name" class="form-label">Tempat Acara</label>
                <input type="text" name="place_name" id="place_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi (Opsional)</label>
                <textarea name="description" id="description" class="form-control" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Nomor HP Pemesan</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="template_id" class="form-label">Pilih Template Undangan</label>
                <select name="template_id" id="template_id" class="form-select" required>
                    <option value="">Pilih Template</option>
                    @foreach($templates as $template)
                        <option value="{{ $template->id }}">{{ $template->name }}</option> <!-- Ganti dengan kolom nama template yang sesuai -->
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Pesan Undangan</button>
        </form>
    </div>

</section><!-- /Starter Section Section -->
@endsection
