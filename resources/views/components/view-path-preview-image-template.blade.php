<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    function generateViewPath() {
        const nameInput = document.getElementById('name');
        const categorySelect = document.getElementById('category_id');
        const viewPathInput = document.getElementById('view_path');

        if (!nameInput || !categorySelect || !viewPathInput) return;

        const name = nameInput.value.trim().toLowerCase().replace(/\s+/g, '-');  // Ganti spasi jadi '-'

        const selectedOption = categorySelect.options[categorySelect.selectedIndex];
        const categoryName = selectedOption?.getAttribute('data-name')?.toLowerCase().replace(/\s+/g, '_') || '';
        const categoryType = selectedOption?.getAttribute('data-type')?.toLowerCase().replace(/\s+/g, '_') || '';

        const combined = categoryName && categoryType ? categoryName + '_' + categoryType : '';

        let viewPath = 'template_packs';
        if (combined) viewPath += '.' + combined;
        if (name) viewPath += '.' + name;

        viewPathInput.value = viewPath.replace(/\.blade\.php$|\.php$|blade/g, '');
    }

    window.addEventListener('DOMContentLoaded', () => {
        generateViewPath();
        document.getElementById('name').addEventListener('input', generateViewPath);
        document.getElementById('category_id').addEventListener('change', generateViewPath);
    });
</script>