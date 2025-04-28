@extends('backend.layouts_be.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Pembayaran</h4>
<div class="p-2">
    {{-- <div class="table-responsive text-nowrap"> --}}
    {{-- <h5 class="card-header">Table Basic</h5> --}}
      <table class="table table-bordered table-striped datatable">
        <thead class="table-light">
          <tr>
            <th>Kode Transaksi</th>
            <th>Nama Pemesan</th>
            <th>Nomor HP Pemesan</th>
            <th>Status Pembayaran</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($orders as $order)
          <tr>
            <td>{{ $order->kode_transaksi }}</td>
            <td>{{ $order->nama_pemesan }}</td>
            <td>{{ $order->phone_number }}</td>
            <td><x-payment-badge-status :payment_status="$order->payment->payment_status" /></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                <a href="{{ route('payments.show', $order->kode_transaksi) }}" class="dropdown-item"><i class="bx bx-show"></i> Detail</a>
                @if($order->payment->payment_status === 'waiting_verify')
                <form action="{{ route('payments.approve', $order->kode_transaksi) }}" method="POST">
                    @csrf
                    <button type="submit" data-title="Verifikasi Pembayaran" data-text="Pembayaran akan segera diterima" class="dropdown-item btn-confirm"><i class="bx bx-check-circle"></i> Verifikasi</button>
                </form>
                <form id="reject-form-{{ $order->kode_transaksi }}" action="{{ route('payments.reject', $order->kode_transaksi) }}" method="POST">
                    @csrf
                    <input type="hidden" name="reason" id="reject-reason-{{ $order->kode_transaksi }}">
                    <button type="button" class="dropdown-item" onclick="confirmRejection('{{ $order->kode_transaksi }}')"><i class="bx bx-x-circle"></i> Tolak</button>
                </form>
                @endif
                </div>
              </div>
            </td>
          </tr>
        </tbody>
        @endforeach
      </table>
    {{-- </div> --}}
</div>
<x-data-tables />
<x-sweet-alert-confirm />
@endsection