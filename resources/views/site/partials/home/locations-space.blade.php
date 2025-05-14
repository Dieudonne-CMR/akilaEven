@php
    use App\Models\Location;
    use App\Models\Bookings;
   
    // Récupérer les 3 locations avec le plus grand nombre de réservations
    $popularLocations = Location::withCount(['bookings' => function($query) {
        $query->whereIn('status', ['completed', 'booked', 'pending']);
    }])
    ->with(['agence', 'ville'])
    ->orderBy('bookings_count', 'desc')
    ->take(3)
    ->get();
@endphp

<div x-data="locationsComponent()">
  <div class="flex items-center justify-between mb-8">
      <h3 class="pl-4 text-2xl font-bold border-l-4 heading !border-primary">Locations</h3>
      <a href="{{ route('site.locations') }}" class="group flex items-center gap-2 font-medium !text-primary/80 hover:!text-primary">
          Voir toutes les locations <i data-lucide="arrow-right" class="transition-all size-4 group-hover:translate-x-1"></i>
      </a>
  </div>
  <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 justify-items-center">
    <!-- Si aucune location n'est disponible -->
    @if($popularLocations->isEmpty())
      <div class="py-12 text-center col-span-full">
        <p class="text-lg text-muted-foreground">Aucune location n'est disponible actuellement.</p>
      </div>
    @else
      <!-- Boucle sur les locations populaires -->
      @foreach($popularLocations as $location)
        <x-location.card :location="$location" />
      @endforeach
    @endif
  </div>
</div>

<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('locationsComponent', () => ({
      // Fonctions utilitaires si nécessaires
    }));
  });
</script> 