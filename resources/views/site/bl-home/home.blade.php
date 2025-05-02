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
           <!-- Barre de recherche pour les chambres et les salles de fêtes-->
              @include("site.bl-home.partials.search-rooms-halls")
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
  class="info-area info-bg info-area2 padding-top-80px padding-bottom-45px">
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
@include('site.bl-home.partials.about-home')
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

      <!-- Hotel Rooms Block -->
      <div class="mb-16">
          <div class="flex items-center justify-between mb-8">
              <h3 class="pl-4 text-2xl font-bold border-l-4 heading !border-primary">Chambres d'hôtel</h3>
              <a href="#" class="flex items-center gap-2 font-medium group text-primary/80 hover:text-primary">
                  Voir toutes les chambres <i data-lucide="arrow-right" class="transition-all size-4 group-hover:translate-x-1"></i>
              </a>
          </div>
          <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
              <!-- Room Card 1 -->
              <div class="overflow-hidden transition-all bg-white shadow-lg space-card rounded-xl">
                  <div class="relative">
                      <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                           alt="Deluxe Room" 
                           class="object-cover w-full h-64">
                      <div class="absolute px-3 py-1 text-sm font-semibold text-white rounded-full top-4 right-4 bg-primary">
                           $199/nuit
                      </div>
                    {{--   <div class="absolute flex items-center gap-1 px-3 py-1 text-sm font-semibold rounded-full top-4 left-4 bg-white/90 text-amber-600">
                          <i class="fas fa-star text-amber-500"></i> 4.9 (128)
                      </div> --}}
                  </div>
                  <div class="p-6">
                      <div class="flex items-start justify-between mb-2">
                          <h4 class="text-xl font-bold text-gray-900">Deluxe King Room</h4>
                          <span class="text-sm text-gray-500">Grand Plaza Hotel</span>
                      </div>
                      <p class="mb-4 text-gray-600">Spacious room with king-sized bed and city views</p>
                      <div class="flex flex-wrap gap-2 mb-4">
                          <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-md">40m²</span>
                          <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-md">City View</span>
                          <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-md">King Bed</span>
                          <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-md">Minibar</span>
                      </div>
                      <button class="w-full py-2 text-white transition-all rounded-md bg-amber-600 hover:bg-amber-700">
                          Check Availability
                      </button>
                  </div>
              </div>

              <!-- Room Card 2 -->
              <div class="overflow-hidden transition-all bg-white shadow-lg space-card rounded-xl">
                  <div class="relative">
                      <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                           alt="Suite Room" 
                           class="object-cover w-full h-64">
                      <div class="absolute px-3 py-1 text-sm font-semibold text-white rounded-full top-4 right-4 bg-amber-600">
                          From $299/night
                      </div>
                      <div class="absolute flex items-center gap-1 px-3 py-1 text-sm font-semibold rounded-full top-4 left-4 bg-white/90 text-amber-600">
                          <i class="fas fa-star text-amber-500"></i> 4.8 (96)
                      </div>
                  </div>
                  <div class="p-6">
                      <div class="flex items-start justify-between mb-2">
                          <h4 class="text-xl font-bold text-gray-900">Executive Suite</h4>
                          <span class="text-sm text-gray-500">Skyline Hotel</span>
                      </div>
                      <p class="mb-4 text-gray-600">Luxurious suite with separate living area and premium amenities</p>
                      <div class="flex flex-wrap gap-2 mb-4">
                          <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-md">65m²</span>
                          <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-md">Ocean View</span>
                          <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-md">Living Area</span>
                          <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-md">Jacuzzi</span>
                      </div>
                      <button class="w-full py-2 text-white transition-all rounded-md bg-amber-600 hover:bg-amber-700">
                          Check Availability
                      </button>
                  </div>
              </div>

              <!-- Room Card 3 -->
              <div class="overflow-hidden transition-all bg-white shadow-lg space-card rounded-xl">
                  <div class="relative">
                      <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                           alt="Family Room" 
                           class="object-cover w-full h-64">
                      <div class="absolute px-3 py-1 text-sm font-semibold text-white rounded-full top-4 right-4 bg-amber-600">
                          From $249/night
                      </div>
                      <div class="absolute flex items-center gap-1 px-3 py-1 text-sm font-semibold rounded-full top-4 left-4 bg-white/90 text-amber-600">
                          <i class="fas fa-star text-amber-500"></i> 4.7 (112)
                      </div>
                  </div>
                  <div class="p-6">
                      <div class="flex items-start justify-between mb-2">
                          <h4 class="text-xl font-bold text-gray-900">Family Room</h4>
                          <span class="text-sm text-gray-500">Coastal Resort</span>
                      </div>
                      <p class="mb-4 text-gray-600">Comfortable room designed for families with children</p>
                      <div class="flex flex-wrap gap-2 mb-4">
                          <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-md">55m²</span>
                          <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-md">Garden View</span>
                          <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-md">2 Queen Beds</span>
                          <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-md">Kids Area</span>
                      </div>
                      <button class="w-full py-2 text-white transition-all rounded-md bg-primary hover:bg-primary/80">
                          Check Availability
                      </button>
                  </div>
              </div>
          </div>
      </div>

      <!-- Event Spaces Block -->
      @include("site.bl-home.partials.event-space")
  </div>
</section>


<!-- Listing hotels -->
@include('site.bl-home.partials.listing-hotel')

  <!-- Swiper -->
{{--   <div class="swiper hotel-swiper"   
  data-autoplay="false">
    <div class="px-8 py-8 swiper-wrapper">
        <!-- Hotel 1 -->
        <div class="swiper-slide">
            <div class="h-full overflow-hidden bg-white shadow-lg hotel-card rounded-xl">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Luxury Hotel" class="object-cover w-full h-64">
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
        
        <!-- Hotel 2 -->
        <div class="swiper-slide">
            <div class="h-full overflow-hidden bg-white shadow-lg hotel-card rounded-xl">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Urban Hotel" class="object-cover w-full h-64">
                    <div class="absolute px-3 py-1 text-sm font-semibold text-gray-800 bg-white rounded-full top-4 right-4">
                        <span class="text-yellow-500">★</span> 4.7
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Skyline Urban Hotel</h3>
                        <p class="text-lg font-bold text-blue-600">$189<span class="text-sm text-gray-500">/night</span></p>
                    </div>
                    <p class="mb-4 text-gray-600">Modern downtown hotel with panoramic city views and rooftop restaurant</p>
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
        
        <!-- Hotel 3 -->
        <div class="swiper-slide">
            <div class="h-full overflow-hidden bg-white shadow-lg hotel-card rounded-xl">
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
        
        <!-- Hotel 4 -->
        <div class="swiper-slide">
            <div class="h-full overflow-hidden bg-white shadow-lg hotel-card rounded-xl">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Boutique Hotel" class="object-cover w-full h-64">
                    <div class="absolute px-3 py-1 text-sm font-semibold text-gray-800 bg-white rounded-full top-4 right-4">
                        <span class="text-yellow-500">★</span> 4.6
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Vineyard Boutique Hotel</h3>
                        <p class="text-lg font-bold text-blue-600">$219<span class="text-sm text-gray-500">/night</span></p>
                    </div>
                    <p class="mb-4 text-gray-600">Charming boutique hotel surrounded by vineyards with wine tasting tours</p>
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
        
        <!-- Hotel 5 -->
        <div class="swiper-slide">
            <div class="h-full overflow-hidden bg-white shadow-lg hotel-card rounded-xl">
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
@include('site.bl-home.partials.cta-home')

@endsection

 