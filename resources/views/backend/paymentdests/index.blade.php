@extends('backend.layouts_be.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Daftar Rekening Tujuan</h4>
<div class="p-2">

    <!-- Button trigger create modal -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
        Tambah Rekening
    </button>

    <!-- Table -->
    <table class="table table-bordered table-striped datatable">
        <thead>
            <tr>
                <th>Bank</th>
                <th>No Rekening</th>
                <th>Nama Pemilik</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paymentDests as $payment)
                <tr>
                    <td>{{ $payment->bank_name }}</td>
                    <td>{{ $payment->account_number }}</td>
                    <td>{{ $payment->account_name }}</td>
                    <td>
                        <!-- Edit button -->
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $payment->id }}">
                            Edit
                        </button>

                        <!-- Delete -->
                        <form action="{{ route('paymentdests.destroy', $payment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button data-title="Yakin ingin menghapus?" data-text="Data rekening tujuan tersebut tidak dapat dikembalikan" class="btn btn-danger btn-sm btn-confirm">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $payment->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $payment->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('paymentdests.update', $payment->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $payment->id }}">Edit Rekening</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Bank</label>
                                        <input type="text" name="bank_name" class="form-control" value="{{ $payment->bank_name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nomor Rekening</label>
                                        <input type="text" name="account_number" class="form-control" value="{{ $payment->account_number }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nama Pemilik</label>
                                        <input type="text" name="account_name" class="form-control" value="{{ $payment->account_name }}" required>
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

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('paymentdests.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Rekening Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Bank</label>
                            <input type="text" name="bank_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Nomor Rekening</label>
                            <input type="text" name="account_number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Nama Pemilik</label>
                            <input type="text" name="account_name" class="form-control" required>
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
