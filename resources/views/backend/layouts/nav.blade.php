<style>
  .navbar {
    background-color: #37517e !important; /* Warna utama eNno */
  }
  
  .navbar .nav-link {
    color: #ffffff !important; /* Putih default */
    transition: color 0.3s;
  }
  
  .navbar .nav-link:hover {
    color: #ffc107 !important; /* Kuning terang saat hover */
  }
  
  .navbar .nav-link.active {
    color: #ffc107 !important; /* Kuning terang untuk menu aktif */
    font-weight: 600;
  }
  
  /* Dropdown */
  .dropdown-menu {
    background-color: #37517e;
  }
  
  .dropdown-item {
    color: #ffffff;
  }
  
  .dropdown-item:hover,
  .dropdown-item.active {
    color: #ffc107;
    background-color: transparent;
  }
  
  </style>
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="/dashboard"><h5 class="sitename">Ngondang<span class="fw-small bg-primary text-white px-2 rounded-2">in</span></h5></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          @auth
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}" href="{{ route('dashboard') }}">
              Dashboard
            </a>
          </li>
          @if (Auth::user()->role_id === 1)
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('weddings.*', 'musics.*', 'designs.*') ? 'active fw-bold' : '' }}" 
               href="#" id="dataDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Data
            </a>
            <ul class="dropdown-menu" aria-labelledby="dataDropdown">
              <li>
                <a class="dropdown-item {{ request()->routeIs('weddings.*') ? 'active' : '' }}" href="{{ route('weddings.index') }}">
                  Undangan
                </a>
              </li>
              <li>
                <a class="dropdown-item {{ request()->routeIs('musics.*') ? 'active' : '' }}" href="{{ route('musics.index') }}">
                  Musik
                </a>
              </li>
              <li>
                <a class="dropdown-item {{ request()->routeIs('designs.*') ? 'active' : '' }}" href="{{ route('designs.index') }}">
                  Template
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs(['orders.index','orders.show']) ? 'active fw-bold' : '' }}" href="{{ route('orders.index') }}">
              Pesanan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs(['index-archive','show-archive']) ? 'active fw-bold' : '' }}" href="{{ route('index-archive') }}">
              Arsip
            </a>
          </li>
          @endif
          @if (Auth::user()->role_id === 2)
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs(['payments.index','payments.show']) ? 'active fw-bold' : '' }}" href="{{ route('payments.index') }}">
              Pembayaran
            </a>
          </li>
          @endif
          @endauth
        </ul>
        <ul class="navbar-nav ms-auto">
          @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('profile.*') ? 'active fw-bold' : '' }}" 
               href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               
               {{-- Icon Gear untuk Desktop --}}
               <i class="bi bi-gear-fill d-none d-lg-inline"></i>
               
               {{-- Teks untuk Mobile --}}
               <span class="d-inline d-lg-none">Pengaturan</span>
            </a>
          
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="settingsDropdown">
              <li>
                <a class="dropdown-item {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.index') }}">
                  Akun
                </a>
              </li>
              <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </li>
          
          @endauth
        </ul>
      </div>
    </div>
  </nav>
  