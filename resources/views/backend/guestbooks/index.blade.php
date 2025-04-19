@extends('backend.layouts.app')

@section('title', 'Buku Tamu')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container">
    <h4 class="mb-4">Buku Tamu untuk: <strong>{{ $wedding->bride_name }} & {{ $wedding->groom_name }}</strong></h4>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2000,
            });
        </script>
    @endif

        <div class="table-responsive">
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
                                    <button class="btn btn-sm btn-outline-danger btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    <a href="{{ route('weddings.index') }}" class="btn btn-secondary mt-4">← Kembali ke Daftar Undangan</a>
</div>
<script src="{{ asset('assets/js/ourscript.js') }}"></script>
<script>
    $(document).ready(function () {
      $('.btn-delete').click(function (e) {
        e.preventDefault();
  
        const form = $(this).closest('form');
  
        Swal.fire({
          title: 'Yakin ingin menghapus?',
          text: "Data Tamu yang dihapus tidak bisa dikembalikan!",
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
