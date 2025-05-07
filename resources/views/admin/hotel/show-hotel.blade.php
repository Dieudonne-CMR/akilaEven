@extends('admin.layouts.layout-admin')
@section('content-admin')

<!-- Toast de notification -->
{{-- @include('components.ui.toast') --}}
<x-admin.dashboard-panel class="">
<div class="">
       <!-- Carousel Section -->
      <div class="relative">
         <x-hotel.carousel :bannieres="[$hotel->bannier1, $hotel->bannier2, $hotel->bannier3]" />
         <x-hotel.profile-overlay :hotel="$hotel" :updateLogoRoute="route('admin.hotels.update-media', $hotel)" />
      </div>
      
      <!-- Dashboard Stats Section -->
      @php
            $stats = App\Helpers\HotelStatsHelper::getHotelStats($hotel);
      @endphp
      
      <div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2 lg:grid-cols-3">
            <x-hotel.stats-card 
               title="Réservations totales" 
               :value="$stats['total_bookings']['value']" 
               :icon="$stats['total_bookings']['icon']" 
               trend="ce mois-ci"
               :trendValue="$stats['total_bookings']['increase']"
            />
            
            <x-hotel.stats-card 
               title="Chambres" 
               :value="$stats['rooms_count']['value']" 
               :icon="$stats['rooms_count']['icon']" 
               iconClass="text-purple-600 dark:text-purple-300" 
               iconBg="bg-purple-100 dark:bg-purple-900" 
               :subtitle="'Taux d\'occupation: ' . $stats['rooms_count']['occupancy_rate'] . '%'"
            />
            
            <x-hotel.stats-card 
               title="Salles de fête" 
               :value="$stats['halls_count']['value']" 
               :icon="$stats['halls_count']['icon']" 
               iconClass="text-orange-600 dark:text-orange-300" 
               iconBg="bg-orange-100 dark:bg-orange-900" 
               :subtitle="'Disponibles: ' . $stats['halls_count']['available']"
            />
            
            <x-hotel.stats-card 
               title="Taux de succès" 
               :value="$stats['success_rate']['value'] . '%'" 
               :icon="$stats['success_rate']['icon']" 
               iconClass="text-green-600 dark:text-green-300" 
               iconBg="bg-green-100 dark:bg-green-900" 
               trend="par rapport au mois dernier"
               :trendValue="$stats['success_rate']['increase']"
            />
            
            <x-hotel.stats-card 
               title="Réservations de chambres" 
               :value="$stats['room_bookings']['value']" 
               :icon="$stats['room_bookings']['icon']" 
               iconClass="text-indigo-600 dark:text-indigo-300" 
               iconBg="bg-indigo-100 dark:bg-indigo-900"
               trend="ce mois-ci"
               :trendValue="$stats['room_bookings']['increase']"
            />
            
            <x-hotel.stats-card 
               title="Réservations de salles" 
               :value="$stats['hall_bookings']['value']" 
               :icon="$stats['hall_bookings']['icon']" 
               iconClass="text-pink-600 dark:text-pink-300" 
               iconBg="bg-pink-100 dark:bg-pink-900"
               trend="ce mois-ci"
               :trendValue="$stats['hall_bookings']['increase']"
            />
   
      </div>    
    <!-- Main Content -->
      <div class="container px-4 mx-auto mt-6">
         <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Main Column -->
            <div class="lg:col-span-2">
                <!-- Hotel Details -->
                <x-hotel.details :hotel="$hotel" />              
                
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <x-hotel.admin-panel :hotel="$hotel" />
            </div>
         </div>
        
        <!-- Tabs pour chambres et salles de fête -->
        <x-hotel.tabs-manager :hotel="$hotel" />
      </div>
</div>
</x-admin.dashboard-panel>

<!-- Modals -->
<x-hotel.media-modal :hotel="$hotel" :updateRoute="route('admin.hotels.update-media', $hotel)" />

@endsection 