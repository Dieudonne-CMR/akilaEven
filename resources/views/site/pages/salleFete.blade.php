@extends('site.layouts.layout-site')
@section('content-site')
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

<div x-data="{
    showFilters: false,
    
    resetFilters() {
      this.priceRange = [100, 1000];
      this.capacity = [10, 500];
      this.selectedLocations = [];
    },
    toggleFilters() {
      this.showFilters = !this.showFilters;
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
    <div class="relative flex flex-col grow max-w-full gap-8 px-4 py-8 sm:px-6 lg:px-8 lg:flex-row">
      
      <!-- Main Listing Section -->
      <div class="order-2 w-full lg:w-2/3 lg:order-1">      
        @include('site.partials.events.search')
        
        <!-- Listing events Halls-->     
        @include("site.partials.events.event-hall-listing2")  
        <!-- Pagination -->
        {!! $eventHalls->links('vendor.pagination.custom') !!}        
          
      </div>        
      
      <!-- Sidebar Filters -->
      <div class="w-full lg:w-1/3">
        <!-- DESKTOP: sidebar toujours visible -->
        <x-site.events.listing.event-hall-filters2 
          :isDesktop="true" 
          class="hidden lg:block" 
        />

        <!-- MOBILE: overlay + sidebar (fixed position) -->
        <div 
          x-show="showFilters" 
          x-cloak
          class="fixed inset-0 z-9999 lg:hidden"
          x-transition:enter="transition-opacity duration-300"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          x-transition:leave="transition-opacity duration-300"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0"
        >
          <!-- Overlay -->
          <div 
            @click="showFilters = false"
            class="absolute inset-0 bg-black/50"
          ></div>
          
          <!-- Sidebar mobile -->
          <x-site.events.listing.event-hall-filters2 
            :isDesktop="false" 
            :showFilters="true"
            class="absolute right-0 h-full"
          />
        </div>
      </div>
    </div>
  </div>
@endsection
