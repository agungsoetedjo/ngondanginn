@props(['status'])

@php
    $badgeColor = match($status) {
        'created' => 'success',
        'processed' => 'info',
        'published' => 'warning',
        'completed' => 'success',
        default => 'dark',
    };
    $textColor = in_array($status, ['processed', 'published']) ? 'dark' : 'white';
@endphp

<span class="text-{{ $textColor }} text-uppercase badge bg-{{ $badgeColor }}">
    @switch($status)
        @case('created') Pesanan Dibuat @break
        @case('processed') Undangan Diproses @break
        @case('published') Undangan Dipublikasi @break
        @case('completed') Undangan Selesai @break
        @default <i class="bi bi-question-circle"></i> Status Tidak Dikenal
    @endswitch
</span>