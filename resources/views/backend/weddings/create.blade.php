@extends('backend.layouts.app')

@section('content')
<div class="container">
  <h4>Buat Undangan Baru</h4>

  <form action="{{ route('weddings.store') }}" method="POST">
    @csrf
    @include('backend.weddings._form', ['wedding' => null])
  </form>
</div>
@endsection
