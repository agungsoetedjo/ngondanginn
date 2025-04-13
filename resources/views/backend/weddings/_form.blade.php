<div class="mb-3">
    <label for="bride_name" class="form-label">Nama Mempelai Wanita</label>
    <input type="text" name="bride_name" class="form-control" value="{{ old('bride_name', $wedding->bride_name ?? '') }}" required>
  </div>
  
  <div class="mb-3">
    <label for="groom_name" class="form-label">Nama Mempelai Pria</label>
    <input type="text" name="groom_name" class="form-control" value="{{ old('groom_name', $wedding->groom_name ?? '') }}" required>
  </div>
  
  <div class="mb-3">
    <label for="wedding_date" class="form-label">Tanggal & Waktu Pernikahan</label>
    <input type="datetime-local" name="wedding_date" class="form-control" value="{{ old('wedding_date', isset($wedding) ? $wedding->wedding_date->format('Y-m-d\TH:i') : '') }}" required>
  </div>
  
  <div class="mb-3">
    <label for="location" class="form-label">Lokasi</label>
    <input type="text" name="location" class="form-control" value="{{ old('location', $wedding->location ?? '') }}" required>
  </div>
  
  <div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea name="description" class="form-control">{{ old('description', $wedding->description ?? '') }}</textarea>
  </div>
  
  <div class="mb-3">
    <label for="template_id" class="form-label">Pilih Template</label>
    <select name="template_id" id="template_id" class="form-control">
        @foreach($templates as $template)
            <option value="{{ $template->id }}" {{ $template->id == $wedding->template_id ? 'selected' : '' }}>
                {{ $template->name }}
            </option>
        @endforeach
    </select>
  </div>

  <button type="submit" class="btn btn-success">Simpan</button>
  <a href="{{ route('weddings.index') }}" class="btn btn-secondary">Kembali</a>
  