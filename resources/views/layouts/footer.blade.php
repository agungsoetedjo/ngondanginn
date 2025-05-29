{{-- <footer id="footer" class="fixed-bottom bg-light">
  <div class="container copyright text-center my-2">
    <p>© <span>Copyright</span> <strong class="px-1 sitename">Ngondang-In</strong> <span>All Rights Reserved</span></p>
    <div>
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> 
      Distributed by <a href="https://themewagon.com">ThemeWagon</a>
    </div>
  </div>
</footer> --}}

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>


<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var grid = document.querySelector('.isotope-container');
    if (!grid) return;

    var iso = new Isotope(grid, {
      itemSelector: '.isotope-item',
      layoutMode: 'masonry'
    });

    var filters = document.querySelectorAll('.portfolio-filters li');
    filters.forEach(function (btn) {
      btn.addEventListener('click', function () {
        document.querySelector('.portfolio-filters .filter-active')?.classList.remove('filter-active');
        this.classList.add('filter-active');
        var filterValue = this.getAttribute('data-filter');
        iso.arrange({ filter: filterValue });
      });
    });
  });
</script>
</body>
</html>