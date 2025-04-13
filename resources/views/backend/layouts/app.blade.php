<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Tambahkan meta ini -->
  <title>Dashboard - Undangan Digital</title>
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
</head>
<body>
  @include('backend.layouts.nav')
  <main class="mt-4 pt-5 pb-5">
    @yield('content')
  </main>

  @include('backend.layouts.footer')

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>       
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
