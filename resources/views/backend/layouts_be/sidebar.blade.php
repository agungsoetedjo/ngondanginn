<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a class="navbar-brand" href="/dashboard"><h5 class="sitename">Ngondang<span class="fw-small bg-primary text-white px-2 rounded-2">in</span></h5></a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @auth
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>
        @if (Auth::user()->role_id === 1)
        <li class="menu-item {{ request()->is('weddings') || request()->is('weddings/*') || request()->is('musics') || request()->is('musics/*') || request()->is('designs') || request()->is('designs/*') || request()->is('categories') || request()->is('categories/*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle {{ request()->is('weddings') || request()->is('weddings/*') || request()->is('musics') || request()->is('musics/*') || request()->is('designs') || request()->is('designs/*') || request()->is('categories') || request()->is('categories/*')? 'active' : '' }}">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div>Data</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('weddings') || request()->is('weddings/*') ? 'active open' : '' }}">
                    <a href="{{ route('weddings.index') }}" class="menu-link {{ request()->is('weddings') || request()->is('weddings/*') ? 'active' : '' }}">
                        <div><i class="bx bx-envelope"></i> Undangan</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('musics') || request()->is('musics/*') ? 'active open' : '' }}">
                    <a href="{{ route('musics.index') }}" class="menu-link {{ request()->is('musics') || request()->is('musics/*') ? 'active' : '' }}">
                        <div><i class="bx bx-music"></i> Musik</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('designs') || request()->is('designs/*') ? 'active open' : '' }}">
                    <a href="{{ route('designs.index') }}" class="menu-link {{ request()->is('designs') || request()->is('designs/*') ? 'active' : '' }}">
                        <div><i class="bx bx-image"></i> Daftar Template</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('categories') || request()->is('categories/*') ? 'active' : '' }}">
                    <a href="{{ route('categories.index') }}" class="menu-link">
                        <div><i class="bx bx-category"></i> Daftar Kategori</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ request()->routeIs(['orders.index','orders.show']) ? 'active' : '' }}">
            <a href="{{ route('orders.index') }}" class="menu-link {{ request()->routeIs(['orders.index','orders.show']) ? 'active' : '' }}">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div>Pesanan</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs(['index-archive','show-archive']) ? 'active' : '' }}">
            <a href="{{ route('index-archive') }}" class="menu-link {{ request()->routeIs(['index-archive','show-archive']) ? 'active' : '' }}">
                <i class="menu-icon tf-icons bx bx-archive"></i>
                <div>Arsip</div>
            </a>
        </li>
        @endif
        @if (Auth::user()->role_id === 2)
        <li class="menu-item {{ request()->routeIs(['payments.index', 'payments.show', 'paymentdests.index']) ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div>Pembayaran</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs(['payments.index','payments.show']) ? 'active' : '' }}">
                    <a href="{{ route('payments.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-list-ul"></i>
                        <div>Daftar Pembayaran</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('paymentdests.index') ? 'active' : '' }}">
                    <a href="{{ route('paymentdests.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-credit-card"></i>
                        <div>Rekening Tujuan</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @endauth
        {{-- <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
        </li> --}}
    </ul>
</aside>