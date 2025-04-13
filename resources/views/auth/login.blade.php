@extends('backend.layouts.app')

@section('content')
<x-toast :type="session('toast.type')" :message="session('toast.message')" :timer="session('toast.timer')" />
  <h2>Login</h2>
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
  <p class="mt-2">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
@endsection
