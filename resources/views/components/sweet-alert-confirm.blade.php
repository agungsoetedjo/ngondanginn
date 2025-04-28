<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function () {
    $('.btn-confirm').click(function (e) {
      e.preventDefault();

      const form = $(this).closest('form');
      const title = $(this).data('title') || 'Yakin ingin melanjutkan aksi ini?';
      const text = $(this).data('text') || 'Tindakan ini tidak dapat dibatalkan.';

      Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#18743d',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Lanjutkan!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });

  $(document).ready(function () {
    $('.btn-delete').click(function (e) {
      e.preventDefault();

      const form = $(this).closest('form');
      const title = $(this).data('title') || 'Yakin ingin melanjutkan aksi ini?';
      const text = $(this).data('text') || 'Tindakan ini tidak dapat dibatalkan.';

      Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });

  function confirmRejection(kodeTransaksi) {
        Swal.fire({
            title: 'Tolak Pembayaran',
            input: 'text',
            inputLabel: 'Alasan penolakan',
            inputPlaceholder: 'Masukkan alasan pembayaran ditolak',
            showCancelButton: true,
            confirmButtonText: 'Kirim',
            cancelButtonText: 'Batal',
            inputValidator: (value) => {
                if (!value) {
                    return 'Alasan wajib diisi!';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('reject-reason-' + kodeTransaksi).value = result.value;
                document.getElementById('reject-form-' + kodeTransaksi).submit();
            }
        });
    }
</script>