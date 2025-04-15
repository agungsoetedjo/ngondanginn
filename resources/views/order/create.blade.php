@extends('layouts.app')

@section('content')
<section id="starter-section" class="starter-section section">

    @if(session('order_success') && session('order_success.kode_transaksi'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const kode = @json(session('order_success.kode_transaksi'));
                const url = `{{ url('/cek-pesanan') }}/${kode}/result`;

                Swal.fire({
                    title: 'Pesanan Berhasil!',
                    html: `
                        <p>Kode Transaksi Anda:</p>
                        <strong id="kodeTransaksi">${kode}</strong>
                        <br>
                        <button id="btnCopy" class="btn btn-sm btn-outline-primary mt-2">Salin Kode</button>
                        <br>
                        <a href="${url}" class="btn btn-sm btn-success mt-2">Lihat Pesanan</a>
                    `,
                    icon: 'success',
                    confirmButtonText: 'Tutup',
                    didRender: () => {
                        document.getElementById('btnCopy').addEventListener('click', () => {
                            const kodeText = document.getElementById("kodeTransaksi").innerText;
                            navigator.clipboard.writeText(kodeText).then(() => {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true,
                                });

                                Toast.fire({
                                    icon: 'success',
                                    title: 'Kode disalin!'
                                });
                            });
                        });
                    }
                });
            });
        </script>
    @endif


    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <span>Pesan Undangan Digital</span>
        <h2>Pesan Undangan Digital</h2>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up">
        <form action="{{ route('order.store') }}" method="POST">
            @csrf
        
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="bride_name" class="form-label">Nama Mempelai Wanita</label>
                        <input type="text" name="bride_name" id="bride_name" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="groom_name" class="form-label">Nama Mempelai Pria</label>
                        <input type="text" name="groom_name" id="groom_name" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="bride_parents_info" class="form-label">Orang Tua Mempelai Wanita</label>
                        <input type="text" name="bride_parents_info" id="bride_parents_info" class="form-control"
                            placeholder="Contoh: Putri dari Ayah X dan Ibu Y">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="groom_parents_info" class="form-label">Orang Tua Mempelai Pria</label>
                        <input type="text" name="groom_parents_info" id="groom_parents_info" class="form-control"
                            placeholder="Contoh: Putra dari Ayah A dan Ibu B">
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="akad_date" class="form-label">Tanggal & Waktu Akad</label>
                        <input type="datetime-local" name="akad_date" id="akad_date" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="reception_date" class="form-label">Tanggal & Waktu Resepsi</label>
                        <input type="datetime-local" name="reception_date" id="reception_date" class="form-control" required>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="place_name" class="form-label">Tempat Acara</label>
                        <input type="text" name="place_name" id="place_name" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="location" class="form-label">Alamat Lengkap</label>
                        <input type="text" name="location" id="location" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi (Opsional)</label>
                        <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Nomor HP Pemesan</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="template_id" class="form-label">Pilih Template Undangan</label>
                        <select name="template_id" id="template_id" class="form-select" required>
                            <option value="">Pilih Template</option>
                            @foreach($templates as $template)
                                <option value="{{ $template->id }}">{{ $template->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="music_id" class="form-label">Pilih Musik Latar</label>
                        <select name="music_id" id="music_id" class="form-select">
                            <option value="">-- Tidak Ada Musik --</option>
                            @foreach($musics as $music)
                                <option value="{{ $music->id }}">{{ $music->title }} - {{ $music->artist }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        
            <button type="submit" class="btn btn-primary">Pesan Undangan</button>
        </form>
        
    </div>

</section><!-- /Starter Section Section -->
@endsection
