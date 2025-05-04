@extends('backend.layouts_be.app_auth')

@section('content_auth')
<x-toast :type="session('toast.type')" :message="session('toast.message')" :timer="session('toast.timer')" />

<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
          <div class="card">
              <div class="card-body">
                  <h4 class="mb-2">Selemat Datang di Ngondangin!</h4>
                  <p class="mb-4">Silakan daftar akun Anda sebelum mulai petualangan</p>

                  <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
                    @csrf
                      <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama Anda" autofocus required>
                      </div>
                      <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email Anda" required />
                      </div>
                      <div class="mb-3 form-password-toggle">
                          <div class="d-flex justify-content-between">
                              <label class="form-label" for="password">Password</label>
                          </div>
                          <div class="input-group input-group-merge">
                              <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required/>
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                          </div>
                      </div>
                      <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required/>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                      </div>
                      <div class="mb-3">
                          <button class="btn btn-primary d-grid w-100" type="submit">Daftar</button>
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
{{-- <div class="row justify-content-center mt-4">
  <div class="col-10 col-sm-8 col-md-6 col-lg-3">
    <div class="card shadow-lg" style="width: 100%; aspect-ratio: 1; height: auto;">
      <div class="card-header text-center">
        <h5>Register</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-success w-100">Daftar</button>
        </form>
      </div>
      <div class="card-footer text-center">
        <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
      </div>
    </div>
  </div>
</div> --}}

@endsection
