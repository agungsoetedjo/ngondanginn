@extends('layouts.app')

@section('content')
<!-- Include SweetAlert (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6'
        });
    @elseif (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33'
        });
    @endif
</script>

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
                    <!-- Kiri: Konten -->
                    <div class="col-md-8 order-md-1">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <h6 class="text-muted fw-semibold">Nama Mempelai Pria</h6>
                                <p class="fs-6">{{ $order->groom_name }}</p>
                                <h6 class="text-muted fw-semibold">Nama Orangtua Mempelai Pria</h6>
                                <p class="fs-6">{{ $order->groom_parents_info }}</p>
                                <h6 class="text-muted fw-semibold">Waktu Akad</h6>
                                <p class="fs-6">
                                    {{ \Carbon\Carbon::parse($order->akad_date)->translatedFormat('l, d F Y - H:i') }}
                                </p>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <h6 class="text-muted fw-semibold">Nama Mempelai Wanita</h6>
                                <p class="fs-6">{{ $order->bride_name }}</p>
                                <h6 class="text-muted fw-semibold">Nama Orangtua Mempelai Wanita</h6>
                                <p class="fs-6">{{ $order->bride_parents_info }}</p>
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

                            {{-- Gambar versi mobile --}}
                            @if ($order->template && $order->template->preview_image)
                                <div class="col-12 mb-3 d-block d-md-none">
                                    <h6 class="text-muted fw-semibold">{{ $order->template->name ?? '-' }}</h6>
                                    <img src="{{ asset('images/templates/' . $order->template->preview_image) }}" alt="Preview Template" class="img-fluid rounded shadow-sm" style="max-height: 150px;">
                                </div>
                            @endif

                            <div class="col-12 col-md-6 mb-3">
                                <h6 class="text-muted fw-semibold">Total Pembayaran</h6>
                                <p class="mb-1 fs-6">Rp{{ number_format($order->payment_total, 0, ',', '.') }}</p>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <h6 class="text-muted fw-semibold">Status</h6>
                                <p class="mb-1 fs-6">
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
                                    <span class="text-{{ $textColor }} badge d-inline-flex align-items-center gap-1 px-3 py-2 bg-{{ $badgeColor }}">
                                    @switch($order->status)
                                        @case('pending')
                                            <i class="bi bi-hourglass-split"></i> Menunggu Pembayaran
                                            @break
                                        @case('waiting_verify')
                                            <i class="bi bi-hourglass-bottom"></i> Menunggu Verifikasi
                                            @break
                                        @case('paid')
                                            <i class="bi bi-check-circle-fill"></i> Pembayaran Diterima
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
                                </p>
                            </div>

                            @if ($order->status === 'pending')
                            <div>
                                <form action="{{ route('order.upload_bukti', $order->kode_transaksi) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <!-- Kolom untuk Nomor HP -->
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="phone_number" class="form-label fw-semibold">Nomor HP Pemesan</label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="08xxxxxxx" required>
                                        </div>

                                        <!-- Kolom untuk Upload Bukti Transfer -->
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="bukti_transfer" class="form-label fw-semibold">Upload Bukti Transfer</label>
                                            <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" required>
                                            <div class="form-text">Format gambar (JPG/PNG), maksimal 2MB.</div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-upload"></i> Upload Bukti Pembayaran
                                    </button>

                                </form>
                            </div>
                        @endif

                        </div>
                    </div>

                    <!-- Kanan: Gambar versi desktop -->
                    <div class="col-md-4 text-md-end order-md-2 d-none d-md-block mt-4 mt-md-0">
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
