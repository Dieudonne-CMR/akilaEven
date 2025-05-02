@php
    use App\Models\EventHall;
    use App\Models\Bookings;
   
    
    // Récupérer les 3 salles de fêtes avec le plus grand nombre de réservations
    $popularEventHalls = EventHall::withCount(['bookings' => function($query) {
        $query->whereIn('status', ['completed', 'booked', 'pending']);
    }])
    ->with(['hotel', 'ville'])
    ->orderBy('bookings_count', 'desc')
    ->take(3)
    ->get();
@endphp

<div x-data="eventSpaceComponent()">
  <div class="flex items-center justify-between mb-8">
      <h3 class="pl-4 text-2xl font-bold border-l-4 heading !border-primary">Salles d'évènement</h3>
      <a href="{{ route('site.sallesfetes') }}" class="group flex items-center gap-2 font-medium !text-primary/80 hover:!text-primary">
          Voir toutes les salles <i data-lucide="arrow-right" class="transition-all size-4 group-hover:translate-x-1"></i>
      </a>
  </div>
  <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 justify-items-center">
    <!-- Si aucune salle n'est disponible -->
    @if($popularEventHalls->isEmpty())
      <div class="py-12 text-center col-span-full">
        <p class="text-lg text-muted-foreground">Aucune salle d'événement n'est disponible actuellement.</p>
      </div>
    @else
      <!-- Boucle sur les salles populaires -->
      @foreach($popularEventHalls as $eventHall)
        <x-event-hall.card :eventHall="$eventHall" />
      @endforeach
    @endif
  </div>
</div>

<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('eventSpaceComponent', () => ({
      // Fonctions utilitaires si nécessaires
    }));
  });
</script>