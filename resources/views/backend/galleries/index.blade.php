@extends('backend.layouts.app')

@section('title', 'Galeri Foto')

@section('content')
<div class="container">
    <h4 class="mb-4">Galeri Foto: <strong>{{ $wedding->bride_name }} & {{ $wedding->groom_name }}</strong></h4>

    <form action="{{ route('galleries.store', $wedding->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Upload Foto</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Keterangan</label>
          <select name="image_desc" id="image_desc" class="form-select form-select-sm w-auto" required>
            <option value="" selected>--Pilih--</option>
            <option value="1">Cover Depan & Belakang</option>
            <option value="2">Foto Mempelai Pria</option>
            <option value="3">Foto Mempelai Wanita</option>
            <option value="0">Galeri Foto</option>
          </select>
        </div>
        <button class="btn btn-primary">Upload</button>
    </form>

    @if($wedding->galleries->isEmpty())
        <div class="alert alert-info">Belum ada foto.</div>
    @else
        <div class="row">
            @foreach($wedding->galleries as $gallery)
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset($gallery->image) }}" class="card-img-top" alt="Gallery Image">
                        <div class="card-body text-center">
                            <p class="text-muted" style="font-size: 0.9em;">
                              Keterangan: 
                              @switch($gallery->image_desc)
                                  @case(1)
                                      Cover Depan & Belakang
                                      @break
                                  @case(2)
                                      Foto Mempelai Pria
                                      @break
                                  @case(3)
                                      Foto Mempelai Wanita
                                      @break
                                  @default
                                      Galeri Foto
                              @endswitch
                            </p>
                            <p class="text-muted" style="font-size: 0.9em;">
                                Diunggah: {{ $gallery->createdAtFormatted }} <!-- Menampilkan tanggal -->
                            </p>
                            <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger btn-delete">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <a href="{{ route('weddings.index') }}" class="btn btn-secondary">← Kembali ke Daftar Undangan</a>
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
        text: "Foto yang dihapus tidak bisa dikembalikan!",
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
