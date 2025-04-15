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
                <label for="bride_parents_info" class="form-label">Orang Tua Mempelai Wanita</label>
                <input type="text" name="bride_parents_info" id="bride_parents_info" class="form-control"
                    placeholder="Contoh: Putri dari Ayah X dan Ibu Y">
            </div>
        
            <div class="mb-3">
                <label for="groom_parents_info" class="form-label">Orang Tua Mempelai Pria</label>
                <input type="text" name="groom_parents_info" id="groom_parents_info" class="form-control"
                    placeholder="Contoh: Putra dari Ayah A dan Ibu B">
            </div>
        
            <div class="mb-3">
                <label for="akad_date" class="form-label">Tanggal & Waktu Akad</label>
                <input type="datetime-local" name="akad_date" id="akad_date" class="form-control" required>
            </div>
        
            <div class="mb-3">
                <label for="reception_date" class="form-label">Tanggal & Waktu Resepsi</label>
                <input type="datetime-local" name="reception_date" id="reception_date" class="form-control" required>
            </div>
        
            <div class="mb-3">
                <label for="place_name" class="form-label">Tempat Acara</label>
                <input type="text" name="place_name" id="place_name" class="form-control" required>
            </div>
        
            <div class="mb-3">
                <label for="location" class="form-label">Alamat Lengkap</label>
                <input type="text" name="location" id="location" class="form-control" required>
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
                        <option value="{{ $template->id }}">{{ $template->name }}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="mb-3">
                <label for="music_id" class="form-label">Pilih Musik Latar</label>
                <select name="music_id" id="music_id" class="form-select">
                    <option value="">-- Tidak Ada Musik --</option>
                    @foreach($musics as $music)
                        <option value="{{ $music->id }}">{{ $music->title }} - {{ $music->artist }}</option>
                    @endforeach
                </select>
            </div>
        
            <button type="submit" class="btn btn-primary">Pesan Undangan</button>
        </form>
        
    </div>

</section><!-- /Starter Section Section -->
@endsection
