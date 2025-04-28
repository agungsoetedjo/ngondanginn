<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Tambahkan meta ini -->
  <title>Dashboard - Undangan Digital</title>
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
  <style>
    /* Global styling untuk memperkecil ukuran font di seluruh halaman */
    body {
        font-size: 0.875rem; /* Ukuran font global */
    }

    h1, h2, h3, h4, h5, h6 {
        font-size: 1.25rem; /* Ukuran font untuk heading */
    }

    .container {
        font-size: 0.875rem;
    }

    .table th, .table td {
        font-size: 0.875rem;
    }

    .btn {
        font-size: 0.875rem;
    }

    .form-control {
        font-size: 0.875rem;
    }

    .pagination {
        font-size: 0.875rem;
    }

    .navbar {
        font-size: 0.875rem;
    }
</style>
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
  <x-sweet-alert-notify />
</body>
</html>