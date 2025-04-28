@extends('backend.layouts_be.app')

@section('content')
<x-toast :type="session('toast.type')" :message="session('toast.message')" :timer="session('toast.timer')" />
  <div class="text-center">
    <h1>Hai, {{ $user->name }}</h1>
    <p>Selamat datang di dashboard undangan digitalmu.</p>
    @if (Auth::user()->role_id === 1)
      <a href="{{ route('weddings.index') }}" class="btn btn-primary mt-3">Kelola Undangan</a>
    @else
      <a href="{{ route('payments.index') }}" class="btn btn-primary mt-3">Kelola Pembayaran</a>
    @endif
  </div>
@endsection
