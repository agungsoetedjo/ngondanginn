@extends('backend.layouts.app')

@section('title', 'Manajemen Musik')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Musik Latar</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('musics.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul Musik</label>
            <input type="text" name="title" id="title" class="form-control" required>
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
                        <audio controls style="width: 200px">
                            <source src="{{ asset($music->file_path) }}" type="audio/mp3">
                            Browser tidak mendukung audio.
                        </audio>
                    </div>
                    <form action="{{ route('musics.destroy', $music->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus musik ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                </li>
            @endforeach

        </ul>
    @endif
</div>
@endsection
