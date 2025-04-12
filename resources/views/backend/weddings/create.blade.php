@extends('backend.layouts.app')

@section('content')
<div class="container">
  <h2>Buat Undangan Baru</h2>

  <form action="{{ route('weddings.store') }}" method="POST">
    @csrf
    @include('backend.weddings._form', ['wedding' => null])
  </form>
</div>
@endsection
