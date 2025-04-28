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
                  <h4 class="mb-2">Welcome to NgondangIn! 👋</h4>
                  <p class="mb-4">Silakan masuk ke akun Anda dan mulai petualangan</p>

                  <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                    @csrf
                      <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus />
                      </div>
                      <div class="mb-3 form-password-toggle">
                          <div class="d-flex justify-content-between">
                              <label class="form-label" for="password">Password</label>
                              {{-- <a href="auth-forgot-password-basic.html">
                                  <small>Forgot Password?</small>
                              </a> --}}
                          </div>
                          <div class="input-group input-group-merge">
                              <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                          </div>
                      </div>
                      {{-- <div class="mb-3">
                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="remember-me" />
                              <label class="form-check-label" for="remember-me"> Remember Me </label>
                          </div>
                      </div> --}}
                      <div class="mb-3">
                          <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                      </div>
                  </form>

                  <p class="text-center">
                      <span>Baru di platform kami?</span>
                      <a href="{{ route('register') }}">
                          <span>Buat akun</span>
                      </a>
                  </p>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
