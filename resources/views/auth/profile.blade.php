@extends('backend.layouts_be.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengaturan Profil /</span> Akun</h4>
<x-toast :type="session('toast.type')" :message="session('toast.message')" :timer="session('toast.timer')" />
<div class="row">
  <form id="formAccountSettings" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Detil Profil</h5>
      <!-- Account -->
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          @php
              $photo = $user->photo ?? 'default.jpg';
          @endphp 
          <img
            src="{{ asset($user->photo ?? 'assets_be/img/avatars/default.jpg') }}"
            alt="user-avatar"
            class="d-block rounded"
            height="100"
            width="100"
            id="uploadedAvatar"
          />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Unggah foto baru</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input
                type="file"
                id="upload"
                name="photo"
                class="account-file-input"
                hidden
                accept="image/png, image/jpeg, image/jpg"
              />
            </label>
            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4" onclick="resetPhoto()">
              <i class="bx bx-reset d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Reset</span>
            </button>

            <p class="text-muted mb-0">Allowed JPG, JPEG or PNG. Max size of 3MB</p>
          </div>
        </div>
      </div>
      <hr class="my-0" />
      <div class="card-body">
        
            
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="firstName" class="form-label">Nama Lengkap</label>
              <input
                class="form-control"
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $user->name) }}"
                autofocus
              />
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">E-mail</label>
              <input
                class="form-control"
                type="text"
                id="email"
                name="email"
                value="{{ old('email', $user->email) }}"
              />
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Kata Sandi Baru (Opsional)</label>
                <input
                  class="form-control"
                  type="password"
                  id="password"
                  name="password"
                />
              </div>
              <div class="mb-3 col-md-6">
                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                <input
                  class="form-control"
                  type="password"
                  id="password_confirmation"
                  name="password_confirmation"
                />
              </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
            <button type="reset" class="btn btn-outline-secondary">Batal</button>
          </div>
        
      </div>
      <!-- /Account -->
    {{-- </div>
    <div class="card">
      <h5 class="card-header">Delete Account</h5>
      <div class="card-body">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning">
            <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
            <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
          </div>
        </div>
        <form id="formAccountDeactivation" onsubmit="return false">
          <div class="form-check mb-3">
            <input
              class="form-check-input"
              type="checkbox"
              name="accountActivation"
              id="accountActivation"
            />
            <label class="form-check-label" for="accountActivation"
              >I confirm my account deactivation</label
            >
          </div>
          <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
        </form>
      </div>
    </div> --}}
  </div>
</form>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const uploadInput = document.getElementById('upload');
    const avatar = document.getElementById('uploadedAvatar');

    // Set default photo or user's current photo
    let currentPhoto = "{{ asset($user->photo ?? 'assets_be/img/avatars/default.jpg') }}";
    avatar.src = currentPhoto;

    // Event listener untuk mengganti gambar
    uploadInput.addEventListener('change', function () {
      const file = this.files[0];
      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (e) {
          avatar.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    });

    // Fungsi reset foto
    window.resetPhoto = function () {
      // Cek apakah foto ada di database, jika ada, pakai foto itu, kalau tidak, pakai default
      avatar.src = currentPhoto;
      uploadInput.value = '';  // Reset input file
    };
  });
</script>
@endsection
