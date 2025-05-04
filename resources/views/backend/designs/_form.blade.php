<form action="{{ isset($template) ? route('designs.update', $template->id) : route('designs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @isset($template)
        @method('PUT')
    @endisset
    <div class="mb-3">
        <label for="category_id" class="form-label">Kategori</label>
        <select name="category_id" id="category_id" class="form-select" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" data-type="{{ $category->type }}" 
                    {{ old('category_id', $template->category_id ?? '') == $category->id ? 'selected' : '' }}
                    data-name="{{ $category->name }}" >
                    {{ $category->name }} ({{ str_replace('_', ' ', ucfirst($category->type)) }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Nama Template</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $template->name ?? '') }}" required oninput="generateViewPath()">
    </div>
    
    <!-- View Path -->
    <div class="mb-3">
        <label for="view_path" class="form-label">View Path</label>
        <input type="text" name="view_path" id="view_path" value="{{ old('view_path', $template->view_path ?? '') }}" class="form-control" readonly required>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Harga Template</label>
        <input type="number" name="price" class="form-control" value="{{ old('price', $template->price ?? 0) }}" min="0" required>
    </div>
    
    <!-- Gambar Preview -->
    <div class="mb-3">
        <label for="preview_image" class="form-label">Gambar Preview</label>
        <input type="file" class="form-control" id="preview_image" name="preview_image" onchange="previewImage(event)">
        
        @isset($template)
            @if($template->preview_image)
                <div class="mt-2">
                    <img id="preview" src="{{ asset('images/templates/' . $template->preview_image) }}" alt="Preview" width="120">
                </div>
            @else
                <div class="mt-2">
                    <em>Tidak ada gambar preview</em>
                </div>
            @endif
        @else
            <div class="mt-2">
                <img id="preview" src="#" alt="Preview" style="display: none;" width="120">
            </div>
        @endisset
    </div>

    <!-- Tombol -->
    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            {{ isset($template) ? 'Update Template' : 'Simpan' }}
        </button>
        <a href="{{ route('designs.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

</form>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('category_id');
        const typeInput = document.getElementById('category_type');

        function updateCategoryType() {
            const selectedOption = categorySelect.options[categorySelect.selectedIndex];
            const type = selectedOption.getAttribute('data-type');
            typeInput.value = type || '';
        }

        categorySelect.addEventListener('change', updateCategoryType);

        // Inisialisasi pertama kali (misalnya saat edit)
        updateCategoryType();
    });
</script>
