@extends('backend.layouts_be.app_auth')

@section('content_auth')
@if (session('toast'))
    <x-toast 
        :type="session('toast.type')" 
        :message="session('toast.message')" 
        :timer="session('toast.timer')" 
    />
@endif
<!-- /Logo -->
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
          <div class="card">
              <div class="card-body">
                <h4 class="mb-2">Verifikasi Akun Anda</h4>
                <p class="mb-4">Masukkan kode OTP yang telah dikirimkan ke email Anda untuk melanjutkan.</p>
                <p class="text-muted">Kode OTP berlaku selama {{ session('otp_duration') }} menit.</p>

                  <form id="formAuthentication" class="mb-3" action="{{ route('otp.verify') }}" method="POST">
                    @csrf
                      <div class="mb-3">
                          <label for="email" class="form-label">Masukkan OTP</label>
                          <input type="text" class="form-control" id="otp" name="otp" maxlength="6" placeholder="XXXXXX" inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')"  autofocus />
                      </div>
                      <div class="mb-3">
                          <button class="btn btn-primary d-grid w-100" type="submit">Verifikasi</button>
                      </div>
                  </form>
                  <form action="{{ route('otp.resend') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <button class="btn btn-success d-grid w-100" type="submit">Kirim Ulang Kode</button>
                    </div>
                </form>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
{{-- 

<form method="POST" action="{{ route('otp.verify') }}">
    @csrf
    <label for="otp">Masukkan OTP</label>
    <input type="text" name="otp" maxlength="6" required class="form-control" />
    <button type="submit" class="btn btn-primary mt-2">Verifikasi</button>
</form> --}}