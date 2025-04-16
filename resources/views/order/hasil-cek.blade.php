    @extends('layouts.app')

    @section('content')
    <div class="container mt-4">
        <div class="card mt-4 shadow-sm border border-light-subtle rounded-4" style="background-color: #ffffff;">
            <div class="card-body p-4 position-relative">
                <div class="position-absolute top-50 start-50 text-center fw-bold" style="font-size: 3.5rem; color: rgba(0,0,0,0.03); z-index: 0; pointer-events: none; transform: translate(-50%, -50%) rotate(-30deg);">
                <span class="sitename">Ngondang</span><span style="background-color: rgba(0,0,0,0.03); color: white; padding: 0 0.5rem; border-radius: 0.5rem;">in</span>
                </div>
                <div style="position: relative; z-index: 1;">
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Bukti Pesanan</h5>
                            <small class="text-muted">Tanggal: {{ now()->format('d M Y') }}</small>
                        </div>
                        <div class="text-md-end text-center w-100 w-md-auto mt-3 mt-md-0">
                            <span class="badge" style="background-color: #37517e; color: white; font-size: 1rem;">
                                #{{ $order->kode_transaksi }}
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <h6 class="text-muted fw-semibold">Nama Mempelai Pria</h6>
                                    <p class="fs-6">{{ $order->groom_name }}</p>
                                    <h6 class="text-muted fw-semibold">Waktu Akad</h6>
                                    <p class="fs-6">
                                        {{ \Carbon\Carbon::parse($order->akad_date)->translatedFormat('l, d F Y - H:i') }}
                                    </p>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <h6 class="text-muted fw-semibold">Nama Mempelai Wanita</h6>
                                    <p class="fs-6">{{ $order->bride_name }}</p>
                                    <h6 class="text-muted fw-semibold">Waktu Resepsi</h6>
                                    <p class="fs-6">
                                        {{ \Carbon\Carbon::parse($order->reception_date)->translatedFormat('l, d F Y - H:i') }}
                                    </p>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <h6 class="text-muted fw-semibold">Tempat Acara</h6>
                                    <p class="mb-1 fs-6">{{ $order->place_name }}</p>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <h6 class="text-muted fw-semibold">Lokasi</h6>
                                    <p class="mb-1 fs-6">{{ $order->location }}</p>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <h6 class="text-muted fw-semibold">Status Transaksi</h6>
                                    <p class="mb-1 fs-6">
                                        <span class="badge px-3 py-2 bg-{{ 
                                            $order->status === 'completed' ? 'success' : 
                                            ($order->status === 'paid' ? 'info' : 
                                            ($order->status === 'waiting_verify' ? 'secondary' : 'warning')) 
                                        }}">
                                            @switch($order->status)
                                                @case('pending')
                                                    Menunggu Pembayaran
                                                    @break
                                                @case('waiting_verify')
                                                    Menunggu Verifikasi Admin
                                                    @break
                                                @case('paid')
                                                    Pembayaran Diterima
                                                    @break
                                                @case('completed')
                                                    Undangan Selesai
                                                    @break
                                                @default
                                                    Status Tidak Diketahui
                                            @endswitch
                                        </span>
                                    </p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            @if ($order->template && $order->template->preview_image)
                                <h6 class="text-muted fw-semibold mb-3">{{ $order->template->name ?? '-' }}</h6>
                                <img src="{{ asset('images/templates/' . $order->template->preview_image) }}" alt="Preview Template" class="img-fluid rounded shadow-sm" style="max-height: 150px;">
                            @else
                                <p class="text-muted">Preview tidak tersedia.</p>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <p class="text-center text-muted mt-4 mb-0" style="font-size: 0.875rem;">
                        Terima kasih telah menggunakan layanan kami 💐
                    </p>
                </div>
            </div>
        </div>
        <a href="{{ route('order.cek.form') }}" class="btn btn-secondary mt-3">Cek Pesanan Lain</a>
    </div>
    @endsection