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
        <li><img src="{{asset('assets_site/images_site/locations/locations-1.jpg')}}" alt="Location d'agence" /></li>
      </ul>
    </div>
    <!-- End background slider -->
    <div class="container py-5">
      <div class="row">
        <div class="col-lg-12">
          <div class="pb-4 hero-content">
            <div class="section-heading">
              <span class="mb-3 badge text-bg-primary fw-500">Réservations Faciles & Rapides</span>
              <h2 class="text-white sec__title text-shadow-lg">
                Trouvez l'espace parfait<br>pour vivre et célébrer
              </h2>
              <p class="mt-3 text-white fw-500 fs-5 text-shadow-sm">
                <i data-lucide="party-popper" class="inline-block w-6 h-6 mr-1"></i> Salles de fêtes pour vos mariages et cérémonies<br>
                <i data-lucide="home" class="inline-block w-6 h-6 mr-1"></i> Villas, appartements et bureaux pour votre confort
              </p>
            </div>
          </div>
          <!-- end hero-content -->
           <!-- Barre de recherche pour les locations et les salles de fêtes-->
              @include("site.partials.home.search-locations-halls")
    
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
   
  </div>
</section>

<section
  class="info-area info-bg info-area2 padding-top-80px padding-bottom-45px">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 responsive-column">
        <div class="icon-box icon-layout-2 d-flex">
          <div class="flex-shrink-0 info-icon bg-rgb text-color-2">
            <i class="las la-agence"></i>
          </div>
          <!-- end info-icon-->
          <div class="info-content">
            <h4 class="info__title">Hébergement Premium</h4>
            <p class="info__desc">Locations élégantes et confortables pour tous vos séjours</p>
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
@include('site.partials.home.about-home')
<!-- ================================
END ABOUT AREA
================================= -->



<!-- Spaces Showcase Section -->
<section class="px-4 py-16 bg-white md:px-8 lg:px-16">
  <div class="mx-auto max-w-7xl">
      <div class="mb-12 text-center">
          <h2 class="mb-4 text-3xl font-bold !text-primary heading md:text-4xl">Découvrez des espaces</h2>
          <p class="max-w-2xl mx-auto text-lg text-muted-foreground">
            Découvrez une vaste sélection de lieux et d'hébergements soigneusement sélectionnés pour trouver l'hébergement idéal.
          </p>
      </div>

      <!-- Agence Locations Block -->
     {{--  @include("site.bl-home.partials.location-space")
    --}}

      <!-- Event Spaces Block -->
      @include("site.partials.home.event-space")
      
      <!-- Location Spaces Block -->
      @include("site.partials.home.location-space")
  </div>
</section>


