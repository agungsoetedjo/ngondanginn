@extends('layouts.app')

@section('content')
<!-- SweetAlert -->
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

<div class="container my-5">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-4 position-relative">

            {{-- Watermark --}}
            <div class="position-absolute top-50 start-50 text-center fw-bold" style="font-size: 3.5rem; color: rgba(0,0,0,0.03); z-index: 0; pointer-events: none; transform: translate(-50%, -50%) rotate(-30deg);">
                <span class="sitename">Ngondang</span><span style="background-color: rgba(0,0,0,0.03); color: white; padding: 0 0.5rem; border-radius: 0.5rem;">in</span>
            </div>

            <div style="position: relative; z-index: 1;">
                <div class="d-flex justify-content-between flex-wrap align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Bukti Pesanan</h5>
                        <small class="text-muted">Tanggal: {{ now()->format('d M Y') }}</small><br>
                        <small class="text-muted">Nama Pemesan: {{ $order->nama_pemesan ?? '-' }}</small>
                    </div>
                    <div class="order-md-1 text-md-end text-center mt-3 mt-md-0">
                        <span class="badge bg-primary px-3 py-2 fs-6">
                            #{{ $order->kode_transaksi }}
                        </span>
                        @if($order->wedding->user_id)
                            <div class="mt-2 text-muted small">
                                <strong>Pengelola Undangan:</strong> {{ $order->wedding->user->name ?? 'Belum ditugaskan' }}
                            </div>
                        @endif
                    </div>
                </div>

                <hr class="my-3">

                <div class="row">
                    <!-- Kiri: Info Detail -->
                    <div class="col-md-8">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <h6 class="text-muted">Mempelai Pria</h6>
                                <p class="fw-medium">{{ $order->wedding->groom_name }}</p>
                                <h6 class="text-muted">Orangtua Mempelai Pria</h6>
                                <p>{{ $order->wedding->groom_parents_info }}</p>
                                <h6 class="text-muted">Akad</h6>
                                <p>{{ \Carbon\Carbon::parse($order->wedding->akad_date)->translatedFormat('l, d F Y - H:i') }}</p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Mempelai Wanita</h6>
                                <p class="fw-medium">{{ $order->wedding->bride_name }}</p>
                                <h6 class="text-muted">Orangtua Mempelai Wanita</h6>
                                <p>{{ $order->wedding->bride_parents_info }}</p>
                                <h6 class="text-muted">Resepsi</h6>
                                <p>{{ \Carbon\Carbon::parse($order->wedding->reception_date)->translatedFormat('l, d F Y - H:i') }}</p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Tempat Acara</h6>
                                <p>{{ $order->wedding->place_name }}</p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Lokasi</h6>
                                <p>{{ $order->wedding->location }}</p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Total Pembayaran</h6>
                                <p class="fw-semibold text-success">Rp{{ number_format($order->payment_total, 0, ',', '.') }}</p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Status</h6>
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
                                <span class="badge bg-{{ $badgeColor }} text-{{ $textColor }} px-3 py-2 d-inline-flex align-items-center gap-2">
                                    @switch($status)
                                        @case('pending') <i class="bi bi-hourglass-split"></i> Menunggu Pembayaran @break
                                        @case('waiting_verify') <i class="bi bi-hourglass-bottom"></i> Menunggu Verifikasi @break
                                        @case('paid') <i class="bi bi-check-circle-fill"></i> Pembayaran Diterima @break
                                        @case('processed') <i class="bi bi-file-earmark-text"></i> Undangan Diproses @break
                                        @case('active') <i class="bi bi-globe"></i> Undangan Dipublikasi @break
                                        @case('completed') <i class="bi bi-check-circle-fill"></i> Undangan Selesai @break
                                        @default <i class="bi bi-question-circle"></i> Status Tidak Dikenal
                                    @endswitch
                                </span>
                            </div>

                            @if ($order->status === 'pending')
                                <div class="col-12 mb-3">
                                    <form action="{{ route('order.update.template', $order->kode_transaksi) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="template" class="form-label">Pilih Template</label>
                                            <select name="template_id" id="template" class="form-select" required>
                                                @foreach($templates as $template)
                                                    <option value="{{ $template->id }}" {{ $order->wedding->template_id == $template->id ? 'selected' : '' }}>
                                                        {{ $template->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-warning mt-3">
                                            <i class="bi bi-arrow-repeat"></i> Ganti Template
                                        </button>
                                    </form>
                                </div>
                            @endif
                            @if ($order->status === 'pending')
                            <div class="col-12 mt-3">
                                <form action="{{ route('order.upload_bukti', $order->kode_transaksi) }}" method="POST" enctype="multipart/form-data" class="border rounded p-3 shadow-sm bg-light">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="phone_number" class="form-label fw-semibold">Nomor HP Pemesan</label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="08xxxxxxx" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="bukti_transfer" class="form-label fw-semibold">Upload Bukti Transfer</label>
                                            <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" required>
                                            <div class="form-text">Format JPG/PNG, maksimal 2MB</div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">
                                        <i class="bi bi-upload"></i> Upload Bukti Pembayaran
                                    </button>
                                </form>
                            </div>
                            @endif

                            {{-- Gambar versi mobile --}}
                            @if ($order->wedding->template && $order->wedding->template->preview_image)
                            <div class="col-12 d-block d-md-none mt-4 text-center">
                                <h6 class="text-muted">{{ $order->wedding->template->name }}</h6>
                                <img src="{{ asset('images/templates/' . $order->wedding->template->preview_image) }}" class="img-fluid rounded shadow-sm" style="max-height: 150px;">
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Kanan: Gambar desktop -->
                    <div class="col-md-4 d-none d-md-block text-end">
                        @if ($order->wedding->template && $order->wedding->template->preview_image)
                            <h6 class="text-muted mb-3">{{ $order->wedding->template->name }}</h6>
                            <img src="{{ asset('images/templates/' . $order->wedding->template->preview_image) }}" class="img-fluid rounded shadow-sm" style="max-height: 150px;">
                        @else
                            <p class="text-muted">Preview tidak tersedia.</p>
                        @endif
                    </div>
                </div>

                <hr class="my-4">

                <p class="text-center text-muted small">
                    Terima kasih telah menggunakan layanan kami 💐
                </p>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('order.cek.form') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Cek Pesanan Lain
        </a>
    </div>
</div>
@endsection
