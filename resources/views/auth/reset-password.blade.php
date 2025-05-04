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
                  <h4 class="mb-2">Reset Password</h4>
                  <p class="mb-4">Silakan masukkan password baru Anda untuk melanjutkan</p>

                  <form id="formAuthentication" class="mb-3" action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password Baru</label>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required/>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required/>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit">Reset Password</button>
                    </div>
                  </form>

                  <p class="text-center">
                    <span>Sudah punya akun?</span>
                    <a href="{{ route('login') }}">
                        <span>Login</span>
                    </a>
                </p>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
