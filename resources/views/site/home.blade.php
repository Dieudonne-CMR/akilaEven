@extends('site.layouts.app-site')
@section('content-site')
<!-- ================================
START HERO-WRAPPER AREA
================================= -->
<section class="hero-wrapper hero-wrapper2">
  <div class="pb-0 hero-box">
    <div id="fullscreen-slide-contain">
      <ul class="slides-container">
        <li><img src="{{asset('assets_site/images_site/event_halls/event-halls-1.jpg')}}" alt="Salle de fêtes" /></li>
        <li><img src="{{asset('assets_site/images_site/event_halls/event-halls-2.jpg')}}" alt="Mariage" /></li>
        <li><img src="{{asset('assets_site/images_site/rooms/rooms-1.jpg')}}" alt="Chambre d'hôtel" /></li>
      </ul>
    </div>
    <!-- End background slider -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="pb-5 hero-content">
            <div class="section-heading">
              <span class="mb-3 badge text-bg-primary fw-500">Réservations Faciles & Rapides</span>
              <h2 class="text-white sec__title text-shadow-lg">
                Trouvez l'espace idéal<br>pour tous vos événements            
              </h2>
              <p class="mt-3 text-white fw-500 fs-5 text-shadow-sm">
                Salles de fêtes, chambres d'hôtel et espaces de réception<br>pour vos mariages, séminaires et célébrations.
          </p>
            </div>
          </div>
          <!-- end hero-content -->
          
          <!-- Tabs Search Container -->
          <div class="p-4 bg-white rounded shadow-lg search-fields-container" x-data="{ activeTab: 'rooms' }">
            <!-- Tabs Navigation -->
            <ul class="mb-3 nav nav-tabs" id="searchTabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link" :class="{'active': activeTab === 'rooms'}" id="rooms-tab" x-on:click="activeTab = 'rooms'" type="button" role="tab" aria-controls="rooms-search" aria-selected="true">
                  <i class="mr-1 la la-bed"></i> Chambres
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" :class="{'active': activeTab === 'events'}" id="events-tab" x-on:click="activeTab = 'events'" type="button" role="tab" aria-controls="events-search" aria-selected="false">
                  <i class="mr-1 la la-glass-cheers"></i> Salles de Fêtes
                </button>
              </li>
            </ul>
            
            <!-- Tabs Content -->
            <div class="tab-content" id="searchTabsContent">
              <!-- Chambres Tab -->
              <div class="tab-pane fade" :class="{'show active': activeTab === 'rooms'}" id="rooms-search" role="tabpanel" aria-labelledby="rooms-tab">
                <!-- Contenu du composant de recherche de chambres à intégrer ici -->
                @include('site.layouts.partials.search-rooms')
              </div>
              
              <!-- Salles de Fêtes Tab -->
              <div class="tab-pane fade" :class="{'show active': activeTab === 'events'}" id="events-search" role="tabpanel" aria-labelledby="events-tab">
                <!-- Contenu du composant de recherche de salles de fêtes à intégrer ici -->
                @include('site.layouts.partials.search-events')
              </div>
            </div>
          </div>
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </div>
</section>
<!-- end hero-wrapper -->
<!-- ================================
END HERO-WRAPPER AREA
================================= -->

<!-- ================================
START INFO AREA
================================= -->
<section
  class="info-area info-bg info-area2 padding-top-80px padding-bottom-45px"
