@extends('backend.layouts.app')

@section('content')
  <div class="text-center">
    <h1>Hai, {{ $user->name }}</h1>
    <p>Selamat datang di dashboard undangan digitalmu.</p>
    <a href="{{ route('weddings.index') }}" class="btn btn-primary mt-3">Kelola Undangan</a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-danger">Logout</button>
  </form>
  </div>
@endsection
