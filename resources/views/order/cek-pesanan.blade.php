@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Cek Status Pesanan</h3>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        </script>
    @endif

    <form action="{{ route('order.cek.proses') }}" method="POST" class="mt-3">
        @csrf
        <div class="mb-3">
            <label for="kode" class="form-label">Kode Transaksi:</label>
            <input type="text" class="form-control" name="kode" id="kode" required>
        </div>
        <input type="submit" class="btn btn-primary" value="Cek Pesanan"></input>
    </form>
</div>
@endsection