>
  <div class="container">
    <div class="row">
      <div class="col-lg-3 responsive-column">
        <div class="icon-box icon-layout-2 d-flex">
          <div class="flex-shrink-0 info-icon bg-rgb text-color-2">
            <i class="las la-hotel"></i>
          </div>
          <!-- end info-icon-->
          <div class="info-content">
            <h4 class="info__title">Hébergement Premium</h4>
            <p class="info__desc">Chambres élégantes et confortables pour tous vos séjours</p>
          </div>
          <!-- end info-content -->
        </div>
        <!-- end icon-box -->
      </div>
      <!-- end col-lg-3 -->
      <div class="col-lg-3 responsive-column">
        <div class="icon-box icon-layout-2 d-flex">
          <div class="flex-shrink-0 info-icon bg-rgb-2 text-color-3">
            <i class="la la-calendar-check"></i>
          </div>
          <!-- end info-icon-->
          <div class="info-content">
            <h4 class="info__title">Réservation Facile</h4>
            <p class="info__desc">Processus de réservation simple et efficace en quelques clics</p>
          </div>
          <!-- end info-content -->
        </div>
        <!-- end icon-box -->
      </div>
      <!-- end col-lg-3 -->
      <div class="col-lg-3 responsive-column">
        <div class="icon-box icon-layout-2 d-flex">
          <div class="flex-shrink-0 info-icon bg-rgb-3 text-color-4">
            <i class="las la-map-marked-alt"></i>
          </div>
          <!-- end info-icon-->
          <div class="info-content">
            <h4 class="info__title">Emplacements Stratégiques</h4>
            <p class="info__desc">Partout au Cameroun, dans les meilleurs quartiers</p>
          </div>
          <!-- end info-content -->
        </div>
        <!-- end icon-box -->
      </div>
      <!-- end col-lg-3 -->
      <div class="col-lg-3 responsive-column">
        <div class="icon-box icon-layout-2 d-flex">
          <div class="flex-shrink-0 info-icon bg-rgb-4 text-color-5">
            <i class="las la-glass-cheers"></i>
          </div>
          <!-- end info-icon-->
          <div class="info-content">
            <h4 class="info__title">Événements Réussis</h4>
            <p class="info__desc">Des espaces adaptés à tous types de célébrations</p>
          </div>
          <!-- end info-content -->
        </div>
        <!-- end icon-box -->
      </div>
      <!-- end col-lg-3 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end info-area -->
<!-- ================================
END INFO AREA
================================= -->

<!-- ================================
START ABOUT AREA
================================= -->
<section class="overflow-hidden about-area section--padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="about-content pe-5">
          <div class="section-heading">
            <span class="mb-3 text-white badge bg-primary">Votre partenaire événementiel</span>
            <h4 class="pb-2 font-size-16">Bienvenue chez AkilaEven</h4>
            <h2 class="sec__title">Une expérience unique pour vos événements</h2>
            <p class="pt-4 pb-2 sec__desc">
              AkilaEven est votre plateforme de référence pour la réservation de salles de fêtes et chambres 
              d'hôtel au Cameroun. Nous sélectionnons avec soin les meilleurs établissements pour garantir 
              la réussite de tous vos événements et séjours.
            </p>
            <p class="sec__desc">
              Que vous organisiez un mariage, un séminaire d'entreprise ou simplement un séjour 
              d'affaires, nous vous accompagnons de la réservation jusqu'à la fin de votre expérience 
              avec un service client disponible à tout moment.
            </p>
          </div>
          <!-- end section-heading -->
          <div class="pt-4 btn-box">
            <a href="{{ route('site.bl-about.about') }}" class="theme-btn">
              En savoir plus <i class="la la-arrow-right ms-1"></i>
            </a>
          </div>
        </div>
      </div>
      <!-- end col-lg-6 -->
      <div class="col-lg-6">
        <div class="image-box about-img-box">
          <img
            src="{{asset('assets_site/images_site/about-home.png')}}"
            alt="about-img"
            class="rounded shadow img__item img__item-1"
          />
          <img
            src="{{asset('assets_site/images/tripadvisor.png')}}"
            alt="about-img"
            class="img__item img__item-2"
          />
        </div>
      </div>
      <!-- end col-lg-6 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- ================================
END ABOUT AREA
================================= -->

<div class="section-block"></div>

