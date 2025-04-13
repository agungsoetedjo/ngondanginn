<!-- Row untuk Mempelai Wanita dan Pria -->
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
  
  <!-- Tanggal dan Waktu Pernikahan -->
  <div class="mb-3">
    <label for="wedding_date" class="form-label">Tanggal dan Waktu Pernikahan</label>
    <input type="datetime-local" name="wedding_date" id="wedding_date" class="form-control"
        value="{{ old('wedding_date', $wedding_date ?? '') }}" required>
  </div>
  
  <!-- Row untuk Nama Tempat & Lokasi -->
  <div class="row">
    <div class="mb-3 col-md-6">
      <label for="place_name" class="form-label">Nama Tempat Acara</label>
      <input type="text" name="place_name" id="place_name" class="form-control"
          value="{{ old('place_name', $wedding->place_name ?? '') }}" required>
    </div>
  
    <div class="mb-3 col-md-6">
      <label for="location" class="form-label">Alamat Lengkap</label>
      <input type="text" name="location" id="location" class="form-control"
          value="{{ old('location', $wedding->location ?? '') }}" required>
    </div>
  </div>
  
  <!-- Deskripsi -->
  <div class="mb-3">
    <label for="description" class="form-label">Deskripsi Singkat</label>
    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $wedding->description ?? '') }}</textarea>
  </div>
  
  <!-- Template -->
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
  
  <!-- Tombol -->
  <button type="submit" class="btn btn-primary">{{ $submitLabel ?? 'Simpan' }}</button>
  <a href="{{ route('weddings.index') }}" class="btn btn-secondary">Kembali</a>
  