@extends('backend.layouts.app')

@section('title', 'Buku Tamu')

@section('content')
<div class="container">
    <h4 class="mb-4">Buku Tamu untuk: <strong>{{ $wedding->bride_name }} & {{ $wedding->groom_name }}</strong></h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($guests->isEmpty())
        <div class="alert alert-info">Belum ada ucapan dari tamu.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guests as $guest)
                        <tr>
                            <td>{{ $guest->name }}</td>
                            <td>{{ $guest->message }}</td>
                            <td>{{ $guest->createdAtFormatted }}</td> <!-- Menampilkan tanggal dalam format "3 menit yang lalu" -->
                            <td>
                                <form action="{{ route('guestbooks.destroy', $guest->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <a href="{{ route('weddings.index') }}" class="btn btn-secondary mt-4">← Kembali ke Daftar Undangan</a>
</div>
@endsection
