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
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2000
        });
        
    @elseif (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 3000
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
                        <small class="text-muted">Tanggal : {{ now()->format('d M Y') }}</small><br>
                        <small class="text-muted">Nama Pemesan : {{ $order->nama_pemesan ?? '-' }}</small><br>
                        <small class="text-muted">Musik Latar : {{ $order->wedding->music->artist ?? '-' }} - {{ $order->wedding->music->title ?? '-' }}</small>
                    </div>
                    <div class="order-md-1 text-md-end text-center mt-3 mt-md-0">
                        <span class="badge bg-primary px-3 py-2 fs-6">
                            #{{ $order->kode_transaksi }}
                        </span>
                        <div class="mt-2 text-muted small">
                        <strong>Pengelola Undangan : </strong>
                        @if($order->wedding->user_id)
                            {{ $order->wedding->user->name}}
                        @else
                        Menunggu ditugaskan
                        @endif
                        </div>
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
                                <h6 class="text-muted">Tanggal & Waktu Akad</h6>
                                <p>{{ \Carbon\Carbon::parse($order->wedding->akad_date)->translatedFormat('l, d F Y - H:i') }}</p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Mempelai Wanita</h6>
                                <p class="fw-medium">{{ $order->wedding->bride_name }}</p>
                                <h6 class="text-muted">Orangtua Mempelai Wanita</h6>
                                <p>{{ $order->wedding->bride_parents_info }}</p>
                                <h6 class="text-muted">Tanggal & Waktu Resepsi</h6>
                                <p>{{ \Carbon\Carbon::parse($order->wedding->reception_date)->translatedFormat('l, d F Y - H:i') }}</p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Tempat Akad</h6>
                                <p>{{ $order->wedding->akad_place_name }}</p>
                            </div>
                            
                            <div class="col-md-6">
                                <h6 class="text-muted">Lokasi Akad</h6>
                                <p>{{ $order->wedding->akad_location }}</p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Tempat Resepsi</h6>
                                <p>{{ $order->wedding->reception_place_name }}</p>
                            </div>
                            
                            <div class="col-md-6">
                                <h6 class="text-muted">Lokasi Resepsi</h6>
                                <p>{{ $order->wedding->reception_location }}</p>
                            </div>
                            
                            <div class="col-12">
                                <h6 class="text-muted">Deskripsi</h6>
                                <p class="fst-italic">{{ $order->wedding->description ?? '-' }}</p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Total Pembayaran</h6>
                                <p class="fw-semibold text-success">
                                    @if ($order->payment && $order->payment->payment_status !== 'created')
                                        Rp{{ number_format($order->payment->payment_total, 0, ',', '.') }}
                                    @else
                                        Rp{{ number_format($order->wedding->template->price, 0, ',', '.') }}
                                    @endif
                                </p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Status Pesanan</h6>
                                <x-order-badge-status :status="$order->status" />
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Status Pembayaran</h6>
                                @if ($order->payment && $order->payment->payment_status)
                                    <x-payment-badge-status :payment_status="$order->payment->payment_status" />
                                @else
                                    <span class="badge bg-danger text-white text-uppercase">Menunggu Pembayaran</span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Deskripsi Pembayaran</h6>
                                <p class="fw-semibold">{{ $order->payment->payment_desc ?? '-'}}</p>
                            </div>

                            @if ($order->payment && in_array($order->payment->payment_status, ['pending','rejected']))
                                <div class="col-12 mb-3">
                                    <form action="{{ route('order.update.template', $order->kode_transaksi) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="template" class="form-label">Pilih Template</label>
                                            <select name="template_id" id="template" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                                                @foreach($templates as $template)
                                                    <option value="{{ $template->id }}" {{ $order->wedding->template_id == $template->id ? 'selected' : '' }}>
                                                        {{ $template->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            @endif
                            @if (($order->payment && in_array($order->payment->payment_status, [null, 'pending', 'rejected'])) || (!$order->payment && $order->status === 'created'))
                            <div class="col-12 mt-3">
                                <form action="{{ route('order.upload_bukti', $order->kode_transaksi) }}" method="POST" enctype="multipart/form-data" class="border rounded p-3 shadow-sm bg-light">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="payment_dests_id" class="form-label fw-semibold">Tujuan Pembayaran</label>
                                            <select name="payment_dests_id" id="payment_dests_id" class="form-select form-select-sm w-auto" required>
                                                <option value="" selected>--Pilih--</option>
                                                @foreach ($paymentDests as $dest)
                                                <option value="{{ $dest->id }}">
                                                    {{ $dest->bank_name }} - {{ $dest->account_number }} - a.n. {{ $dest->account_name }}
                                                </option>
                                                @endforeach
                                              </select>
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

                            @if ($order->status === 'published')
                            <div class="col-md-12 mt-3">
                                <h6 class="text-muted">Link Undangan : </h6>
                                <a href="{{ route('wedding.checks', $order->wedding->slug) }}" target="_blank"><span class="badge bg-success">{{ $order->wedding->slug }}</span></a>
                            </div>
                            @endif

                            {{-- Gambar versi mobile --}}
                            @if ($order->wedding->template && $order->wedding->template->preview_image)
                            <div class="col-12 d-block d-md-none mt-4 text-center">
                                <h6 class="text-muted">{{ $order->wedding->template->name }} {{ $order->wedding->template->category->type == 'dengan_foto' ? 'Dengan Foto' : 'Tanpa Foto' }}</h6>
                                <img src="{{ asset('images/templates/' . $order->wedding->template->preview_image) }}" class="img-fluid rounded shadow-sm" style="max-height: 150px;">
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Kanan: Gambar desktop -->
                    <div class="col-md-4 d-none d-md-block text-end">
                        @if ($order->wedding->template && $order->wedding->template->preview_image)
                            <h6 class="text-muted mb-3">{{ $order->wedding->template->name }} {{ $order->wedding->template->category->type == 'dengan_foto' ? 'Dengan Foto' : 'Tanpa Foto' }}</h6>
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
