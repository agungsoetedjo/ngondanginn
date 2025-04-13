@extends('backend.layouts.app')

@section('content')
<div class="container">
  <h2>Daftar Undangan</h2>

  <a href="{{ route('weddings.create') }}" class="btn btn-primary mb-3">+ Buat Undangan Baru</a>

  <table class="table table-bordered table-striped datatable">
    <thead>
      <tr>
        <th>Nama Pengantin</th>
        <th>Tanggal</th>
        <th>Nama Tempat</th>
        <th>Lokasi Tempat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($weddings as $wedding)
        <tr>
          <td>{{ $wedding->bride_name }} & {{ $wedding->groom_name }}</td>
          <td>{{ \Carbon\Carbon::parse($wedding->wedding_date)->format('d M Y H:i') }}</td>
          <td>{{ $wedding->place_name }}</td>
          <td>{{ $wedding->location }}</td>
          <td>
            <!-- Edit Button -->
            <a href="{{ route('weddings.edit', $wedding->slug) }}" class="btn btn-sm btn-warning">
              <i class="bi bi-pencil"></i> Edit
            </a>

            <!-- Delete Button -->
            <form action="{{ route('weddings.destroy', $wedding->id) }}" method="POST" class="d-inline delete-form">
              @csrf
              @method('DELETE')
              <button type="button" class="btn btn-sm btn-danger btn-delete">
                <i class="bi bi-trash"></i> Hapus
              </button>
            </form>            

            <!-- RSVP Button -->
            <a href="{{ route('rsvps.index', $wedding->id) }}" class="btn btn-sm btn-primary">
              <i class="bi bi-person-check"></i> RSVP
            </a>

            <!-- Guestbook Button -->
            <a href="{{ route('guestbooks.index', $wedding->id) }}" class="btn btn-sm btn-primary">
              <i class="bi bi-bookmarks"></i> Buku Tamu
            </a>

            <!-- Gallery Button -->
            <a href="{{ route('galleries.index', $wedding->id) }}" class="btn btn-sm btn-primary">
              <i class="bi bi-images"></i> Galeri
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/ourscript.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function () {
    $('.btn-delete').click(function (e) {
      e.preventDefault();

      const form = $(this).closest('form');

      Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data undangan yang dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });
</script>
@endsection
