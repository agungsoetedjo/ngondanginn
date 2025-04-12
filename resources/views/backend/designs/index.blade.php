@extends('layouts.backend')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Pilih Template Undangan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        {{-- Kiri: Daftar Template --}}
        <div class="col-md-4">
            <div class="list-group">
                @foreach($templates as $template)
                    <a href="#" class="list-group-item list-group-item-action preview-template {{ $wedding->template_id == $template->id ? 'active' : '' }}"
                       data-id="{{ $template->id }}"
                       data-name="{{ $template->name }}"
                       data-image="{{ asset('images/templates/' . $template->preview_image) }}">
                        {{ $template->name }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Kanan: Preview Template --}}
        <div class="col-md-8">
            <div class="card">
                <img id="templatePreview" src="{{ $wedding->template?->preview_image ? asset('images/templates/' . $wedding->template->preview_image) : 'https://via.placeholder.com/800x400?text=Preview+Template' }}" class="card-img-top" alt="Preview Template">
                <div class="card-body">
                    <h5 class="card-title" id="templateName">{{ $wedding->template?->name ?? 'Belum ada template dipilih' }}</h5>

                    <form id="formChooseTemplate" action="{{ route('designs.update', $wedding->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="template_id" id="selectedTemplateId" value="{{ $wedding->template_id }}">
                        <button type="submit" class="btn btn-primary mt-2">Gunakan Template Ini</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script langsung --}}
<script>
    document.querySelectorAll('.preview-template').forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault();

            const name = this.dataset.name;
            const image = this.dataset.image;
            const id = this.dataset.id;

            document.getElementById('templatePreview').src = image;
            document.getElementById('templateName').textContent = name;
            document.getElementById('selectedTemplateId').value = id;

            document.querySelectorAll('.preview-template').forEach(el => el.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
@endsection
