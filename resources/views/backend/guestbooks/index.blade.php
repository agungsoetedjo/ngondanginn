@extends('backend.layouts_be.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables / Buku Tamu / </span> <strong>{{ $wedding->groom_name }} & {{ $wedding->bride_name }}</strong></h4>
<div class="p-3">
            <table class="table table-bordered table-striped datatable">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Pesan</th>
                        <th>Waktu</th>
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
                                <form action="{{ route('guestbooks.destroy', $guest->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button data-title="Yakin ingin menghapus?" data-text="Data Tamu yang dihapus tidak bisa dikembalikan!" class="btn btn-sm btn-outline-danger btn-delete"><i class="bx bx-trash"></i> Hapus</button>
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