<!-- Listing agences -->
{{-- @include('site.partials.home.listing-agence') --}}

  <!-- Swiper -->
{{--   <div class="swiper agence-swiper"   
  data-autoplay="false">
    <div class="px-8 py-8 swiper-wrapper">
        <!-- Agence 1 -->
        <div class="swiper-slide">
            <div class="h-full overflow-hidden bg-white shadow-lg agence-card rounded-xl">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Luxury Agence" class="object-cover w-full h-64">
                    <div class="absolute px-3 py-1 text-sm font-semibold text-gray-800 bg-white rounded-full top-4 right-4">
                        <span class="text-yellow-500">★</span> 4.9
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Grand Plaza Resort</h3>
                        <p class="text-lg font-bold text-blue-600">$299<span class="text-sm text-gray-500">/night</span></p>
                    </div>
                    <p class="mb-4 text-gray-600">Beachfront luxury resort with stunning ocean views and world-class amenities</p>
                    <div class="flex items-center mb-4 text-sm text-gray-500">
                        <i class="mr-2 text-red-500 fas fa-map-marker-alt"></i>
                        <span>Maldives, South Asia</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-2">
                            <span class="px-2 py-1 text-xs text-blue-800 bg-blue-100 rounded-md">Pool</span>
                            <span class="px-2 py-1 text-xs text-green-800 bg-green-100 rounded-md">Spa</span>
                            <span class="px-2 py-1 text-xs text-purple-800 bg-purple-100 rounded-md">Beach</span>
                        </div>
                        <button class="font-medium text-blue-600 hover:text-blue-800">View Details</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Agence 2 -->
        <div class="swiper-slide">
            <div class="h-full overflow-hidden bg-white shadow-lg agence-card rounded-xl">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Urban Agence" class="object-cover w-full h-64">
                    <div class="absolute px-3 py-1 text-sm font-semibold text-gray-800 bg-white rounded-full top-4 right-4">
                        <span class="text-yellow-500">★</span> 4.7
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Skyline Urban Agence</h3>
                        <p class="text-lg font-bold text-blue-600">$189<span class="text-sm text-gray-500">/night</span></p>
                    </div>
                    <p class="mb-4 text-gray-600">Modern downtown agence with panoramic city views and rooftop restaurant</p>
                    <div class="flex items-center mb-4 text-sm text-gray-500">
                        <i class="mr-2 text-red-500 fas fa-map-marker-alt"></i>
                        <span>New York, USA</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-2">
                            <span class="px-2 py-1 text-xs text-blue-800 bg-blue-100 rounded-md">Gym</span>
                            <span class="px-2 py-1 text-xs text-green-800 bg-green-100 rounded-md">Bar</span>
                            <span class="px-2 py-1 text-xs text-purple-800 bg-purple-100 rounded-md">WiFi</span>
                        </div>
                        <button class="font-medium text-blue-600 hover:text-blue-800">View Details</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Agence 3 -->
        <div class="swiper-slide">
            <div class="h-full overflow-hidden bg-white shadow-lg agence-card rounded-xl">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Mountain Retreat" class="object-cover w-full h-64">
                    <div class="absolute px-3 py-1 text-sm font-semibold text-gray-800 bg-white rounded-full top-4 right-4">
                        <span class="text-yellow-500">★</span> 4.8
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Alpine Mountain Lodge</h3>
                        <p class="text-lg font-bold text-blue-600">$249<span class="text-sm text-gray-500">/night</span></p>
                    </div>
                    <p class="mb-4 text-gray-600">Cozy mountain retreat with ski-in/ski-out access and hot springs</p>
                    <div class="flex items-center mb-4 text-sm text-gray-500">
                        <i class="mr-2 text-red-500 fas fa-map-marker-alt"></i>
                        <span>Aspen, Colorado</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-2">
                            <span class="px-2 py-1 text-xs text-blue-800 bg-blue-100 rounded-md">Fireplace</span>
                            <span class="px-2 py-1 text-xs text-green-800 bg-green-100 rounded-md">Spa</span>
                            <span class="px-2 py-1 text-xs text-purple-800 bg-purple-100 rounded-md">Skiing</span>
                        </div>
                        <button class="font-medium text-blue-600 hover:text-blue-800">View Details</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Agence 4 -->
        <div class="swiper-slide">
            <div class="h-full overflow-hidden bg-white shadow-lg agence-card rounded-xl">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Boutique Agence" class="object-cover w-full h-64">
                    <div class="absolute px-3 py-1 text-sm font-semibold text-gray-800 bg-white rounded-full top-4 right-4">
                        <span class="text-yellow-500">★</span> 4.6
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Vineyard Boutique Agence</h3>
                        <p class="text-lg font-bold text-blue-600">$219<span class="text-sm text-gray-500">/night</span></p>
                    </div>
                    <p class="mb-4 text-gray-600">Charming boutique agence surrounded by vineyards with wine tasting tours</p>
                    <div class="flex items-center mb-4 text-sm text-gray-500">
                        <i class="mr-2 text-red-500 fas fa-map-marker-alt"></i>
                        <span>Napa Valley, California</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-2">
                            <span class="px-2 py-1 text-xs text-blue-800 bg-blue-100 rounded-md">Wine</span>
                            <span class="px-2 py-1 text-xs text-green-800 bg-green-100 rounded-md">Restaurant</span>
                            <span class="px-2 py-1 text-xs text-purple-800 bg-purple-100 rounded-md">Tours</span>
                        </div>
                        <button class="font-medium text-blue-600 hover:text-blue-800">View Details</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Agence 5 -->
        <div class="swiper-slide">
            <div class="h-full overflow-hidden bg-white shadow-lg agence-card rounded-xl">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Tropical Resort" class="object-cover w-full h-64">
                    <div class="absolute px-3 py-1 text-sm font-semibold text-gray-800 bg-white rounded-full top-4 right-4">
                        <span class="text-yellow-500">★</span> 4.9
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Tropical Paradise Resort</h3>
                        <p class="text-lg font-bold text-blue-600">$329<span class="text-sm text-gray-500">/night</span></p>
                    </div>
                    <p class="mb-4 text-gray-600">Luxurious tropical resort with private bungalows over crystal clear waters</p>
                    <div class="flex items-center mb-4 text-sm text-gray-500">
                        <i class="mr-2 text-red-500 fas fa-map-marker-alt"></i>
                        <span>Bora Bora, French Polynesia</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-2">
                            <span class="px-2 py-1 text-xs text-blue-800 bg-blue-100 rounded-md">Overwater</span>
                            <span class="px-2 py-1 text-xs text-green-800 bg-green-100 rounded-md">Snorkeling</span>
                            <span class="px-2 py-1 text-xs text-purple-800 bg-purple-100 rounded-md">Spa</span>
                        </div>
                        <button class="font-medium text-blue-600 hover:text-blue-800">View Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add Navigation -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div> --}}

<!-- ================================
   START TESTIMONIAL AREA
================================= -->
{{-- <section class="testimonial-area section-padding">
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
</section> --}}
<!-- end testimonial-area -->
<!-- ================================
   START TESTIMONIAL AREA
================================= -->

<div class="section-block"></div>

<!-- ================================
   START BLOG AREA
================================= -->


 <!-- Call to Action -->
{{-- @include('site.bl-home.partials.cta-home') --}}

@endsection

 