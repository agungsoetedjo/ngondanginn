@extends('backend.layouts_be.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Edit Template : {{ $template->name }}</h4>
<div class="p-2">
    @include('backend.designs._form', ['template' => $template])
</div>
<x-view-path-preview-image-template />
@endsection