<!-- ================================
START ROOM TYPE AREA
================================= -->
<section class="room-type-area section--padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="text-center section-heading">
          <h2 class="sec__title">Nos espaces à découvrir</h2>
          <p class="mt-3 sec__desc">Découvrez nos différents types d'espaces adaptés à tous vos besoins</p>
        </div>
        <!-- end section-heading -->
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
    <div class="row padding-top-50px">
      <div class="col-lg-6">
        <div class="room-type-content">
          <div class="image-box">
            <a href="#" class="overflow-hidden d-block position-relative">
              <img
                src="{{ asset('assets_site/images_site/rooms/img3.jpg') }}"
                alt="Chambres d'hôtel"
                class="img__item w-100"
                style="height: 350px; object-fit: cover;"
              />
              <div class="room-type-link">
                <div>
                  <h3 class="mb-2 text-white">Chambres d'Hôtel</h3>
                  <p class="mb-0 text-white">Confort et élégance pour votre séjour</p>
                </div>
                <i class="la la-arrow-right ms-2"></i>
              </div>
            </a>
          </div>
        </div>
      </div>
      <!-- end col-lg-6 -->
      <div class="col-lg-6">
        <div class="room-type-content">
          <div class="image-box">
            <a href="{{ route('site.sallesfetes') }}" class="overflow-hidden d-block position-relative">
              <img
                src="{{ asset('assets_site/images_site/event_halls/event-halls-2.jpg') }}"
                alt="Salles de fêtes"
                class="img__item w-100"
                style="height: 350px; object-fit: cover;"
              />
              <div class="room-type-link">
                <div>
                  <h3 class="mb-2 text-white">Salles de Fêtes</h3>
                  <p class="mb-0 text-white">L'endroit idéal pour vos célébrations</p>
                </div>
                <i class="la la-arrow-right ms-2"></i>
              </div>
            </a>
          </div>
        </div>
      </div>
      <!-- end col-lg-6 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- ================================
END ROOM TYPE AREA
================================= -->

<!-- ================================
START HOTEL AREA
================================= -->
<section
  class="overflow-hidden hotel-area section-bg padding-top-100px padding-bottom-200px"
