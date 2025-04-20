<header id="header" class="header d-flex align-items-center sticky-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
    <!-- Logo -->
    <a href="/" class="logo d-flex align-items-center me-auto">
      <h1 class="sitename">Ngondang<span class="fw-medium bg-primary text-white px-2 rounded-2">in</span></h1>
    </a>

    <!-- Menu Navigasi -->
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="/#hero" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
        <li><a href="/#fitur" class="{{ request()->is('/') ? 'active' : '' }}">Fitur</a></li>
        <li><a href="/#pilihantema" class="{{ request()->is('/') ? 'active' : '' }}">Pilihan Tema</a></li>
        <li><a href="/#faq" class="{{ request()->is('/') ? 'active' : '' }}">FAQ</a></li>
        <li><a href="/#testimoni" class="{{ request()->is('/') ? 'active' : '' }}">Testimoni</a></li>
        <li><a href="/#hubungikami" class="{{ request()->is('/') ? 'active' : '' }}">Hubungi Kami</a></li>
    
        <li class="dropdown">
          <a href="#" class="{{ request()->is('pesan-undangan') || request()->is('cek-pesanan') ? 'active' : '' }}">
              <span>Pesan Sekarang</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
          </a>
          <ul>
              <li><a href="{{ route('order.create') }}" class="{{ request()->is('pesan-undangan') ? 'active' : '' }}">Buat Pesanan</a></li>
              <li><a href="{{ route('order.cek.form') }}" class="{{ request()->is('cek-pesanan') ? 'active' : '' }}">Cek Pesanan</a></li>
          </ul>
      </li>
      </ul>    
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
  </div>
</header>
