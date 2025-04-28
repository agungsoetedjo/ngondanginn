@extends('backend.layouts_be.app')

@section('content')
        <div class="card p-3">
            <dl class="row mb-3">
                <dt class="col-sm-4">Nama Pemesan</dt>
                <dd class="col-sm-8">{{ $order->nama_pemesan }}</dd>
                
                <dt class="col-sm-4">Nomor HP Pemesan</dt>
                <dd class="col-sm-8">{{ $order->phone_number }}</dd>
                
                <dt class="col-sm-4">Status Pesanan</dt>
                <dd class="col-sm-8"><x-order-badge-status :status="$order->status" /></dd>
    
                <dt class="col-sm-4">Total Pembayaran</dt>
                <dd class="col-sm-8">Rp{{ number_format($order->payment->payment_total, 0, ',', '.') }}</dd>
        
                <dt class="col-sm-4">Tujuan Pembayaran</dt>
                <dd class="col-sm-8">{{ $order->payment->paymentDest->bank_name }} - {{ $order->payment->paymentDest->account_number }} a.n {{ $order->payment->paymentDest->account_name }}</dd>

                <dt class="col-sm-4">Bukti Pembayaran</dt>
                <dd class="col-sm-8"><a href="{{ asset($order->payment->payment_proof) }}" class="badge bg-primary text-white" target="_blank">Lihat Bukti</a></dd>         

                <dt class="col-sm-4">Waktu Pembayaran</dt>
                <dd class="col-sm-8">{{ $order->payment->formatted_created_at ?? '-' }}</dd>

                <dt class="col-sm-4">Catatan dari Bendahara</dt>
                <dd class="col-sm-8">{{ optional($order->payment)->payment_desc ?? '-' }}</dd>

                <dt class="col-sm-4">Status Pembayaran</dt>
                <dd class="col-sm-8"><x-payment-badge-status :payment_status="$order->payment->payment_status" /></dd>
    
                <dt class="col-sm-4">Bendahara</dt>
                <dd class="col-sm-8">
                    {{ $order->payment->user->name ?? 'Pembayaran belum diverifikasi' }}
                </dd>
            </dl>

            <div class="d-flex gap-2">
                <a href="{{ route('payments.index') }}" class="btn btn-secondary ms-auto">Kembali</a>
            </div>
        </div>
<x-sweet-alert-confirm />
@endsection