>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="text-center section-heading">
          <h2 class="sec__title line-height-55">
            Popular Hotel Destinations <br />
            You Might Like
          </h2>
        </div>
        <!-- end section-heading -->
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
    <div class="row padding-top-50px">
      <div class="col-lg-12">
        <div class="hotel-card-wrap">
          <div class="hotel-card-carousel-2 carousel-action">
            <div class="card-item">
              <div class="card-img">
                <a href="hotel-single.html" class="d-block">
                  <img src="assets_site/images/img1.jpg" alt="hotel-img" />
                </a>
                <span class="badge">Bestseller</span>
                <span class="badge badge-ribbon">30% off</span>
              </div>
              <div class="card-body">
                <h3 class="card-title">
                  <a href="hotel-single.html"
                    >The Millennium Hilton New York</a
                  >
                </h3>
                <p class="card-meta">124 E Huron St, New york</p>
                <div class="card-rating">
                  <span class="text-white badge">4.4/5</span>
                  <span class="review__text">Average</span>
                  <span class="rating__text">(30 Reviews)</span>
                </div>
                <div
                  class="card-price d-flex align-items-center justify-content-between"
                >
                  <p>
                    <span class="price__num">$90.00</span>
                    <span class="price__num before-price color-text-3"
                      >$120.00</span
                    >
                    <span class="price__text">Per night</span>
                  </p>
                  <a href="hotel-single.html" class="btn-text"
                    >See details<i class="la la-angle-right"></i
                  ></a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
            <div class="card-item">
              <div class="card-img">
                <a href="hotel-single.html" class="d-block">
                  <img src="assets_site/images/img2.jpg" alt="hotel-img" />
                </a>
              </div>
              <div class="card-body">
                <h3 class="card-title">
                  <a href="hotel-single.html"
                    >Best Western Grant Park Hotel</a
                  >
                </h3>
                <p class="card-meta">124 E Huron St, Chicago</p>
                <div class="card-rating">
                  <span class="text-white badge">4.4/5</span>
                  <span class="review__text">Average</span>
                  <span class="rating__text">(30 Reviews)</span>
                </div>
                <div
                  class="card-price d-flex align-items-center justify-content-between"
                >
                  <p>
                    <span class="price__from">From</span>
                    <span class="price__num">$58.00</span>
                    <span class="price__text">Per night</span>
                  </p>
                  <a href="hotel-single.html" class="btn-text"
                    >See details<i class="la la-angle-right"></i
                  ></a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
            <div class="card-item">
              <div class="card-img">
                <a href="hotel-single.html" class="d-block">
                  <img src="assets_site/images/img3.jpg" alt="hotel-img" />
                </a>
                <span class="badge">Featured</span>
                <span class="badge badge-ribbon">20% off</span>
              </div>
              <div class="card-body">
                <h3 class="card-title">
                  <a href="hotel-single.html"
                    >Hyatt Regency Maui Resort & Spa</a
                  >
                </h3>
                <p class="card-meta">200 Nohea Kai Dr, Lahaina, HI</p>
                <div class="card-rating">
                  <span class="text-white badge">4.4/5</span>
                  <span class="review__text">Average</span>
                  <span class="rating__text">(30 Reviews)</span>
                </div>
                <div
                  class="card-price d-flex align-items-center justify-content-between"
                >
                  <p>
                    <span class="price__num">$80.00</span>
                    <span class="price__num before-price color-text-3"
                      >$100.00</span
                    >
                    <span class="price__text">Per night</span>
                  </p>
                  <a href="hotel-single.html" class="btn-text"
                    >See details<i class="la la-angle-right"></i
                  ></a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
            <div class="card-item">
              <div class="card-img">
                <a href="hotel-single.html" class="d-block">
                  <img src="assets_site/images/img4.jpg" alt="hotel-img" />
                </a>
                <span class="badge">Popular</span>
              </div>
              <div class="card-body">
                <h3 class="card-title">
                  <a href="hotel-single.html"
                    >Four Seasons Resort Maui at Wailea</a
                  >
                </h3>
                <p class="card-meta">3900 Wailea Alanui Drive, Kihei, HI</p>
                <div class="card-rating">
                  <span class="text-white badge">4.4/5</span>
                  <span class="review__text">Average</span>
                  <span class="rating__text">(30 Reviews)</span>
                </div>
                <div
                  class="card-price d-flex align-items-center justify-content-between"
                >
                  <p>
                    <span class="price__from">From</span>
                    <span class="price__num">$88.00</span>
                    <span class="price__text">Per night</span>
                  </p>
                  <a href="hotel-single.html" class="btn-text"
                    >See details<i class="la la-angle-right"></i
                  ></a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
            <div class="card-item">
              <div class="card-img">
                <a href="hotel-single.html" class="d-block">
                  <img src="assets_site/images/img5.jpg" alt="hotel-img" />
                </a>
              </div>
              <div class="card-body">
                <h3 class="card-title">
                  <a href="hotel-single.html"
                    >Ibis Styles London Heathrow</a
                  >
                </h3>
                <p class="card-meta">272 Bath Road, Harlington, England</p>
                <div class="card-rating">
                  <span class="text-white badge">4.4/5</span>
                  <span class="review__text">Average</span>
                  <span class="rating__text">(30 Reviews)</span>
                </div>
                <div
                  class="card-price d-flex align-items-center justify-content-between"
                >
                  <p>
                    <span class="price__from">From</span>
                    <span class="price__num">$88.00</span>
                    <span class="price__text">Per night</span>
                  </p>
                  <a href="hotel-single.html" class="btn-text"
                    >See details<i class="la la-angle-right"></i
                  ></a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
            <div class="card-item">
              <div class="card-img">
                <a href="hotel-single.html" class="d-block">
                  <img src="assets_site/images/img6.jpg" alt="hotel-img" />
                </a>
                <span class="badge badge-ribbon">10% off</span>
              </div>
              <div class="card-body">
                <h3 class="card-title">
                  <a href="hotel-single.html"
                    >Hotel Europe Saint Severin Paris</a
                  >
                </h3>
                <p class="card-meta">
                  38-40 Rue Saint Séverin, Paris, Paris
                </p>
                <div class="card-rating">
                  <span class="text-white badge">4.4/5</span>
                  <span class="review__text">Average</span>
                  <span class="rating__text">(30 Reviews)</span>
                </div>
                <div
                  class="card-price d-flex align-items-center justify-content-between"
                >
                  <p>
                    <span class="price__num">$70.00</span>
                    <span class="price__num before-price color-text-3"
                      >$80.00</span
                    >
                    <span class="price__text">Per night</span>
                  </p>
                  <a href="hotel-single.html" class="btn-text"
                    >See details<i class="la la-angle-right"></i
                  ></a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
          </div>
          <!-- end hotel-card-carousel -->
        </div>
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container-fluid -->
</section>
<!-- end hotel-area -->
<!-- ================================
END HOTEL AREA
================================= -->

