@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h4>Manajemen Template Undangan</h4>
    <a href="{{ route('designs.create') }}" class="btn btn-primary mb-3">+ Tambah Template</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th>View Path</th>
                    <th>Harga</th> <!-- Tambahan -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($templates as $design)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $design->name }}</td>
                        <td>
                            @if($design->preview_image)
                                <img src="{{ asset('images/templates/' . $design->preview_image) }}" alt="Preview" width="120">
                            @else
                                <em>Tidak ada</em>
                            @endif
                        </td>
                        <td><code>{{ $design->view_path }}</code></td>
                        <td>Rp{{ number_format($design->price, 0, ',', '.') }}</td> <!-- Tambahan -->
                        <td>
                            <a href="{{ route('designs.preview', $design->id) }}" class="btn btn-sm btn-info" target="_blank">
                                Preview
                            </a>
                            <a href="{{ route('designs.edit', $design->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            <form action="{{ route('designs.destroy', $design->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada template</td>
                    </tr>
                @endforelse
            </tbody>            
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function () {
    $('.btn-delete').click(function (e) {
      e.preventDefault();

      const form = $(this).closest('form');

      Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Template yang dihapus tidak bisa dikembalikan!",
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
