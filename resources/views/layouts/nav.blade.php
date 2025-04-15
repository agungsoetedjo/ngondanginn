<header id="header" class="header d-flex align-items-center sticky-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
    <!-- Logo -->
    <a href="/" class="logo d-flex align-items-center me-auto">
      <h1 class="sitename">Ngondang<span class="fw-medium bg-primary text-white px-2 rounded-2">in</span></h1>
    </a>

    <!-- Menu Navigasi -->
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="/#hero" class="active">Home</a></li>
        <li><a href="/#fitur">Fitur</a></li>
        <li><a href="/#pilihantema">Pilihan Tema</a></li>
        <li><a href="/#faq">FAQ</a></li>
        <li><a href="/#testimoni">Testimoni</a></li>
        <li><a href="/#hubungikami">Hubungi Kami</a></li>
        
        <li class="dropdown"><a href="#"><span>Pesan Sekarang</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a href="{{ route('order.create') }}">Buat Pesanan</a></li>
            {{-- <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="#">Deep Dropdown 1</a></li>
                <li><a href="#">Deep Dropdown 2</a></li>
                <li><a href="#">Deep Dropdown 3</a></li>
                <li><a href="#">Deep Dropdown 4</a></li>
                <li><a href="#">Deep Dropdown 5</a></li>
              </ul>
            </li> --}}
            <li><a href="{{ route('order.cek.form') }}">Cek Pesanan</a></li>
          </ul>
        </li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    {{-- <!-- Tombol Pesan Sekarang -->
    <a class="btn ms-3 btn-primary" href="index.html#about">Pesan Sekarang</a> --}}
  </div>
</header>