<!-- ================================
START DISCOUNT AREA
================================= -->
<section class="discount-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="discount-box">
          <div class="discount-img">
            <img src="assets_site/images/discount-hotel-img.jpg" alt="discount img" />
          </div>
          <!-- end discount-img -->
          <div class="discount-content">
            <div class="section-heading">
              <p class="text-white sec__desc">Hot deal, save 50%</p>
              <h2 class="mb-0 text-white sec__title line-height-50">
                Discount 50% for the <br />
                First Booking
              </h2>
            </div>
            <!-- end section-heading -->
            <div class="pt-4 btn-box">
              <a href="#" class="border-0 theme-btn"
                >Learn More <i class="la la-arrow-right ms-1"></i
              ></a>
            </div>
          </div>
          <!-- end discount-content -->
          <div class="company-logo">
            <img src="assets_site/images/logo2.png" alt="" />
            <p class="text-white font-size-14 text-end">*Terms applied</p>
          </div>
          <!-- end company-logo -->
        </div>
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end discount-area -->
<!-- ================================
END DISCOUNT AREA
================================= -->

<!-- ================================
   START TESTIMONIAL AREA
================================= -->
<section class="testimonial-area section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="mb-0 text-center section-heading">
          <h2 class="sec__title line-height-50">
            What Our Customers <br />
            are Saying Us?
          </h2>
        </div>
        <!-- end section-heading -->
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row  -->
    <div class="row padding-top-50px">
      <div class="col-lg-12">
        <div class="testimonial-carousel carousel-action">
          <div class="testimonial-card">
            <div class="testi-desc-box">
              <p class="testi__desc">
                Excepteur sint occaecat cupidatat non proident sunt in culpa
                officia deserunt mollit anim laborum sint occaecat cupidatat
                non proident. Occaecat cupidatat non proident des.
              </p>
            </div>
            <div class="author-content d-flex align-items-center">
              <div class="author-img">
                <img src="assets_site/images/team8.jpg" alt="testimonial image" />
              </div>
              <div class="author-bio">
                <h4 class="author__title">Leroy Bell</h4>
                <span class="author__meta">United States</span>
                <span class="ratings d-flex align-items-center">
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                </span>
              </div>
            </div>
          </div>
          <!-- end testimonial-card -->
          <div class="testimonial-card">
            <div class="testi-desc-box">
              <p class="testi__desc">
                Excepteur sint occaecat cupidatat non proident sunt in culpa
                officia deserunt mollit anim laborum sint occaecat cupidatat
                non proident. Occaecat cupidatat non proident des.
              </p>
            </div>
            <div class="author-content d-flex align-items-center">
              <div class="author-img">
                <img src="assets_site/images/team9.jpg" alt="testimonial image" />
              </div>
              <div class="author-bio">
                <h4 class="author__title">Richard Pam</h4>
                <span class="author__meta">Canada</span>
                <span class="ratings d-flex align-items-center">
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                </span>
              </div>
            </div>
          </div>
          <!-- end testimonial-card -->
          <div class="testimonial-card">
            <div class="testi-desc-box">
              <p class="testi__desc">
                Excepteur sint occaecat cupidatat non proident sunt in culpa
                officia deserunt mollit anim laborum sint occaecat cupidatat
                non proident. Occaecat cupidatat non proident des.
              </p>
            </div>
            <div class="author-content d-flex align-items-center">
              <div class="author-img">
                <img src="assets_site/images/team10.jpg" alt="testimonial image" />
              </div>
              <div class="author-bio">
                <h4 class="author__title">Luke Jacobs</h4>
                <span class="author__meta">Australia</span>
                <span class="ratings d-flex align-items-center">
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                </span>
              </div>
            </div>
          </div>
          <!-- end testimonial-card -->
          <div class="testimonial-card">
            <div class="testi-desc-box">
              <p class="testi__desc">
                Excepteur sint occaecat cupidatat non proident sunt in culpa
                officia deserunt mollit anim laborum sint occaecat cupidatat
                non proident. Occaecat cupidatat non proident des.
              </p>
            </div>
            <div class="author-content d-flex align-items-center">
              <div class="author-img">
                <img src="assets_site/images/team8.jpg" alt="testimonial image" />
              </div>
              <div class="author-bio">
                <h4 class="author__title">Chulbul Panday</h4>
                <span class="author__meta">Italy</span>
                <span class="ratings d-flex align-items-center">
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                </span>
              </div>
            </div>
          </div>
          <!-- end testimonial-card -->
        </div>
        <!-- end testimonial-carousel -->
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end testimonial-area -->
<!-- ================================
   START TESTIMONIAL AREA
