@extends('site.layouts.layout-site')
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
    @include("site.partials.events.banner")
    <!-- Main Content -->
    <div class="relative flex flex-col flex-grow max-w-full gap-8 px-4 py-8 sm:px-6 lg:px-8 lg:flex-row">
      
      <!-- Main Listing Section -->
      <div class="order-2 w-full lg:w-2/3 lg:order-1"> 

        @include('site.partials.events.search')
        
        <!-- Listing events Halls-->     
        @include("site.partials.events.event-hall-listing2")  
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
          <x-site.events.listing.event-hall-filters2 x-bind:show-filters="showFilters" :isDesktop="false" />
        </div>

          <!-- 2. DESKTOP: sidebar toujours visible -->
        <x-site.events.listing.event-hall-filters2 :isDesktop="true" />
      </div>

    </div>
  </div>


@endsection
