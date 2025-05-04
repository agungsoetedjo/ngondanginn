@extends('backend.layouts_be.app_auth')

@section('content_auth')
<!-- /Logo -->
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
          <div class="card">
              <div class="card-body">
                <h3>Silakan cek email Anda!</h3>
                <p>Jika alamat email yang Anda masukkan terdaftar, Anda akan menerima tautan untuk mereset password Anda dalam beberapa menit.</p>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection