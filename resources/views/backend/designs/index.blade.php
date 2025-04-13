@extends('backend.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manajemen Template Undangan</h2>
        <a href="{{ route('designs.create') }}" class="btn btn-primary">+ Tambah Template</a>
    </div>

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
                        <td>
                            <a href="{{ route('designs.preview', $design->id) }}" class="btn btn-sm btn-info" target="_blank">
                                Preview
                            </a>                            
                            <a href="{{ route('designs.edit', $design->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            <form action="{{ route('designs.destroy', $design->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus template ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada template</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
