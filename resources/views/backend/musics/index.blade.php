@extends('backend.layouts_be.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables / </span> <strong> Musik </strong></h4>
<div class="p-3">
    <form action="{{ route('musics.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul Musik</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="artist" class="form-label">Nama Artist</label>
            <input type="text" name="artist" id="artist" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Upload File Musik (MP3)</label>
            <input type="file" name="file" id="file" class="form-control" accept="audio/mp3" required>
        </div>
        <button class="btn btn-primary">Upload</button>
    </form>
    

    @if($musics->isEmpty())
        <div class="alert alert-info">Belum ada musik yang diunggah.</div>
    @else
    <ul class="list-group">
        @foreach($musics as $music)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $music->title }}</strong><br>
                    <em>{{ $music->artist }}</em><br> <!-- Menampilkan artist -->
                    <audio controls style="width: 500px">
                        <source src="{{ asset($music->file_path) }}" type="audio/mp3">
                        Browser tidak mendukung audio.
                    </audio>
                </div>
                <form action="{{ route('musics.destroy', $music->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button data-title="Yakin ingin menghapus?" data-text="Musik yang dihapus tidak bisa dikembalikan!" class="btn btn-sm btn-outline-danger btn-delete"><i class="bx bx-trash"></i> Hapus</button>
                </form>                    
            </li>
        @endforeach
    </ul>    
    @endif
</div>
<x-sweet-alert-confirm />
@endsection
