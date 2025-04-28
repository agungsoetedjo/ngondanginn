@extends('backend.layouts_be.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables / RSVP / </span> <strong>{{ $wedding->groom_name }} & {{ $wedding->bride_name }}</strong></h4>
<div class="p-3">
            <table class="table table-bordered table-striped datatable">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Kehadiran</th>
                        <th>Alasan</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rsvps as $rsvp)
                        <tr>
                            <td>{{ $rsvp->name }}</td>
                            <td>
                                @if($rsvp->attendance === 'yes')
                                    <span class="badge bg-success">Hadir</span>
                                @elseif($rsvp->attendance === 'maybe')
                                    <span class="badge bg-warning text-dark">Mungkin</span>
                                @else
                                    <span class="badge bg-danger">Tidak Hadir</span>
                                @endif
                            </td>
                            <td>{{ $rsvp->reason ?? '-' }}</td>
                            <td>{{ $rsvp->createdAtFormatted }}</td> <!-- Menampilkan tanggal RSVP dalam format "3 menit yang lalu" -->
                            <td>
                                <form action="{{ route('rsvps.destroy', $rsvp->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button data-title="Yakin ingin menghapus?" data-text="Data RSVP yang dihapus tidak bisa dikembalikan!" class="btn btn-sm btn-outline-danger btn-delete"><i class="bx bx-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    <a href="{{ route('weddings.index') }}" class="btn btn-secondary mt-4">← Kembali ke Daftar Undangan</a>
</div>
<x-data-tables />
<x-sweet-alert-confirm />
@endsection
