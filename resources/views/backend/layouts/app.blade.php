<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Undangan Digital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
</head>
<body>
  @include('backend.layouts.nav')

  <main class="container py-4">
    @yield('content')
  </main>

  @include('backend.layouts.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @if(session('sweetalert'))
    <script>
        $(function() {
            // Ambil tipe dan pesan dari session sweetalert
            var sweetalert = @json(session('sweetalert'));

            Swal.fire({
                icon: sweetalert.type, // 'success' atau 'error'
                title: sweetalert.type === 'error' ? 'Terjadi Kesalahan' : 'Sukses',
                text: sweetalert.message,
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
  @endif
</body>
</html>
