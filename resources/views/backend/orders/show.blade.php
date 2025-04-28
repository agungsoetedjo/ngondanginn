@extends('backend.layouts_be.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Pesanan - {{ $order->kode_transaksi }}</h5>
        </div>

        <div class="card p-3">
            <dl class="row mb-3">
                <dt class="col-sm-4">Nama Pasangan</dt>
                <dd class="col-sm-8">{{ $order->wedding->groom_name }} & {{ $order->wedding->bride_name }}</dd>
                
                <dt class="col-sm-4">Orangtua Mempelai Pria</dt>
                <dd class="col-sm-8">{{ $order->wedding->groom_parents_info }}</dd>

                <dt class="col-sm-4">Orangtua Mempelai Wanita</dt>
                <dd class="col-sm-8">{{ $order->wedding->bride_parents_info }}</dd>

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
                    @if ($order->wedding->user_id && !in_array($order->status, ['published', 'completed']) && Auth::check() && Auth::user()->role_id == 1)
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

                <dt class="col-sm-4">Status Pesanan</dt>
                <dd class="col-sm-8"><x-order-badge-status :status="$order->status" /></dd>

                <dt class="col-sm-4">Pengelola Undangan</dt>
                <dd class="col-sm-8">
                    {{ $order->wedding->user->name ?? 'Belum ada pengelola' }}
                </dd>
            </dl>

            <div class="d-flex gap-2">
                
                @if (request()->routeIs('orders.show'))
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary ms-auto">Kembali</a>
                @elseif (request()->routeIs('show-archive'))
                    <a href="{{ route('index-archive') }}" class="btn btn-secondary ms-auto">Kembali</a>
                @endif
            </div>
        </div>
    </div>
</div>
<x-sweet-alert-confirm />
@endsection
