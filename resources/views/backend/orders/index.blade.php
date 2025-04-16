@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Manajemen Pesanan</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Nama Mempelai</th>
                    <th>Template</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->kode_transaksi }}</td>
                        <td>{{ $order->bride_name }} & {{ $order->groom_name }}</td>
                        <td>{{ $order->template->name ?? '-' }}</td>
                        @php
                            $status = $order->status;

                            $badgeColor = match($status) {
                                'completed' => 'success',
                                'paid' => 'success',
                                'waiting_verify' => 'warning',
                                'pending' => 'danger',
                                'active' => 'secondary',
                                'processed' => 'info',
                                default => 'dark',
                            };

                            $textColor = in_array($status, ['waiting_verify', 'processed']) ? 'dark' : 'white';
                        @endphp

                        <td>
                            <span class="text-{{ $textColor }} text-uppercase badge bg-{{ $badgeColor }}">
                                @switch($status)
                                    @case('pending')
                                        <i class="bi bi-hourglass-split"></i> Menunggu Pembayaran
                                        @break
                                    @case('waiting_verify')
                                        <i class="bi bi-hourglass-bottom"></i> Menunggu Verifikasi
                                        @break
                                    @case('paid')
                                        <i class="bi bi-credit-card-2-check"></i> Pembayaran Diterima
                                        @break
                                    @case('processed')
                                        <i class="bi bi-file-earmark-text"></i> Undangan Diproses
                                        @break
                                    @case('active')
                                        <i class="bi bi-globe"></i> Undangan Dipublikasi
                                        @break
                                    @case('completed')
                                        <i class="bi bi-check-circle-fill"></i> Undangan Selesai
                                        @break
                                    @default
                                        <i class="bi bi-question-circle"></i> Status Tidak Dikenal
                                @endswitch
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('admin.orders.show', $order->kode_transaksi) }}" class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/ourscript.js') }}"></script>
@endsection
