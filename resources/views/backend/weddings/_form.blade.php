<!-- Row untuk Nama Mempelai -->
<div class="row">
  <div class="mb-3 col-md-6">
    <label for="bride_name" class="form-label">Nama Mempelai Wanita</label>
    <input type="text" name="bride_name" id="bride_name" class="form-control"
        value="{{ old('bride_name', $wedding->bride_name ?? '') }}" required>
  </div>

  <div class="mb-3 col-md-6">
    <label for="groom_name" class="form-label">Nama Mempelai Pria</label>
    <input type="text" name="groom_name" id="groom_name" class="form-control"
        value="{{ old('groom_name', $wedding->groom_name ?? '') }}" required>
  </div>
</div>

<!-- Nama Orang Tua Mempelai -->
<div class="row">
  <div class="mb-3 col-md-6">
    <label for="bride_parents_info" class="form-label">Orang Tua Mempelai Wanita</label>
    <input type="text" name="bride_parents_info" id="bride_parents_info" class="form-control"
        placeholder="Contoh: Putri dari Ayah X dan Ibu Y"
        value="{{ old('bride_parents_info', $wedding->bride_parents_info ?? '') }}">
  </div>
  <div class="mb-3 col-md-6">
    <label for="groom_parents_info" class="form-label">Orang Tua Mempelai Pria</label>
    <input type="text" name="groom_parents_info" id="groom_parents_info" class="form-control"
        placeholder="Contoh: Putra dari Ayah A dan Ibu B"
        value="{{ old('groom_parents_info', $wedding->groom_parents_info ?? '') }}">
  </div>
</div>

<!-- Tanggal & Waktu Akad -->
<div class="mb-3 col-md-6">
  <label for="akad_date" class="form-label">Tanggal & Waktu Akad</label>
  <input type="datetime-local" name="akad_date" id="akad_date" class="form-control"
      value="{{ old('akad_date', isset($wedding->akad_date) ? \Carbon\Carbon::parse($wedding->akad_date)->format('Y-m-d\TH:i') : '') }}">
</div>

<!-- Tanggal & Waktu Resepsi -->
<div class="mb-3 col-md-6">
  <label for="reception_date" class="form-label">Tanggal & Waktu Resepsi</label>
  <input type="datetime-local" name="reception_date" id="reception_date" class="form-control"
      value="{{ old('reception_date', isset($wedding->reception_date) ? \Carbon\Carbon::parse($wedding->reception_date)->format('Y-m-d\TH:i') : '') }}">
</div>

<!-- Lokasi -->
<div class="row">
  <div class="mb-3 col-md-6">
    <label for="place_name" class="form-label">Nama Tempat Acara</label>
    <input type="text" name="place_name" id="place_name" class="form-control"
        value="{{ old('place_name', $wedding->place_name ?? '') }}">
  </div>

  <div class="mb-3 col-md-6">
    <label for="location" class="form-label">Alamat Lengkap</label>
    <input type="text" name="location" id="location" class="form-control"
        value="{{ old('location', $wedding->location ?? '') }}" required>
  </div>
</div>

<!-- Nomor HP -->
<div class="mb-3">
  <label for="phone_number" class="form-label">Nomor HP Pemesan</label>
  <input type="text" name="phone_number" id="phone_number" class="form-control"
      value="{{ old('phone_number', $wedding->order->phone_number ?? '') }}" required>
</div>

<!-- Deskripsi -->
<div class="mb-3">
  <label for="description" class="form-label">Deskripsi Singkat</label>
  <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $wedding->description ?? '') }}</textarea>
</div>

<!-- Template -->
@if(isset($wedding) && $wedding->order && $wedding->order->status === 'pending')
    <div class="mb-3">
        <label for="template_id" class="form-label">Pilih Template</label>
        <select name="template_id" id="template_id" class="form-select" required>
            <option value="">-- Pilih Template --</option>
            @foreach($templates as $template)
                <option value="{{ $template->id }}" 
                    {{ old('template_id', $wedding->template_id ?? '') == $template->id ? 'selected' : '' }}>
                    {{ $template->name }}
                </option>
            @endforeach
        </select>
    </div>
@else
    <div class="mb-3">
        <label for="template_id" class="form-label">Template Undangan</label>
        <input type="hidden" name="template_id" value="{{ $wedding->template_id ?? '' }}">
        <input type="text" class="form-control" value="{{ $wedding->template->name ?? 'Template sudah dipilih' }}" readonly>
    </div>
@endif

<!-- Musik -->
<div class="mb-3">
  <label for="music_id" class="form-label">Pilih Musik Latar</label>
  <select name="music_id" id="music_id" class="form-select">
    <option value="">-- Tidak Ada Musik --</option>
    @foreach($musics as $music)
      <option value="{{ $music->id }}"
        {{ old('music_id', $wedding->music_id ?? '') == $music->id ? 'selected' : '' }}>
        {{ $music->title }} - {{ $music->artist }}
      </option>
    @endforeach
  </select>
</div>

<!-- Tombol -->
<div class="mt-3">
  <button type="submit" class="btn btn-primary">{{ $submitLabel ?? 'Simpan' }}</button>
  <a href="{{ route('weddings.index') }}" class="btn btn-secondary">Kembali</a>
</div>
