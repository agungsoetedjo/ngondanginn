@props(['payment_status'])

@php
    $pbadgeColor = match($payment_status) {
        'pending' => 'danger',
        'waiting_verify' => 'warning',
        'rejected' => 'danger',
        'paid' => 'success',
        default => 'dark',
    };
    $ptextColor = in_array($payment_status, ['waiting_verify']) ? 'dark' : 'white';
@endphp

<span class="text-{{ $ptextColor }} text-uppercase badge bg-{{ $pbadgeColor }}">
    @switch($payment_status)
        @case('pending') Menunggu Pembayaran @break
        @case('waiting_verify') Menunggu Verifikasi @break
        @case('rejected') Pembayaran Ditolak @break
        @case('paid') Pembayaran Diterima @break
        @default Status Tidak Dikenal
    @endswitch
</span>