================================= -->

<div class="section-block"></div>

<!-- ================================
   START BLOG AREA
================================= -->
<section class="blog-area section--padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="text-center section-heading">
          <h2 class="sec__title">Recent Articles</h2>
        </div>
        <!-- end section-heading -->
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
    <div class="row padding-top-50px">
      <div class="col-lg-4 responsive-column">
        <div class="card-item blog-card">
          <div class="card-img">
            <img src="assets_site/images/img5.jpg" alt="blog-img" />
            <div class="post-format icon-element">
              <i class="la la-photo"></i>
            </div>
            <div class="card-body">
              <div class="post-categories">
                <a href="#" class="badge">Travel</a>
                <a href="#" class="badge">lifestyle</a>
              </div>
              <h3 class="card-title line-height-26">
                <a href="blog-single.html"
                  >Best Scandinavian Accommodation – Treat Yourself</a
                >
              </h3>
              <p class="card-meta">
                <span class="post__date"> 1 January, 2020</span>
                <span class="post-dot"></span>
                <span class="post__time">5 Mins read</span>
              </p>
            </div>
          </div>
          <div
            class="card-footer d-flex align-items-center justify-content-between"
          >
            <div class="author-content d-flex align-items-center">
              <div class="author-img">
                <img src="assets_site/images/small-team1.jpg" alt="testimonial image" />
              </div>
              <div class="author-bio">
                <a href="#" class="author__title">Leroy Bell</a>
              </div>
            </div>
            <div class="post-share">
              <ul>
                <li>
                  <i class="la la-share icon-element"></i>
                  <ul class="post-share-dropdown d-flex align-items-center">
                    <li>
                      <a href="#"><i class="lab la-facebook-f"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="lab la-twitter"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="lab la-instagram"></i></a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- end card-item -->
      </div>
      <!-- end col-lg-4 -->
      <div class="col-lg-4 responsive-column">
        <div class="card-item blog-card">
          <div class="card-img">
            <img src="assets_site/images/img6.jpg" alt="blog-img" />
            <div class="post-format icon-element">
              <i class="la la-play"></i>
            </div>
            <div class="card-body">
              <div class="post-categories">
                <a href="#" class="badge">Video</a>
              </div>
              <h3 class="card-title line-height-26">
                <a href="blog-single.html"
                  >Amazing Places to Stay in Norway</a
                >
              </h3>
              <p class="card-meta">
                <span class="post__date"> 1 February, 2020</span>
                <span class="post-dot"></span>
                <span class="post__time">4 Mins read</span>
              </p>
            </div>
          </div>
          <div
            class="card-footer d-flex align-items-center justify-content-between"
          >
            <div class="author-content d-flex align-items-center">
              <div class="author-img">
                <img src="assets_site/images/small-team2.jpg" alt="testimonial image" />
              </div>
              <div class="author-bio">
                <a href="#" class="author__title">Phillip Hunt</a>
              </div>
            </div>
            <div class="post-share">
              <ul>
                <li>
                  <i class="la la-share icon-element"></i>
                  <ul class="post-share-dropdown d-flex align-items-center">
                    <li>
                      <a href="#"><i class="lab la-facebook-f"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="lab la-twitter"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="lab la-instagram"></i></a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- end card-item -->
      </div>
      <!-- end col-lg-4 -->
      <div class="col-lg-4 responsive-column">
        <div class="card-item blog-card">
          <div class="card-img">
            <img src="assets_site/images/img7.jpg" alt="blog-img" />
            <div class="post-format icon-element">
              <i class="la la-music"></i>
            </div>
            <div class="card-body">
              <div class="post-categories">
                <a href="#" class="badge">audio</a>
              </div>
              <h3 class="card-title line-height-26">
                <a href="blog-single.html"
                  >Feel Like Home on Your Business Trip</a
                >
              </h3>
              <p class="card-meta">
                <span class="post__date"> 1 March, 2020</span>
                <span class="post-dot"></span>
                <span class="post__time">3 Mins read</span>
              </p>
            </div>
          </div>
          <div
            class="card-footer d-flex align-items-center justify-content-between"
          >
            <div class="author-content d-flex align-items-center">
              <div class="author-img">
                <img src="assets_site/images/small-team3.jpg" alt="testimonial image" />
              </div>
              <div class="author-bio">
                <a href="#" class="author__title">Luke Jacobs</a>
              </div>
            </div>
            <div class="post-share">
              <ul>
                <li>
                  <i class="la la-share icon-element"></i>
                  <ul class="post-share-dropdown d-flex align-items-center">
                    <li>
                      <a href="#"><i class="lab la-facebook-f"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="lab la-twitter"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="lab la-instagram"></i></a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- end card-item -->
      </div>
      <!-- end col-lg-4 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end blog-area -->
