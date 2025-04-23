@extends('site.layouts.app-site2')

@section('content-site')
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

{{-- <style type="text/css">
    [x-cloak] { display: none !important; }
    
    
</style> --}}
<div x-data="{
    showFilters: window.innerWidth >= 1024,
    currentSlide: {},
    initCarousel(id) {
      if (!this.currentSlide[id]) {
        this.currentSlide[id] = 0;
      }
    },
    nextSlide(id, total) {
      this.currentSlide[id] = (this.currentSlide[id] + 1) % total;
    },
    prevSlide(id, total) {
      this.currentSlide[id] = (this.currentSlide[id] - 1 + total) % total;
    },
    resetFilters() {
      this.priceRange = [100, 1000];
      this.capacity = [10, 500];
      this.selectedLocations = [];
    }
  }" 
  x-init="$watch('showFilters', value => {
    if (window.innerWidth < 1024) {
      document.body.style.overflow = value ? 'hidden' : '';
    }
  })"
  class="flex flex-col min-h-screen">
    
    <!-- Banner Section with Background Image -->
    <div class="relative overflow-hidden text-white">
      <div class="absolute inset-0 z-0">
        <img src="{{ asset('assets_site/images_site/event_halls/event-halls-4.jpg') }}"
             alt="Salle de fête" 
             class="object-cover w-full h-full opacity-30">
      </div>
      <div class="absolute inset-0 opacity-70 bg-gradient-to-l  from-[hsl(24.6,95%,53.1%)]"></div>
      <div class="container relative z-10 px-4 py-16 mx-auto md:py-24">
        <div class="max-w-3xl">
        
          <div class="inline-flex transition-colors border border-accent bg-white px-3 py-0.5 gap-2">
            <h1 class="mb-4 text-3xl font-bold leading-[49px] md:text-5xl text-primary">Trouvez la Salle Parfaite pour votre évènement</h1>
          </div>
         
           {{--  <p class="max-w-2xl text-lg text-white md:text-xl opacity-90">Découvrez notre sélection exclusive de salles de fête pour tous vos événements spéciaux. Des espaces élégants pour des moments inoubliables.</p> --}}
          
         
          <div class="flex flex-wrap gap-3 mt-8">
            <div class="flex items-center px-4 py-2 rounded-full bg-white/50 backdrop-blur-sm">
              <i class="mr-2 text-blue-800 ri-map-pin-line"></i>
              <span class="font-normal text-muted-foreground">Plus de 500 salles disponibles</span>
            </div>
            <div class="flex items-center px-4 py-2 rounded-full bg-white/50 backdrop-blur-sm">
              <i class="mr-2 text-yellow-500 ri-star-line"></i>
              <span class="font-normal text-muted-foreground"> Notées par nos clients</span> 
            </div>
            <div class="flex items-center px-4 py-2 rounded-full bg-white/50 backdrop-blur-sm">
              <i class="mr-2 text-green-500 ri-shield-check-line"></i>
              <span class="font-normal text-muted-foreground">Réservation sécurisée</span>
            </div>
          </div>
        </div>
      </div>
   
    </div>
    <div class="container flex justify-center py-16">
      <p class="max-w-2xl text-lg text-primary md:text-xl opacity-90">Découvrez notre sélection exclusive de salles de fête pour tous vos événements spéciaux. Des espaces élégants pour des moments inoubliables.</p>
    </div>
    <!-- Main Content -->
    <div class="container relative flex flex-col flex-grow gap-8 px-4 py-8 mx-auto lg:flex-row">
      
      <!-- Main Listing Section -->
      <div class="order-2 w-full lg:w-2/3 lg:order-1">      
        @include('site.bl-eventHall.partials.search')
        
        <!-- Venue Cards -->
     {{--    <div class="grid grid-cols-1 gap-6 md:grid-cols-2"> --}}
     @include("site.bl-eventHall.partials.event-hall-listing2")
          
       
          
    
        {{--   <!-- Venue Card 6 -->
          <div class="overflow-hidden transition-all duration-300 bg-white shadow-md rounded-xl hover:shadow-lg" 
               x-init="initCarousel('venue6')">
            <!-- Image Carousel -->
            <div class="relative h-48 overflow-hidden">
              <div class="absolute inset-0 flex transition-transform duration-500 ease-in-out"
                   :style="`transform: translateX(-${currentSlide.venue6 * 100}%)`">
                <img src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                     class="flex-shrink-0 object-cover w-full h-48" alt="Salle de fête">
                <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                     class="flex-shrink-0 object-cover w-full h-48" alt="Salle de fête">
                <img src="https://images.unsplash.com/photo-1527529482837-4698179dc6ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                     class="flex-shrink-0 object-cover w-full h-48" alt="Salle de fête">
              </div>
              <!-- Carousel Controls -->
              <button @click="prevSlide('venue6', 3)" class="absolute p-1 text-white transition-colors transform -translate-y-1/2 rounded-full left-2 top-1/2 bg-black/50 hover:bg-black/70">
                <i class="text-xl ri-arrow-left-s-line"></i>
              </button>
              <button @click="nextSlide('venue6', 3)" class="absolute p-1 text-white transition-colors transform -translate-y-1/2 rounded-full right-2 top-1/2 bg-black/50 hover:bg-black/70">
                <i class="text-xl ri-arrow-right-s-line"></i>
              </button>
              <!-- Carousel Indicators -->
              <div class="absolute left-0 right-0 flex justify-center gap-1 bottom-2">
                <template x-for="(_, index) in [0, 1, 2]" :key="index">
                  <button @click="currentSlide.venue6 = index" 
                          :class="{'bg-white': currentSlide.venue6 === index, 'bg-white/50': currentSlide.venue6 !== index}"
                          class="w-2 h-2 transition-colors rounded-full"></button>
                </template>
              </div>
            </div>
            
            <!-- Venue Info -->
            <div class="p-4">
              <div class="flex items-start justify-between mb-2">
                <div>
                  <h3 class="text-lg font-bold">La Terrasse Panoramique</h3>
                  <p class="text-sm text-muted-foreground">Hôtel Altitude</p>
                </div>
                <div class="text-right">
                  <p class="font-bold text-primary-600">580€<span class="text-sm font-normal text-muted-foreground">/jour</span></p>
                </div>
              </div>
              
              <div class="flex flex-wrap gap-3 mb-4">
                <div class="flex items-center text-sm text-muted-foreground">
                  <i class="mr-1 ri-map-pin-line text-primary-500"></i>
                  <span>Chamonix, Mont-Blanc</span>
                </div>
                <div class="flex items-center text-sm text-muted-foreground">
                  <i class="mr-1 ri-user-line text-primary-500"></i>
                  <span>Jusqu'à 100 pers.</span>
                </div>
                <div class="flex items-center text-sm text-muted-foreground">
                  <i class="mr-1 ri-star-line text-primary-500"></i>
                  <span>4.7 (78 avis)</span>
                </div>
              </div>
              
              <button class="w-full py-2 text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary">
                Voir les détails
              </button>
            </div>
          </div> --}}
        </div>
        
        <!-- Pagination -->
       {{--  <div class="flex justify-center mt-8">
          <nav class="flex items-center gap-1">
            <button class="flex items-center justify-center w-10 h-10 bg-white border border-gray-300 rounded-md text-muted-foreground hover:bg-gray-50">
              <i class="ri-arrow-left-s-line"></i>
            </button>
            <button class="flex items-center justify-center w-10 h-10 text-white border rounded-md border-primary bg-primary">1</button>
            <button class="flex items-center justify-center w-10 h-10 bg-white border border-gray-300 rounded-md text-muted-foreground hover:bg-gray-50">2</button>
            <button class="flex items-center justify-center w-10 h-10 bg-white border border-gray-300 rounded-md text-muted-foreground hover:bg-gray-50">3</button>
            <button class="flex items-center justify-center w-10 h-10 bg-white border border-gray-300 rounded-md text-muted-foreground hover:bg-gray-50">4</button>
            <button class="flex items-center justify-center w-10 h-10 bg-white border border-gray-300 rounded-md text-muted-foreground hover:bg-gray-50">5</button>
            <button class="flex items-center justify-center w-10 h-10 bg-white border border-gray-300 rounded-md text-muted-foreground hover:bg-gray-50">
              <i class="ri-arrow-right-s-line"></i>
            </button>
          </nav>
        </div> --}}
      </div>
      
      <!-- Sidebar Filters -->
      <div class="w-1/3" x-cloak>      

        <!-- 1. MOBILE: overlay + sidebar -->
        <div      
        x-show="showFilters"
        class="fixed inset-0 z-[3000] lg:hidden"
        style="display: none;"
        >
    {{--   <!-- Overlay sombre plein écran -->
    <div
      @click="showFilters = false"
      class="absolute inset-0 z-40 bg-black/50"

     x-transition:enter="transition-opacity ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-50"
    x-transition:leave="transition-opacity ease-in duration-300"
        x-transition:leave-start="opacity-50"
     x-transition:leave-end="-translate-x-full"
    ></div> --}}

    <!-- Sidebar mobile -->
    <x-event-hall.event-hall-filters2 x-bind:show-filters="showFilters" :isDesktop="false" />
  </div>

  <!-- 2. DESKTOP: sidebar toujours visible -->
