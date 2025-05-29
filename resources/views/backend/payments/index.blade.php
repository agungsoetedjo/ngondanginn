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
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($orders as $order)
          <tr>
            <td><a href="{{ route('payments.show', $order->kode_transaksi) }}" class="fw-bold text-primary">{{ $order->kode_transaksi }}</a> </td>
            <td>{{ $order->nama_pemesan }}</td>
            <td>{{ $order->phone_number }}</td>
            <td><x-payment-badge-status :payment_status="$order->payment->payment_status" /></td>
          </tr>
        </tbody>
        @endforeach
      </table>
    {{-- </div> --}}
</div>
<x-data-tables />
<x-sweet-alert-confirm />
@endsection
