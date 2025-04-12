@extends('layouts.app')

@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
                        <h1>Undangan Digital</h1>
                        <p>Selamat datang di undangan digital kami! Jadikan momen spesialmu lebih berkesan dengan undangan yang modern dan praktis. Mari rayakan bersama!</p>
                        <div class="d-flex">
                            <a href="#pilihantema" class="btn-get-started">Lihat Katalog</a>
                            {{-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                                class="glightbox btn-watch-video d-flex align-items-center"><i
                                    class="bi bi-play-circle"></i><span>Watch Video</span></a> --}}
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
                        <img src="{{ asset('assets/img/hero-img.png') }}" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>
        </section><!-- /Hero Section -->

        {{-- <!-- Featured Services Section -->
        <section id="featured-services" class="featured-services section">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-activity icon"></i></div>
                            <h4><a href="" class="stretched-link">Lorem Ipsum</a></h4>
                            <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                        </div>
                    </div><!-- End Service Item -->
                    <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
                            <h4><a href="" class="stretched-link">Sed ut perspici</a></h4>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                        </div>
                    </div><!-- End Service Item -->
                    <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
                            <h4><a href="" class="stretched-link">Magni Dolores</a></h4>
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                        </div>
                    </div><!-- End Service Item -->
                </div>
            </div>
        </section><!-- /Featured Services Section --> --}}

        <section id="fitur" class="about section">
          <!-- Section Title -->
          <div class="container section-title" data-aos="fade-up">
              <span>Fitur Terlengkap<br></span>
              <h2>Fitur Terlengkap</h2>
              <p>Dipercaya lebih dari 4000 pasangan setiap bulannya</p>
          </div><!-- End Section Title -->

          <div class="container">
              <div class="row gy-4">
                  <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                      <img src="{{ asset('assets/img/about.png') }}" class="img-fluid" alt="">
                      <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
                  </div>
                  <div class="col-lg-6 content rounded-5" data-aos="fade-up" data-aos-delay="200">
                      {{-- <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                      <p class="fst-italic">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                          labore et dolore
                          magna aliqua.
                      </p> --}}
                      <ul>
                          <li><i class="bi bi-check2-all"></i> <span>Pengerjaan kurang dari 24 jam</span></li>
                          <li><i class="bi bi-check2-all"></i> <span>Revisi sepuasnya sampai hari - H</span></li>
                          <li><i class="bi bi-check2-all"></i> <span>Nama tamu tak terbatas</span></li>
                          <li><i class="bi bi-check2-all"></i> <span>Bebas request musik</span></li>
                          <li><i class="bi bi-check2-all"></i> <span>Desain premium</span></li>
                          <li><i class="bi bi-check2-all"></i> <span>Kualitas Terbaik !!</span></li>
                      </ul>
                  </div>
              </div>
          </div>
      </section><!-- /Fitur Section -->

        {{-- <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>About Us<br></span>
                <h2>About</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('assets/img/about.png') }}" class="img-fluid" alt="">
                        <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
                    </div>
                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                        <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                        <p class="fst-italic">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore
                            magna aliqua.
                        </p>
                        <ul>
                            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</span></li>
                            <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in voluptate
                                    velit.</span></li>
                            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda
                                    mastiro dolore eu fugiat nulla pariatur.</span></li>
                        </ul>
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                            in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident
                        </p>
                    </div>
                </div>

            </div>

        </section><!-- /About Section --> --}}

        <!-- Stats Section -->
        {{-- <section id="stats" class="stats section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Clients</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Projects</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Hours Of Support</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Workers</p>
                        </div>
                    </div><!-- End Stats Item -->

                </div>

            </div>

        </section><!-- /Stats Section --> --}}

        {{-- <!-- Services Section -->
        <section id="services" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Services</span>
                <h2>Services</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-activity"></i>
                            </div>
                            <a href="service-details.html" class="stretched-link">
                                <h3>Nesciunt Mete</h3>
                            </a>
                            <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure
                                perferendis tempore et consequatur.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-broadcast"></i>
                            </div>
                            <a href="service-details.html" class="stretched-link">
                                <h3>Eosle Commodi</h3>
                            </a>
                            <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic
                                non ut nesciunt dolorem.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-easel"></i>
                            </div>
                            <a href="service-details.html" class="stretched-link">
                                <h3>Ledo Markt</h3>
                            </a>
                            <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas
                                adipisci eos earum corrupti.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-bounding-box-circles"></i>
                            </div>
                            <a href="service-details.html" class="stretched-link">
                                <h3>Asperiores Commodit</h3>
                            </a>
                            <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit
                                provident adipisci neque.</p>
                            <a href="service-details.html" class="stretched-link"></a>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-calendar4-week"></i>
                            </div>
                            <a href="service-details.html" class="stretched-link">
                                <h3>Velit Doloremque</h3>
                            </a>
                            <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi
                                at autem alias eius labore.</p>
                            <a href="service-details.html" class="stretched-link"></a>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-chat-square-text"></i>
                            </div>
                            <a href="service-details.html" class="stretched-link">
                                <h3>Dolori Architecto</h3>
                            </a>
                            <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure.
                                Corrupti recusandae ducimus enim.</p>
                            <a href="service-details.html" class="stretched-link"></a>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section><!-- /Services Section --> --}}

        <!-- Portfolio Section -->
        <section id="pilihantema" class="portfolio section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Pilihan Tema</span>
                <h2>Pilihan Tema</h2>
                <p>Silahkan klik tombol dibawah ini untuk melihat contoh</p>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                      <li data-filter="*" class="filter-active">All</li>
                      <li data-filter=".filter-app">Spesial Foto</li>
                      {{-- <li data-filter=".filter-app">Spesial Tanpa Foto</li> --}}
                      <li data-filter=".filter-product">Minimalist Luxury Foto</li>
                      {{-- <li data-filter=".filter-product">Minimalist Luxury Tanpa Foto</li> --}}
                      <br>
                      <li data-filter=".filter-branding">Premium Vintage Foto</li>
                      {{-- <li data-filter=".filter-branding">Premium Vintage Tanpa Foto</li> --}}
                      <li data-filter=".filter-books">Adat Foto</li>
                      {{-- <li data-filter=".filter-books">Adat Tanpa Foto</li> --}}
                  </ul><!-- End Portfolio Filters -->
                  <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                      <img src="{{ asset('assets/img/portfolio/app-1.jpg') }}" class="img-fluid" alt="">
                      <div class="portfolio-info">
                          <h4>Spesial Foto 1</h4>
                          <p><strike>Rp. 150.000</strike></p>
                          <p><b>Rp. 100.000</b></p>
                          <a href="{{ asset('assets/img/portfolio/app-1.jpg') }}" title="Spesial Foto 1"
                              data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                  class="bi bi-zoom-in"></i></a>
                          {{-- <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                  class="bi bi-link-45deg"></i></a> --}}
                          <a href="order-now.html" title="Pesan Sekarang" class="details-link"><i
                          class="bi bi-cart"></i></a> 
                      </div>
                    </div><!-- End Portfolio Item -->
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                          <img src="{{ asset('assets/img/portfolio/app-2.jpg') }}" class="img-fluid" alt="">
                          <div class="portfolio-info">
                              <h4>Spesial Foto 2</h4>
                              <p><strike>Rp. 150.000</strike></p>
                              <p><b>Rp. 100.000</b></p>
                              <a href="{{ asset('assets/img/portfolio/app-2.jpg') }}" title="Spesial Foto 2"
                                  data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                      class="bi bi-zoom-in"></i></a>
                              {{-- <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                      class="bi bi-link-45deg"></i></a> --}}
                              <a href="order-now.html" title="Pesan Sekarang" class="details-link"><i
                              class="bi bi-cart"></i></a> 
                          </div>
                        </div><!-- End Portfolio Item -->

                      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                        <img src="{{ asset('assets/img/portfolio/app-3.jpg') }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Spesial Foto 3</h4>
                            <p><strike>Rp. 150.000</strike></p>
                            <p><b>Rp. 100.000</b></p>
                            <a href="{{ asset('assets/img/portfolio/app-3.jpg') }}" title="Spesial Foto 3"
                                data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            {{-- <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a> --}}
                            <a href="order-now.html" title="Pesan Sekarang" class="details-link"><i
                              class="bi bi-cart"></i></a>
                        </div>
                      </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                          <img src="{{ asset('assets/img/portfolio/product-1.jpg') }}" class="img-fluid" alt="">
                          <div class="portfolio-info">
                              <h4>Minimalist Luxury Foto 1</h4>
                              <p><strike>Rp. 150.000</strike></p>
                              <p><b>Rp. 100.000</b></p>
                              <a href="{{ asset('assets/img/portfolio/product-1.jpg') }}" title="Minimalist Luxury Foto 1"
                                  data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                      class="bi bi-zoom-in"></i></a>
                              {{-- <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                      class="bi bi-link-45deg"></i></a> --}}
                              <a href="order-now.html" title="Pesan Sekarang" class="details-link"><i
                                      class="bi bi-cart"></i></a>
                          </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                          <img src="{{ asset('assets/img/portfolio/product-2.jpg') }}" class="img-fluid" alt="">
                          <div class="portfolio-info">
                              <h4>Minimalist Luxury Foto 2</h4>
                              <p><strike>Rp. 150.000</strike></p>
                              <p><b>Rp. 100.000</b></p>
                              <a href="{{ asset('assets/img/portfolio/product-2.jpg') }}" title="Minimalist Luxury Foto 2"
                                  data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                      class="bi bi-zoom-in"></i></a>
                              {{-- <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                      class="bi bi-link-45deg"></i></a> --}}
                              <a href="order-now.html" title="Pesan Sekarang" class="details-link"><i
                                      class="bi bi-cart"></i></a>
                          </div>
                        </div><!-- End Portfolio Item -->

                      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                        <img src="{{ asset('assets/img/portfolio/product-3.jpg') }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Minimalist Luxury Foto 3</h4>
                            <p><strike>Rp. 150.000</strike></p>
                            <p><b>Rp. 100.000</b></p>
                            <a href="{{ asset('assets/img/portfolio/product-3.jpg') }}" title="Minimalist Luxury Foto 3"
                                data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            {{-- <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a> --}}
                            <a href="order-now.html" title="Pesan Sekarang" class="details-link"><i
                                    class="bi bi-cart"></i></a>
                        </div>
                      </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                            <img src="{{ asset('assets/img/portfolio/branding-1.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Premium Vintage Foto 1</h4>
                                <p><strike>Rp. 150.000</strike></p>
                                <p><b>Rp. 100.000</b></p>
                                <a href="{{ asset('assets/img/portfolio/branding-1.jpg') }}" title="Premium Vintage Foto 1"
                                    data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                {{-- <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a> --}}
                                <a href="order-now.html" title="Pesan Sekarang" class="details-link"><i
                                        class="bi bi-cart"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                          <img src="{{ asset('assets/img/portfolio/branding-2.jpg') }}" class="img-fluid" alt="">
                          <div class="portfolio-info">
                              <h4>Premium Vintage Foto 2</h4>
                              <p><strike>Rp. 150.000</strike></p>
                              <p><b>Rp. 100.000</b></p>
                              <a href="{{ asset('assets/img/portfolio/branding-2.jpg') }}" title="Premium Vintage Foto 2"
                                  data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                      class="bi bi-zoom-in"></i></a>
                              {{-- <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                      class="bi bi-link-45deg"></i></a> --}}
                              <a href="order-now.html" title="Pesan Sekarang" class="details-link"><i
                                      class="bi bi-cart"></i></a>
                          </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                          <img src="{{ asset('assets/img/portfolio/branding-3.jpg') }}" class="img-fluid" alt="">
                          <div class="portfolio-info">
                              <h4>Premium Vintage Foto 3</h4>
                              <p><strike>Rp. 150.000</strike></p>
                              <p><b>Rp. 100.000</b></p>
                              <a href="{{ asset('assets/img/portfolio/branding-3.jpg') }}" title="Premium Vintage Foto 3"
                                  data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                      class="bi bi-zoom-in"></i></a>
                              {{-- <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                      class="bi bi-link-45deg"></i></a> --}}
                              <a href="order-now.html" title="Pesan Sekarang" class="details-link"><i
                                      class="bi bi-cart"></i></a>
                          </div>
                      </div><!-- End Portfolio Item -->
                      
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
                        <img src="{{ asset('assets/img/portfolio/books-1.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Adat Foto 1</h4>
                                <p><strike>Rp. 150.000</strike></p>
                                <p><b>Rp. 100.000</b></p>
                                <a href="{{ asset('assets/img/portfolio/books-1.jpg') }}" title="Adat Foto 1"
                                    data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                {{-- <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a> --}}
                                <a href="order-now.html" title="Pesan Sekarang" class="details-link"><i
                                        class="bi bi-cart"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
                            <img src="{{ asset('assets/img/portfolio/books-2.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Adat Foto 2</h4>
                                <p><strike>Rp. 150.000</strike></p>
                                <p><b>Rp. 100.000</b></p>
                                <a href="{{ asset('assets/img/portfolio/books-2.jpg') }}" title="Adat Foto 2"
                                    data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                {{-- <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a> --}}
                                <a href="order-now.html" title="Pesan Sekarang" class="details-link"><i
                                        class="bi bi-cart"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
                            <img src="{{ asset('assets/img/portfolio/books-3.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Adat Foto 3</h4>
                                <p><strike>Rp. 150.000</strike></p>
                                <p><b>Rp. 100.000</b></p>
                                <a href="{{ asset('assets/img/portfolio/books-3.jpg') }}" title="Adat Foto 3"
                                    data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                {{-- <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a> --}}
                                <a href="order-now.html" title="Pesan Sekarang" class="details-link"><i
                                        class="bi bi-cart"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                    </div><!-- End Portfolio Container -->

                </div>

            </div>

        </section><!-- /Portfolio Section -->

        <section id="faq" class="about section">

          <!-- Section Title -->
          <div class="container section-title" data-aos="fade-up">
              <span>FAQ<br></span>
              <h2>FAQ</h2>
              <p>Frequently Asked Questions</p>
          </div><!-- End Section Title -->

          <div class="container">

              <div class="row gy-4">
                  <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                      <img src="{{ asset('assets/img/faq.png') }}" class="img-fluid" alt="">
                  </div>
                  <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                      @foreach ($faqs as $faq)
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $faq->id }}">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $faq->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $faq->id }}">
                            {{ $faq->pertanyaan }}
                          </button>
                        </h2>
                        <div id="flush-collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">{!! nl2br(e($faq->jawaban)) !!}</div>
                        </div>
                      </div>
                      @endforeach                    
                    </div>
                  </div>
              </div>
          </div>
        </section><!-- /FAQ Section -->

        <!-- Testimonials Section -->
        <section id="testimoni" class="testimonials section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Testimoni</span>
                <h2>Testimoni</h2>
                <p>Berikut merupakan kumpulan testimoni dari pasangan pengantin : </p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper" data-speed="600" data-delay="5000"
                    data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
                    <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 20
                }
              }
            }
          </script>
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="testimonial-item" "="">
                  <p>
                    <i class=" bi bi-quote quote-icon-left"></i>
                      <span>{{ Str::limit("Undangan digital ini benar-benar mempermudah kami! Desainnya elegan dan mudah disesuaikan dengan tema acara kami. Tamu undangan juga bisa dengan mudah mengaksesnya melalui ponsel, bahkan bisa langsung mengonfirmasi kehadiran mereka. Kami merasa sangat terbantu dan puas dengan layanan ini!", 150) }}</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                      {{-- <img src="{{ asset('assets/img/testimonials/testimonials-1.jpg') }}" class="testimonial-img" alt=""> --}}
                      <h3>Rafi &amp; Yuni</h3>
                      <h4>Pasangan Pengantin</h4>
                  </div> 
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                  <div class="testimonial-item" "="">
                  <p>
                    <i class=" bi bi-quote quote-icon-left"></i>
                      <span>{{ Str::limit("Undangan digital membuat acara kami semakin modern dan ramah lingkungan. Tamu juga bisa dengan mudah berbagi undangan ke teman-teman mereka, tanpa khawatir kehilangan informasi penting.", 150) }}</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                      <h3>Hendra &amp; Tia</h3>
                      <h4>Pasangan Pengantin</h4>
                  </div> 
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      <span>{{ Str::limit("Undangan pernikahan digital ini sangat praktis dan modern! Saya bisa berbagi undangan dengan mudah kepada teman-teman dan keluarga melalui WhatsApp atau email. Desainnya juga sangat elegan dan personal.", 150) }}</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                    {{-- <img src="{{ asset('assets/img/testimonials/testimonials-5.jpg') }}" class="testimonial-img" alt=""> --}}
                    <h3>Arif &amp; Nanda</h3>
                    <h4>Pasangan Pengantin</h4>
                  </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      <span>{{ Str::limit("Saya sangat puas dengan undangan digital yang kami gunakan untuk pernikahan. Proses pengirimannya cepat, dan penerima bisa langsung melihat detail acara tanpa harus khawatir kehilangan undangan fisik.", 150) }}</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                    {{-- <img src="{{ asset('assets/img/testimonials/testimonials-5.jpg') }}" class="testimonial-img" alt=""> --}}
                    <h3>Budi &amp; Ani</h3>
                    <h4>Pasangan Pengantin</h4>
                  </div>
                </div><!-- End testimonial item -->

              </div>
              <div class="swiper-pagination"></div>
            </div>

          </div>

        </section><!-- /Testimonials Section -->

        {{-- <!-- Call To Action Section -->
        <section id="call-to-action" class="call-to-action section accent-background">

          <div class="container">
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
              <div class="col-xl-10">
                <div class="text-center">
                  <h3>Call To Action</h3>
                  <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                  <a class="cta-btn" href="#">Call To Action</a>
                </div>
              </div>
            </div>
          </div>

        </section><!-- /Call To Action Section --> --}}

        {{-- <!-- Team Section -->
        <section id="team" class="team section">

          <!-- Section Title -->
          <div class="container section-title" data-aos="fade-up">
            <span>Section Title</span>
            <h2>Team</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
          </div><!-- End Section Title -->

          <div class="container">

            <div class="row gy-5">

              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="member">
                  <div class="pic"><img src="{{ asset('assets/img/team/team-1.jpg') }}" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>Walter White</h4>
                    <span>Chief Executive Officer</span>
                    <div class="social">
                      <a href=""><i class="bi bi-twitter-x"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                </div>
              </div><!-- End Team Member -->

              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="member">
                  <div class="pic"><img src="{{ asset('assets/img/team/team-2.jpg') }}" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>Sarah Jhonson</h4>
                    <span>Product Manager</span>
                    <div class="social">
                      <a href=""><i class="bi bi-twitter-x"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                </div>
              </div><!-- End Team Member -->

              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="member">
                  <div class="pic"><img src="{{ asset('assets/img/team/team-3.jpg') }}" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>William Anderson</h4>
                    <span>CTO</span>
                    <div class="social">
                      <a href=""><i class="bi bi-twitter-x"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                </div>
              </div><!-- End Team Member -->

            </div>

          </div>

        </section><!-- /Team Section --> --}}

        <!-- Contact Section -->
        <section id="hubungikami" class="contact section">

          <!-- Section Title -->
          <div class="container section-title" data-aos="fade-up">
            <span>Hubungi Kami</span>
            <h2>Hubungi Kami</h2>
            <p>Ingin Tahu Lebih Banyak? Hubungi Kami untuk Informasi Lebih Lanjut!</p>
          </div><!-- End Section Title -->

          <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

              <div class="col-lg-5">

                <div class="info-wrap">
                  <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                    <i class="bi bi-geo-alt flex-shrink-0"></i>
                    <div>
                      <h3>Alamat</h3>
                      <p>Jln. Ligar Utara 2 No. 10, Bandung</p>
                    </div>
                  </div><!-- End Info Item -->

                  <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                    <i class="bi bi-telephone flex-shrink-0"></i>
                    <div>
                      <h3>Hubungi Kami</h3>
                      <p>+62 857 9585 1996</p>
                    </div>
                  </div><!-- End Info Item -->

                  <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                    <i class="bi bi-envelope flex-shrink-0"></i>
                    <div>
                      <h3>Email Kami</h3>
                      <p>mrafi.sfauzi@gmail.com</p>
                    </div>
                  </div><!-- End Info Item -->

                  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d247.5693076241029!2d107.63774150147118!3d-6.877551955605405!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1740207894718!5m2!1sen!2sid" frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
              </div>

              <div class="col-lg-7">
                <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                  <div class="row gy-4">

                    <div class="col-md-6">
                      <label for="name-field" class="pb-2">Nama Lengkap</label>
                      <input type="text" name="name" id="name-field" class="form-control" required="">
                    </div>

                    <div class="col-md-6">
                      <label for="email-field" class="pb-2">E-mail Anda</label>
                      <input type="email" class="form-control" name="email" id="email-field" required="">
                    </div>

                    <div class="col-md-12">
                      <label for="subject-field" class="pb-2">Subject</label>
                      <input type="text" class="form-control" name="subject" id="subject-field" required="">
                    </div>

                    <div class="col-md-12">
                      <label for="message-field" class="pb-2">Pesan</label>
                      <textarea class="form-control" name="message" rows="10" id="message-field" required=""></textarea>
                    </div>

                    <div class="col-md-12 text-center">
                      <div class="loading">Memuat</div>
                      <div class="error-message"></div>
                      <div class="sent-message">Pesan Anda sudah terkirim. Terima Kasih!</div>

                      <button type="submit">Kirim Pesan</button>
                    </div>

                  </div>
                </form>
              </div><!-- End Contact Form -->

            </div>

          </div>

        </section><!-- /Contact Section -->

      </main>
@endsection