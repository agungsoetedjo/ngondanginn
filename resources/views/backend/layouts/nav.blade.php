<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <!-- Dashboard link -->
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a>
        </li>

        <!-- Weddings link -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('weddings.index') }}">Undangan</a>
        </li>
{{-- 
        <!-- RSVP link -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('rsvps.index', ['wedding' => 'slug_wedding']) }}">RSVP</a>
        </li>

        <!-- Guest Book link -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('guestbooks.index', ['wedding' => 'slug_wedding']) }}">Buku Tamu</a>
        </li>

        <!-- Galleries link -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('galleries.index', ['wedding' => 'slug_wedding']) }}">Galeri</a>
        </li> --}}

        <!-- Music link -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('musics.index') }}">Musik</a>
        </li>

        <!-- Logout link -->
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-link nav-link">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End of Navbar -->
