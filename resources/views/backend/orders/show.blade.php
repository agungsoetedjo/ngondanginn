@extends('backend.layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Pesanan - {{ $order->kode_transaksi }}</h5>
            @if(is_null($order->user_id))
                <form action="{{ route('admin.orders.assignOrder', $order->kode_transaksi) }}" method="POST" class="ms-auto">
                    @csrf
                    <button class="btn btn-light btn-sm" onclick="return confirm('Ambil alih order ini?')">Ambil Order</button>
                </form>
            @endif
        </div>

        <div class="card-body">
            <dl class="row mb-3">
                <dt class="col-sm-4">Nama Mempelai (Wanita & Pria)</dt>
                <dd class="col-sm-8">{{ $order->bride_name }} & {{ $order->groom_name }}</dd>
                
                <dt class="col-sm-4">Orangtua Mempelai Wanita</dt>
                <dd class="col-sm-8">{{ $order->bride_parents_info }}</dd>

                <dt class="col-sm-4">Orangtua Mempelai Pria</dt>
                <dd class="col-sm-8">{{ $order->groom_parents_info }}</dd>

                <dt class="col-sm-4">Nomor HP Pemesan</dt>
                <dd class="col-sm-8">{{ $order->phone_number }}</dd>

                <dt class="col-sm-4">Lokasi Acara</dt>
                <dd class="col-sm-8">{{ $order->place_name }} - {{ $order->location }}</dd>

                <dt class="col-sm-4">Tanggal Akad</dt>
                <dd class="col-sm-8">{{ $order->formatted_akad_date ?? '-' }}</dd>

                <dt class="col-sm-4">Tanggal Resepsi</dt>
                <dd class="col-sm-8">{{ $order->formatted_reception_date ?? '-' }}</dd>

                <dt class="col-sm-4">Status</dt>
                <dd class="col-sm-8">
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
                </dd>

                <dt class="col-sm-4">User Assigned</dt>
                <dd class="col-sm-8">
                    {{ $order->user->name ?? 'Belum diassign' }}
                </dd>
            </dl>

            <div class="mb-4">
                <h6>Bukti Transfer</h6>
                @if ($order->payment_proof)
                    <div style="max-width: 250px;">
                        <img src="{{ asset('uploads/payment_proof/' . $order->payment_proof) }}"
                             alt="Bukti Transfer"
                             class="img-thumbnail img-fluid w-100">
                    </div>
                @else
                    <p class="text-muted">Belum ada bukti transfer</p>
                @endif
            </div>

            <div class="d-flex gap-2">
                @if(!is_null($order->user_id) && $order->user_id === auth()->id() && $order->status === 'waiting_verify')
                    <form action="{{ route('admin.orders.approve', $order->kode_transaksi) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </form>

                    <form action="{{ route('admin.orders.reject', $order->kode_transaksi) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </form>
                @endif

                @if ($order->status === 'paid')
                    <form action="{{ route('admin.weddings.processWedding', $order->kode_transaksi) }}" method="POST" onsubmit="return confirm('Yakin ingin memproseskan pesanan ini ke data undangan ?')">
                        @csrf
                        <button type="submit" class="btn btn-primary">Proses ke Undangan</button>
                    </form>
                @endif
                
                @if ($order->status === 'processed')
                    <form action="{{ route('admin.weddings.publishWedding', $order->kode_transaksi) }}" method="POST" onsubmit="return confirm('Yakin ingin mempublikasikan undangan ini ?')">
                        @csrf
                        <button type="submit" class="btn btn-primary">Publikasi Undangan</button>
                    </form>
                @endif

                @if ($order->status === 'active')
                    <form action="{{ route('admin.weddings.completeWedding', $order->kode_transaksi) }}" method="POST" onsubmit="return confirm('Yakin ingin menyelesaikan undangan ini ?')">
                        @csrf
                        <button type="submit" class="btn btn-primary">Selesai Undangan</button>
                    </form>
                @endif
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary ms-auto">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
