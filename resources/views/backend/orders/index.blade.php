@extends('backend.layouts_be.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> 
  @if (request()->routeIs('orders.index'))
    Pesanan
    @elseif (request()->routeIs('index-archive'))
    Arsip
    @endif
</h4>
<div class="p-2">
    <table class="table table-bordered table-striped datatable">
        <thead class="table-light">
          <tr>
            <th>Kode Transaksi</th>
            <th>Nama Pemesan</th>
            <th>Nomor HP</th>
            <th>Email</th>
            <th>Status Pesanan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($orders as $order)
          <tr>
            <td>{{ $order->kode_transaksi }}</td>
            <td>{{ $order->nama_pemesan }}</td>
            <td>{{ $order->phone_number }}</td>
            <td>{{ $order->email_pemesan }}</td>
            <td><x-order-badge-status :status="$order->status" /></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                @if (request()->routeIs('orders.index'))
                    <a href="{{ route('orders.show', $order->kode_transaksi) }}" class="dropdown-item"><i class="bx bx-show"></i> Detail</a>
                @elseif (request()->routeIs('index-archive'))
                    <a href="{{ route('show-archive', $order->kode_transaksi) }}" class="dropdown-item"><i class="bx bx-show"></i> Detail</a>
                @endif

                @if(is_null($order->wedding->user_id) && $order->payment && $order->payment->payment_status === 'paid' && Auth::check() && Auth::user()->role_id == 1)
                <form action="{{ route('orders.assignOrder', $order->kode_transaksi) }}" method="POST" class="ms-auto">
                    @csrf
                    <button data-title="Ambil pesanan ini ?" data-text="Setelah diambil, pesanan tersebut sudah dikelola oleh Anda" class="dropdown-item btn-confirm"><i class="bx bx-envelope"></i> Ambil Pesanan</button>
                </form>
                @endif

                @if (
                    $order->status === 'created' &&
                    $order->payment && $order->payment->payment_status === 'paid' &&
                    $order->wedding && $order->wedding->user_id
                )
                <form action="{{ route('weddings.processWedding', $order->kode_transaksi) }}" method="POST">
                    @csrf
                    <button type="submit" data-title="Proses ke Undangan ?" data-text="Pesanan ini akan diproseskan menjadi undangan aktif. Lanjutkan ?" class="dropdown-item btn-confirm"><i class="bx bx-send"></i> Proses</button>
                </form>
                @endif

                @if ($order->status === 'processed')
                <form action="{{ route('weddings.publishWedding', $order->kode_transaksi) }}" method="POST">
                    @csrf
                    <button type="submit" data-title="Publikasikan Undangan ?" data-text="Setelah dipublikasi, undangan bisa diakses publik." class="dropdown-item btn-confirm"><i class="bx bx-share-alt"></i> Publikasi</button>
                </form>
                @endif

                @if ($order->status === 'published')
                    <form action="{{ route('weddings.completeWedding', $order->kode_transaksi) }}" method="POST">
                        @csrf
                        <button type="submit" data-title="Selesaikan Undangan ?" data-text="Pesanan akan dianggap selesai dan tidak bisa dibatalkan. Lanjutkan ?" class="dropdown-item btn-confirm"><i class="bx bx-check"></i> Selesai</button>
                    </form>
                @endif

                </div>
              </div>
            </td>
          </tr>
        </tbody>
        @endforeach
    </table>
</div>
<x-data-tables />
<x-sweet-alert-confirm />
@endsection