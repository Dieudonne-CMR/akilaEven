@extends('site.layouts.app-site')
@section('content-site')
<!-- ================================
START HERO-WRAPPER AREA
================================= -->
<section class="relative w-full h-screen">
    <!-- Swiper Container -->
    <div class="w-full h-full swiper hero-swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{asset('assets_site/images_site/event_halls/event-halls-1.jpg')}}" alt="Salle de fêtes" class="object-cover w-full h-full" />
            </div>
            <div class="swiper-slide">
                <img src="{{asset('assets_site/images_site/event_halls/event-halls-2.jpg')}}" alt="Mariage" class="object-cover w-full h-full" />
            </div>
            <div class="swiper-slide">
                <img src="{{asset('assets_site/images_site/locations/locations-1.jpg')}}" alt="Location d'agence" class="object-cover w-full h-full" />
            </div>
        </div>
    </div>

    <!-- Overlay sombre pour améliorer la lisibilité -->
    <div class="absolute inset-0 z-48 bg-black/60"></div>

    <!-- Contenu Hero -->
    <div class="absolute inset-0 flex items-center z-49">
        <div class="container px-4 mx-auto">
            <div class="max-w-4xl mx-auto text-center">
                <div class="space-y-6">
                    <span class="inline-block px-4 py-2 text-sm font-medium text-white rounded-full bg-primary">
                        Réservations Faciles & Rapides
                    </span>
                    
                    <h2 class="text-4xl font-bold leading-tight text-white md:text-5xl">
                        Trouvez l'espace parfait<br>pour vivre et célébrer
                    </h2>
                    
                    <p class="space-y-2 text-xl text-white">
                        <div class="flex items-center justify-center space-x-2">
                            <i data-lucide="party-popper" class="w-6 h-6 text-yellow-600 animate-pulse" style="filter: drop-shadow(0 0 8px rgba(234, 179, 8, 0.6));"></i>
                            <span class="text-white">Salles de fêtes pour vos mariages et cérémonies</span>
                        </div>
                        <div class="flex items-center justify-center space-x-2">
                            <i data-lucide="home" class="w-6 h-6 text-purple-600 animate-pulse" style="filter: drop-shadow(0 0 8px rgba(147, 51, 234, 0.6));"></i>
                            <span class="text-white">Villas, appartements et bureaux pour votre confort</span>
                        </div>
                    </p>
                </div>

                <!-- Barre de recherche -->
                @include("site.partials.home.search-locations-halls")
            </div>
        </div>
    </div>
</section>

<!-- Section Caractéristiques -->
<section class="py-20 bg-gray-50">
    <div class="container px-4 mx-auto">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
            <!-- Carte Hébergement -->
            <div class="p-6 transition-shadow bg-white rounded-lg shadow-sm hover:shadow-md">
                <div class="flex items-start space-x-4">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <i data-lucide="building" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900">Hébergement Premium</h4>
                        <p class="mt-2 text-gray-600">Locations élégantes et confortables pour tous vos séjours</p>
                    </div>
                </div>
            </div>

            <!-- Carte Réservation -->
            <div class="p-6 transition-shadow bg-white rounded-lg shadow-sm hover:shadow-md">
                <div class="flex items-start space-x-4">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <i data-lucide="calendar-check" class="w-6 h-6 text-green-600"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900">Réservation Facile</h4>
                        <p class="mt-2 text-gray-600">Processus de réservation simple et efficace en quelques clics</p>
                    </div>
                </div>
            </div>

            <!-- Carte Emplacement -->
            <div class="p-6 transition-shadow bg-white rounded-lg shadow-sm hover:shadow-md">
                <div class="flex items-start space-x-4">
                    <div class="p-3 bg-purple-100 rounded-lg">
                        <i data-lucide="map-pin" class="w-6 h-6 text-purple-600"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900">Emplacements Stratégiques</h4>
                        <p class="mt-2 text-gray-600">Partout au Cameroun, dans les meilleurs quartiers</p>
                    </div>
                </div>
            </div>

            <!-- Carte Événements -->
            <div class="p-6 transition-shadow bg-white rounded-lg shadow-sm hover:shadow-md">
                <div class="flex items-start space-x-4">
                    <div class="p-3 bg-red-100 rounded-lg">
                        <i data-lucide="wine" class="w-6 h-6 text-red-600"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900">Événements Réussis</h4>
                        <p class="mt-2 text-gray-600">Des espaces adaptés à tous types de célébrations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.hero-swiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            }
        });
    });
</script>
@endpush

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

 