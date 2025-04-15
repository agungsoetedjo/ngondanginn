@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Detail Pesanan</h3>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Nama Pengantin:</strong> {{ $order->bride_name }} & {{ $order->groom_name }}</p>
            <p><strong>Kode Transaksi:</strong> {{ $order->kode_transaksi }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            {{-- Tambahkan data lainnya sesuai kebutuhan --}}
        </div>
    </div>

    <a href="{{ route('order.cek.form') }}" class="btn btn-secondary mt-3">Cek Lagi</a>
</div>
@endsection
