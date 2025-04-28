@include('backend.layouts_be.header')
<div class="layout-wrapper layout-content-navbar"> <!-- Layout wrapper -->
    <div class="layout-container"> <!-- Layout container -->
    @include('backend.layouts_be.sidebar')
        <div class="layout-page"> <!-- Layout page -->
        @include('backend.layouts_be.navbar')
            <div class="content-wrapper"> <!-- Content wrapper -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    @yield('content')
                </div>
                <div class="content-backdrop fade"></div>
            </div> <!-- / Content wrapper -->
        </div> <!-- / Layout page -->
    </div> <!-- / Layout container -->
<div class="layout-overlay layout-menu-toggle"></div> <!-- Overlay -->
</div> <!-- / Layout wrapper -->
@include('backend.layouts_be.footer') <!-- Footer -->