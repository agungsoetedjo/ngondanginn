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
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/dashboard"><h5 class="sitename">Ngondang<span class="fw-small bg-primary text-white px-2 rounded-2">in</span></h5></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        @auth
        {{-- Dashboard --}}
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}" href="{{ route('dashboard') }}">
            Dashboard
          </a>
        </li>

        
        {{-- Dropdown Data --}}
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
        @endauth
      </ul>
      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-link nav-link">Logout</button>
            </form>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>