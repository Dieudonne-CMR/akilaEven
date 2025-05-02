@extends('site.layouts.app-site2')
@section('content-site')
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

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
    @include("site.bl-eventHall.partials.banner")
    <!-- Main Content -->
    <div class="relative flex flex-col flex-grow max-w-full gap-8 px-4 py-8 sm:px-6 lg:px-8 lg:flex-row">
      
      <!-- Main Listing Section -->
      <div class="order-2 w-full lg:w-2/3 lg:order-1"> 

        @include('site.bl-eventHall.partials.search')
        
        <!-- Listing events Halls-->     
        @include("site.bl-eventHall.partials.event-hall-listing2")  
        <!-- Pagination -->
        {!! $eventHalls->links('vendor.pagination.custom') !!}        
          
      </div>        
      <!-- Sidebar Filters -->
      <div class="w-1/3" x-cloak>      

        <!-- 1. MOBILE: overlay + sidebar -->
        <div      
        x-show="showFilters"
        class="fixed inset-0 z-[3000] lg:hidden"
        style="display: none;"
        >

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
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser les sliders jQuery UI
        if ($.fn.slider) {
            $('.range-slider-ui').slider();
        }
        
     
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
</script> --}}
@endpush
@endsection
