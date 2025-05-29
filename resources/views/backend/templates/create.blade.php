@extends('backend.layouts_be.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Tambah Template</h4>
<div class="p-2">
    @include('backend.templates._form')
</div>
<x-view-path-preview-image-template />
@endsection
