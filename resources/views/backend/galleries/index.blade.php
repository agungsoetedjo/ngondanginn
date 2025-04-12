@extends('backend.layouts.app')

@section('title', 'Galeri Foto')

@section('content')
<div class="container">
    <h2 class="mb-4">Galeri Foto: <strong>{{ $wedding->bride_name }} & {{ $wedding->groom_name }}</strong></h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('galleries.store', $wedding->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Upload Foto</label>
            <input type="file" name="image" id="image" class="form-control" required>
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
                            <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <a href="{{ route('weddings.index') }}" class="btn btn-secondary mt-4">← Kembali ke Daftar Undangan</a>
</div>
@endsection
