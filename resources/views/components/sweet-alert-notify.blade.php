<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('sweetalert'))
    <script>
        $(function() {
            // Ambil tipe dan pesan dari session sweetalert
            var sweetalert = @json(session('sweetalert'));

            Swal.fire({
                icon: sweetalert.type, // 'success' atau 'error'
                title: sweetalert.type === 'warning' ? 'Peringatan' : (sweetalert.type === 'error' ? 'Error' : 'Sukses'),
                text: sweetalert.message,
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2000
            });
        });
    </script>
@endif