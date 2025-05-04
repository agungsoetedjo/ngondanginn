<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
