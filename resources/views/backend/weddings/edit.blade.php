@extends('backend.layouts.app')

@section('content')
<div class="container">
  <h2>Edit Undangan</h2>

  <form action="{{ route('weddings.update', $wedding->slug) }}" method="POST">
    @csrf
    @method('PUT')
    @include('backend.weddings._form', ['wedding' => $wedding])
  </form>
</div>
@endsection
