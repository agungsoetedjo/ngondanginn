@extends('backend.layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Pesanan - {{ $order->kode_transaksi }}</h5>
            @if(is_null($order->wedding->user_id))
                <form action="{{ route('admin.orders.assignOrder', $order->kode_transaksi) }}" method="POST" class="ms-auto">
                    @csrf
                    <button data-title="Ambil pesanan ini ?" data-text="Setelah diambil, pesanan tersebut sudah dikelola oleh Anda" class="btn btn-light btn-sm btn-confirm">Ambil Pesanan</button>
                </form>
            @endif
        </div>

        <div class="card-body">
            <dl class="row mb-3">
                <dt class="col-sm-4">Nama Mempelai (Wanita & Pria)</dt>
                <dd class="col-sm-8">{{ $order->wedding->bride_name }} & {{ $order->wedding->groom_name }}</dd>
                
                <dt class="col-sm-4">Orangtua Mempelai Wanita</dt>
                <dd class="col-sm-8">{{ $order->wedding->bride_parents_info }}</dd>

                <dt class="col-sm-4">Orangtua Mempelai Pria</dt>
                <dd class="col-sm-8">{{ $order->wedding->groom_parents_info }}</dd>

                <dt class="col-sm-4">Lokasi Akad</dt>
                <dd class="col-sm-8">{{ $order->wedding->akad_place_name }} - {{ $order->wedding->akad_location }}</dd>

                <dt class="col-sm-4">Lokasi Resepsi</dt>
                <dd class="col-sm-8">{{ $order->wedding->reception_place_name }} - {{ $order->wedding->reception_location }}</dd>

                <dt class="col-sm-4">Tanggal Akad</dt>
                <dd class="col-sm-8">{{ $order->wedding->formatted_akad_date ?? '-' }}</dd>

                <dt class="col-sm-4">Tanggal Resepsi</dt>
                <dd class="col-sm-8">{{ $order->wedding->formatted_reception_date ?? '-' }}</dd>

                <dt class="col-sm-4">Deskripsi</dt>
                <dd class="col-sm-8">{{ $order->wedding->description }}</dd>

                <dt class="col-sm-4">Template</dt>
                <dd class="col-sm-8">{{ $order->wedding->template->name }}</dd>

                <dt class="col-sm-4">Musik Latar</dt>
                <dd class="col-sm-8">
                    @if ($order->wedding->user_id && !in_array($order->status,['published','completed']))
                    <form action="{{ route('weddings.updateMusic', $order->wedding->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="music_id" id="music_id" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                            @foreach ($musics as $music)
                                <option value="{{ $music->id }}" {{ $order->wedding->music_id == $music->id ? 'selected' : '' }}>
                                    {{ $music->artist }} - {{ $music->title }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                    @else
                    {{ $order->wedding->music->artist }} - {{ $order->wedding->music->title }}
                    @endif
                </dd>

                <dt class="col-sm-4">Total Pembayaran</dt>
                <dd class="col-sm-8">Rp{{ number_format($order->payment_total, 0, ',', '.') }}</dd>

                <dt class="col-sm-4">Status</dt>
                <dd class="col-sm-8">
                        @php
                            $status = $order->status;

                            $badgeColor = match($status) {
                                'pending' => 'danger',
                                'waiting_verify' => 'warning',
                                'rejected' => 'danger',
                                'paid' => 'success',
                                'processed' => 'info',
                                'published' => 'secondary',
                                'completed' => 'success',
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
                            @case('rejected')
                                <i class="bi bi-x"></i> Pembayaran Ditolak
                                @break
                            @case('paid')
                                <i class="bi bi-credit-card-2-check"></i> Pembayaran Diterima
                                @break
                            @case('processed')
                                <i class="bi bi-file-earmark-text"></i> Undangan Diproses
                                @break
                            @case('published')
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

                <dt class="col-sm-4">Pengelola Undangan</dt>
                <dd class="col-sm-8">
                    {{ $order->wedding->user->name ?? 'Belum ada pengelola' }}
                </dd>
            </dl>

            <div class="mb-4">
                <h6>Bukti Transfer</h6>
                @if ($order->payment_proof)
                    <div style="max-width: 250px;">
                        <img src="{{ asset($order->payment_proof) }}"
                             alt="Bukti Transfer"
                             class="img-thumbnail img-fluid w-100">
                    </div>
                @else
                    <p class="text-muted">Belum ada bukti transfer</p>
                @endif
            </div>

            <div class="d-flex gap-2">
                @if($order->status === 'waiting_verify')
                    <form action="{{ route('admin.orders.approve', $order->kode_transaksi) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </form>

                    <form id="reject-form-{{ $order->kode_transaksi }}" action="{{ route('admin.orders.reject', $order->kode_transaksi) }}" method="POST">
                        @csrf
                        <input type="hidden" name="reason" id="reject-reason-{{ $order->kode_transaksi }}">
                        <button type="button" class="btn btn-danger" onclick="confirmRejection('{{ $order->kode_transaksi }}')">Tolak</button>
                    </form>
                @endif

                @if ($order->status === 'paid' && $order->wedding->user_id)
                    <form action="{{ route('admin.weddings.processWedding', $order->kode_transaksi) }}" method="POST">
                        @csrf
                        <button type="submit" data-title="Proses ke Undangan ?" data-text="Pesanan ini akan diproseskan menjadi undangan aktif. Lanjutkan ?" class="btn btn-primary btn-confirm">Proses ke Undangan</button>
                    </form>
                @endif
                
                @if ($order->status === 'processed')
                    <form action="{{ route('admin.weddings.publishWedding', $order->kode_transaksi) }}" method="POST">
                        @csrf
                        <button type="submit" data-title="Publikasikan Undangan ?" data-text="Setelah dipublikasi, undangan bisa diakses publik." class="btn btn-primary btn-confirm">Publikasi Undangan</button>
                    </form>
                @endif

                @if ($order->status === 'published')
                    <form action="{{ route('admin.weddings.completeWedding', $order->kode_transaksi) }}" method="POST">
                        @csrf
                        <button type="submit" data-title="Selesaikan Undangan ?" data-text="Pesanan akan dianggap selesai dan tidak bisa dibatalkan. Lanjutkan ?" class="btn btn-primary btn-confirm">Selesai Undangan</button>
                    </form>
                @endif
                @if (request()->routeIs('admin.orders.show'))
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary ms-auto">Kembali</a>
                @elseif (request()->routeIs('show-archive'))
                    <a href="{{ route('index-archive') }}" class="btn btn-secondary ms-auto">Kembali</a>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function () {
    $('.btn-confirm').click(function (e) {
      e.preventDefault();

      const form = $(this).closest('form');
      const title = $(this).data('title') || 'Yakin ingin melanjutkan aksi ini?';
      const text = $(this).data('text') || 'Tindakan ini tidak dapat dibatalkan.';

      Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#18743d',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Lanjutkan!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });

    function confirmRejection(kodeTransaksi) {
        Swal.fire({
            title: 'Tolak Pembayaran',
            input: 'text',
            inputLabel: 'Alasan penolakan',
            inputPlaceholder: 'Masukkan alasan pembayaran ditolak',
            showCancelButton: true,
            confirmButtonText: 'Kirim',
            cancelButtonText: 'Batal',
            inputValidator: (value) => {
                if (!value) {
                    return 'Alasan wajib diisi!';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('reject-reason-' + kodeTransaksi).value = result.value;
                document.getElementById('reject-form-' + kodeTransaksi).submit();
            }
        });
    }
</script>
@endsection