<!-- ================================
   START BLOG AREA
================================= -->

<!-- ================================
START CTA AREA
================================= -->
<section class="cta-area subscriber-area section-bg-2 padding-top-60px padding-bottom-60px" >
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <div class="section-heading">
          <p class="pb-1 sec__desc text-white-50">Newsletter Sign up</p>
          <h2 class="text-white sec__title font-size-30">
            Subscribe to Get Special Offers
          </h2>
        </div>
        <!-- end section-heading -->
      </div>
      <!-- end col-lg-7 -->
      <div class="col-lg-5">
        <div class="subscriber-box">
          <div class="contact-form-action">
            <form action="#">
              <div class="input-box">
                <label class="text-white label-text"
                  >Enter email address</label
                >
                <div class="mb-0 form-group">
                  <span class="la la-envelope form-icon"></span>
                  <input
                    class="form-control"
                    type="email"
                    name="email"
                    placeholder="Email address"
                  />
                  <button
                    class="theme-btn theme-btn-small submit-btn"
                    type="submit"
                  >
                    Subscribe
                  </button>
                  <span class="pt-1 font-size-14 text-white-50"
                    ><i class="la la-lock me-1"></i>Don't worry your
                    information is safe with us.</span
                  >
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- end section-heading -->
      </div>
      <!-- end col-lg-5 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end cta-area -->
<!-- ================================
END CTA AREA
================================= -->
@endsection

 