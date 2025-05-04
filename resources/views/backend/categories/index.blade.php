@extends('backend.layouts_be.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Daftar Kategori</h4>
<div class="p-2">

    <!-- Button trigger create modal -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
        Tambah Kategori
    </button>

    <table class="table table-bordered table-striped datatable">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->type == 'dengan_foto' ? 'Dengan Foto' : 'Tanpa Foto' }}</td>
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">
                        Edit
                    </button>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button data-title="Yakin ingin menghapus?" data-text="Data Kategori tersebut tidak dapat dikembalikan" class="btn btn-danger btn-sm btn-confirm">Hapus</button>
                    </form>
                </td>
            </tr>
            <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $category->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $category->id }}">Edit Kategori</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Nama</label>
                                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Jenis</label>
                                    <select name="type" id="type" class="form-select form-select-sm w-auto" required>
                                        <option value="" selected>--Pilih--</option>
                                        <option value="dengan_foto" {{ old('type', $category->type ?? '') == 'dengan_foto' ? 'selected' : '' }}>Dengan Foto</option>
                                        <option value="tanpa_foto" {{ old('type', $category->type ?? '') == 'tanpa_foto' ? 'selected' : '' }}>Tanpa Foto</option>
                                    </select>                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Rekening Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Tipe</label>
                            <select name="type" id="type" class="form-select form-select-sm w-auto" required>
                                <option value="" selected>--Pilih--</option>
                                <option value="dengan_foto">Dengan Foto</option>
                                <option value="tanpa_foto">Tanpa Foto</option>
                              </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<x-data-tables />
<x-sweet-alert-confirm />
@endsection