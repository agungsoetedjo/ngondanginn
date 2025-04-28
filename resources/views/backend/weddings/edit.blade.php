@extends('backend.layouts_be.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Edit Undangan</h4>
<div class="p-2">
  <form action="{{ route('weddings.update', $wedding->slug) }}" method="POST">
    @csrf
    @method('PUT')
    @include('backend.weddings._form', ['wedding' => $wedding])
  </form>
</div>
@endsection
