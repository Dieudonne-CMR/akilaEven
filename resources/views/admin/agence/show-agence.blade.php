@extends('admin.layouts.layout-admin')
@section('content-admin')

<!-- Toast de notification -->
{{-- @include('components.ui.toast') --}}
<x-admin.dashboard-panel class="">
<div class="">
       <!-- Carousel Section -->
      <div class="relative">
         <x-agence.carousel :bannieres="[$agence->bannier1, $agence->bannier2, $agence->bannier3]" />
         <x-agence.profile-overlay :agence="$agence" :updateLogoRoute="route('admin.agences.update-media', $agence)" />
      </div>
      
      <!-- Dashboard Stats Section -->
      @php
            $stats = App\Helpers\AgenceStatsHelper::getAgenceStats($agence);
      @endphp
      
      <div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2 lg:grid-cols-3">
            <x-agence.stats-card 
               title="Réservations totales" 
               :value="$stats['total_bookings']['value']" 
               :icon="$stats['total_bookings']['icon']" 
               trend="ce mois-ci"
               :trendValue="$stats['total_bookings']['increase']"
            />
            
            <x-agence.stats-card 
               title="Locations" 
               :value="$stats['locations_count']['value']" 
               :icon="$stats['locations_count']['icon']" 
               iconClass="text-purple-600 dark:text-purple-300" 
               iconBg="bg-purple-100 dark:bg-purple-900" 
               :subtitle="'Taux d\'occupation: ' . $stats['locations_count']['occupancy_rate'] . '%'"
            />
            
            <x-agence.stats-card 
               title="Salles de fête" 
               :value="$stats['halls_count']['value']" 
               :icon="$stats['halls_count']['icon']" 
               iconClass="text-orange-600 dark:text-orange-300" 
               iconBg="bg-orange-100 dark:bg-orange-900" 
               :subtitle="'Disponibles: ' . $stats['halls_count']['available']"
            />
            
            <x-agence.stats-card 
               title="Taux de succès" 
               :value="$stats['success_rate']['value'] . '%'" 
               :icon="$stats['success_rate']['icon']" 
               iconClass="text-green-600 dark:text-green-300" 
               iconBg="bg-green-100 dark:bg-green-900" 
               trend="par rapport au mois dernier"
               :trendValue="$stats['success_rate']['increase']"
            />
            
            <x-agence.stats-card 
               title="Réservations de locations" 
               :value="$stats['location_bookings']['value']" 
               :icon="$stats['location_bookings']['icon']" 
               iconClass="text-indigo-600 dark:text-indigo-300" 
               iconBg="bg-indigo-100 dark:bg-indigo-900"
               trend="ce mois-ci"
               :trendValue="$stats['location_bookings']['increase']"
            />
            
            <x-agence.stats-card 
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
                <!-- Agence Details -->
                <x-agence.details :agence="$agence" />              
                
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <x-agence.admin-panel :agence="$agence" />
            </div>
         </div>
        
        <!-- Tabs pour locations et salles de fête -->
        <x-agence.tabs-manager :agence="$agence" />
      </div>
</div>
</x-admin.dashboard-panel>

<!-- Modals -->
<x-agence.media-modal :agence="$agence" :updateRoute="route('admin.agences.update-media', $agence)" />

@endsection 