@extends('backend.layouts_be.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Buat Undangan Baru</h4>
<div class="p-2">
  <form action="{{ route('weddings.store') }}" method="POST">
    @csrf
    @include('backend.weddings._form', ['wedding' => null])
  </form>
</div>
@endsection
