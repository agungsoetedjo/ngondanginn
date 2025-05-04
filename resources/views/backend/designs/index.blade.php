@extends('backend.layouts_be.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Template</h4>
<div class="p-2">
    <a href="{{ route('designs.create') }}" class="btn btn-primary mb-3">+ Tambah Template</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

        <table class="table table-bordered table-striped datatable">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th>View Path</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($templates as $design)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $design->name }}</td>
                        <td>{{ $design->category->name ?? '-' }} {{ $design->category->type == 'dengan_foto' ? 'Dengan Foto' : 'Tanpa Foto' }}</td>
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
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{ route('designs.preview', $design->id) }}" class="dropdown-item" target="_blank">
                                        <i class="bx bx-show"></i> Preview
                                    </a>
                                    <a href="{{ route('designs.edit', $design->id) }}" class="dropdown-item">
                                        <i class="bx bx-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('designs.destroy', $design->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button data-title="Yakin ingin menghapus?" data-text="Template yang dihapus tidak bisa dikembalikan!" class="dropdown-item btn-delete"><i class="bx bx-trash"></i> Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>            
        </table>
    </div>
</div>
<x-data-tables />
<x-sweet-alert-confirm />
@endsection
