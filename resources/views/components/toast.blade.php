{{-- resources/views/components/toast.blade.php --}}
@if (session('toast'))
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      Swal.fire({
        toast: true,
        position: 'bottom',
        icon: '{{ session('toast')['type'] }}',
        title: '{{ session('toast')['message'] }}',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
      });
    });
  </script>
@endif