<x-event-hall.event-hall-filters2 :isDesktop="true" />
</div>

    </div>
  </div>

<!-- JavaScript pour initialiser les composants -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser les sliders jQuery UI
        if ($.fn.slider) {
            $('.range-slider-ui').slider();
        }
        
        // Initialiser les accordéons
        $('.accordion-button').on('click', function() {
            $(this).toggleClass('collapsed');
            const target = $(this).data('bs-target');
            $(target).toggleClass('show');
        });
        
        // Initialiser les contrôles de carousel
        if (typeof owlCarousel !== 'undefined') {
            $('.event-hall-carousel').each(function() {
                const $carousel = $(this);
                const slideCount = $carousel.find('.item').length;
                
                // Ne pas initialiser le carrousel si une seule image
                if (slideCount <= 1) {
                    $carousel.find('.owl-nav').hide();
                    $carousel.find('.owl-dots').hide();
                    return;
                }
                
                $carousel.owlCarousel({
                    items: 1,
                    loop: slideCount > 1,
                    margin: 0,
                    nav: true,
                    dots: true,
                    autoplay: slideCount > 1,
                    autoplayTimeout: 5000,
                    navText: [
                        '<i class="la la-angle-left"></i>',
                        '<i class="la la-angle-right"></i>'
                    ]
                });
            });
        }
    });
</script>
@endpush
@endsection
