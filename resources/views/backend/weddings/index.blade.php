@extends('backend.layouts_be.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Undangan</h4>
<div class="p-3">

  {{-- <a href="{{ route('weddings.create') }}" class="btn btn-primary mb-3">+ Buat Undangan Baru</a> --}}

  <table class="table table-bordered table-striped datatable">
    <thead>
      <tr>
        <th>Pasangan</th>
        <th>Tanggal</th>
        <th>Lokasi</th>
        <th>Link</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($weddings as $wedding)
        <tr>
          <td>{{ $wedding->groom_name }} & {{ $wedding->bride_name }}</td>
          <td>
            Akad: {{ $wedding->formatted_akad_date ?? '-' }} <br>
            Resepsi: {{ $wedding->formatted_reception_date ?? '-' }}
          </td>
          <td>
            Akad : {{ $wedding->akad_place_name }} - {{ $wedding->akad_location }} <br>
            Resepsi : {{ $wedding->reception_place_name }} - {{ $wedding->reception_location }}
          </td>
          <td>
            @if(in_array($wedding->order->status, ['processed', 'published', 'completed']))
            <a href="{{ route('wedding.checks', $wedding->slug) }}" target="_blank">
              <span class="badge bg-primary">Cek Undangan</span>
            </a>
            @else
            <span class="badge bg-danger">Undangan belum diproses</span>
            @endif
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a href="{{ route('weddings.edit', $wedding->slug) }}" class="dropdown-item">
                  <i class="bx bx-pencil"></i> Edit
                </a>
                <form action="{{ route('weddings.destroy', $wedding->id) }}" method="POST" class="d-inline delete-form">
                  @csrf
                  @method('DELETE')
                  <button data-title="Yakin ingin menghapus?" data-text="Data undangan yang dihapus tidak bisa dikembalikan!" class="dropdown-item btn-delete">
                    <i class="bx bx-trash"></i> Hapus
                  </button>
                </form>
                @if ($wedding->order->status !== 'created')
                <a href="{{ route('rsvps.index', $wedding->id) }}" class="dropdown-item">
                  <i class="bx bx-user-check"></i> RSVP
                </a>
                <a href="{{ route('guestbooks.index', $wedding->id) }}" class="dropdown-item">
                  <i class="bx bx-book"></i> Buku Tamu
                </a>
                {{-- @if (!$wedding->template->category->type === 'tanpa_foto') --}}
                <a href="{{ route('galleries.index', $wedding->id) }}" class="dropdown-item">
                  <i class="bx bx-images"></i> Galeri
                </a>
                {{-- @endif --}}
              @endif
              </div>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
<x-data-tables />
<x-sweet-alert-confirm />
@endsection
