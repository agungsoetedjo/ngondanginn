@extends('backend.layouts.app')

@section('content')
<x-toast :type="session('toast.type')" :message="session('toast.message')" :timer="session('toast.timer')" />

<div class="row justify-content-center mt-4">
  <div class="col-10 col-sm-8 col-md-6 col-lg-4">
    <div class="card shadow-lg" style="width: 100%; aspect-ratio: 1; height: auto;">
      <div class="card-header text-center">
        <h2>Login</h2>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
      </div>
      <div class="card-footer text-center">
        <p class="mb-0">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
      </div>
    </div>
  </div>
</div>

@endsection
