@extends('backend.layouts.app')

@section('title', 'Daftar RSVP')

@section('content')
<div class="container">
    <h2 class="mb-4">Konfirmasi Kehadiran untuk: <strong>{{ $wedding->bride_name }} & {{ $wedding->groom_name }}</strong></h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($rsvps->isEmpty())
        <div class="alert alert-info">Belum ada data RSVP.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Kehadiran</th>
                        <th>Catatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rsvps as $rsvp)
                        <tr>
                            <td>{{ $rsvp->name }}</td>
                            <td>{{ $rsvp->email ?? '-' }}</td>
                            <td>
                                @if($rsvp->attendance === 'yes')
                                    <span class="badge bg-success">Hadir</span>
                                @elseif($rsvp->attendance === 'maybe')
                                    <span class="badge bg-warning text-dark">Mungkin</span>
                                @else
                                    <span class="badge bg-danger">Tidak Hadir</span>
                                @endif
                            </td>
                            <td>{{ $rsvp->note ?? '-' }}</td>
                            <td>
                                <form action="{{ route('rsvps.destroy', $rsvp->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus RSVP ini?')">
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
