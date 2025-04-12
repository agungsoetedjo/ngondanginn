@extends('backend.layouts.app')

@section('content')
  <h2>Register</h2>
  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-3">
      <label>Nama</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Konfirmasi Password</label>
      <input type="password" name="password_confirmation" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Daftar</button>
  </form>
  <p class="mt-2">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
@endsection
