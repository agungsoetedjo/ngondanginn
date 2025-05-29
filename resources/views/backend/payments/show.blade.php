@extends('backend.layouts_be.app')

@section('content')
    <div class="card p-3">
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <th class="fw-bold fs-6" style="width: 25%">Nama Pemesan</th>
                    <td>{{ $order->nama_pemesan }}</td>
                </tr>
                <tr>
                    <th class="fw-bold fs-6">Nomor HP Pemesan</th>
                    <td>{{ $order->phone_number }}</td>
                </tr>
                <tr>
                    <th class="fw-bold fs-6">Status Pesanan</th>
                    <td><x-order-badge-status :status="$order->status" /></td>
                </tr>
                <tr>
                    <th class="fw-bold fs-6">Total Pembayaran</th>
                    <td>Rp{{ number_format($order->payment->payment_total, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="fw-bold fs-6">Tujuan Pembayaran</th>
                    <td>
                        {{ $order->payment->paymentDest->bank_name }} -
                        {{ $order->payment->paymentDest->account_number }} a.n
                        {{ $order->payment->paymentDest->account_name }}
                    </td>
                </tr>
                <tr>
                    <th class="fw-bold fs-6">Bukti Pembayaran</th>
                    <td>
                        <button type="button" class="badge bg-primary text-white border-0" data-bs-toggle="modal"
                            data-bs-target="#buktiPembayaranModal">
                            Lihat Bukti
                        </button>
                    </td>
                </tr>
                <tr>
                    <th class="fw-bold fs-6">Waktu Pembayaran</th>
                    <td>{{ $order->payment->formatted_created_at ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="fw-bold fs-6">Catatan dari Bendahara</th>
                    <td>{{ optional($order->payment)->payment_desc ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="fw-bold fs-6">Status Pembayaran</th>
                    <td><x-payment-badge-status :payment_status="$order->payment->payment_status" /></td>
                </tr>
                <tr>
                    <th class="fw-bold fs-6">Bendahara</th>
                    <td>{{ $order->payment->user->name ?? 'Pembayaran belum diverifikasi' }}</td>
                </tr>
            </tbody>
        </table>


        <!-- Modal -->
        <div class="modal fade" id="buktiPembayaranModal" tabindex="-1" aria-labelledby="buktiPembayaranLabel"
            aria-hidiven="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="buktiPembayaranLabel">Bukti Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset($order->payment->payment_proof) }}" alt="Bukti Pembayaran"
                            class="img-fluid w-50">
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="d-flex gap-2">
            @if ($order->payment->payment_status === 'waiting_verify')
                <form action="{{ route('payments.approve', $order->kode_transaksi) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" data-title="Verifikasi Pembayaran" data-text="Pembayaran akan segera diterima"
                        class="btn btn-success btn-confirm"><i class="bx bx-check-circle"></i> Verifikasi</button>
                </form>
                <form id="reject-form-{{ $order->kode_transaksi }}"
                    action="{{ route('payments.reject', $order->kode_transaksi) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="reason" id="reject-reason-{{ $order->kode_transaksi }}">
                    <button type="button" class="btn btn-danger"
                        onclick="confirmRejection('{{ $order->kode_transaksi }}')"><i class="bx bx-x-circle"></i>
                        Tolak</button>
                </form>
            @endif
        </div>



        <div class="d-flex gap-2">
            <a href="{{ route('payments.index') }}" class="btn btn-secondary ms-auto">Kembali</a>
        </div>
    </div>
    <x-sweet-alert-confirm />
@endsection
