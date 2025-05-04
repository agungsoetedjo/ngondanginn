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
                  <h4 class="mb-2">Lupa Password?</h4>
                  <p class="mb-4">Silakan masukkan email Anda untuk proses reset password</p>

                  <form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
                    @csrf
                      <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email Anda" autofocus />
                      </div>
                      <div class="mb-3">
                          <button class="btn btn-primary d-grid w-100" type="submit">Kirim Link Reset</button>
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
