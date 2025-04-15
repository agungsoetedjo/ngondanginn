{{-- resources/views/templates/custom_template.blade.php --}}
@extends('backend.layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Undangan Pernikahan - {{ $wedding->name }}</h2>

    <p>{{ $wedding->date->format('d M Y H:i') }}</p>

    <div class="guest-message">
        <h3>Pesan untuk Tamu</h3>
        <p>{{ $wedding->message }}</p>
    </div>

    <div class="rsvp-section">
        <h3>Konfirmasi Kehadiran</h3>
        <form action="{{ route('rsvps.store', $wedding->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="attendance">Apakah Anda akan hadir?</label>
                <select name="attendance" id="attendance" class="form-control">
                    <option value="yes">Ya</option>
                    <option value="no">Tidak</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Kirim Konfirmasi</button>
        </form>
    </div>
</div>
@endsection
