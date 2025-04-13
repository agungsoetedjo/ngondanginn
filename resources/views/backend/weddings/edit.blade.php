@extends('backend.layouts.app')

@section('content')
<div class="container">
  <h4>Edit Undangan</h4>

  <form action="{{ route('weddings.update', $wedding->slug) }}" method="POST">
    @csrf
    @method('PUT')
    @include('backend.weddings._form', ['wedding' => $wedding])
  </form>
</div>
@endsection
