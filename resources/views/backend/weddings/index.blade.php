@extends('backend.layouts.app')

@section('content')
<div class="container">
  <h2>Daftar Undangan</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('weddings.create') }}" class="btn btn-primary mb-3">+ Buat Undangan Baru</a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nama Pengantin</th>
        <th>Tanggal</th>
        <th>Lokasi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($weddings as $wedding)
        <tr>
          <td>{{ $wedding->bride_name }} & {{ $wedding->groom_name }}</td>
          <td>{{ \Carbon\Carbon::parse($wedding->wedding_date)->format('d M Y H:i') }}</td>
          <td>{{ $wedding->location }}</td>
          <td>
            <a href="{{ route('weddings.edit', $wedding->slug) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('weddings.destroy', $wedding->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus undangan ini?')">Hapus</button>
            </form>
            <a href="{{ route('rsvps.index', $wedding->id) }}" class="btn btn-sm btn-primary">RSVP</a>
            <a href="{{ route('guestbooks.index', $wedding->id) }}" class="btn btn-sm btn-primary">Buku Tamu</a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4">Belum ada undangan.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
