@php
  use App\Models\EventHall;
  use App\Helpers\EventTypeHelper;
  
  $totalEventHalls = EventHall::count();
  
  // Récupérer tous les types d'événements
  $allEventTypes = EventTypeHelper::getEventTypes();
  
  // Filtrer pour exclure 'Autre'
  $filteredEventTypes = array_filter($allEventTypes, function($type) {
    return $type !== 'Autre';
  });
  
  // Limiter à 5 événements
  $displayEventTypes = array_slice($filteredEventTypes, 0, 5);
  
  // Calculer le nombre d'événements restants
  $remainingCount = count($filteredEventTypes) - count($displayEventTypes);
@endphp
<div class="max-w-full px-4 py-8 sm:px-6 lg:px-8">
  <!-- Bannière principale -->
  <div class="relative overflow-hidden shadow-xl rounded-2xl">
    <!-- Image de fond avec overlay -->
    <div class="absolute inset-0">
      <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2074&q=80" 
           alt="Salle de fête élégante" 
           class="object-cover w-full h-full">
      <div class="absolute inset-0 bg-gradient-to-r from-primary/80 to-primary/60"></div>
    </div>
    
    <!-- Contenu de la bannière -->
    <div class="relative flex flex-col items-start px-8 py-16 sm:px-16 sm:py-24 lg:py-32">
      <h1 class="max-w-3xl mb-4 text-4xl font-bold text-white sm:text-5xl lg:text-6xl font-playfair">
        Trouvez la salle de fête parfaite pour votre événement
      </h1>
      <p class="max-w-2xl mb-8 text-lg sm:text-xl text-white/90">
        Des centaines de salles disponibles pour vos mariages, anniversaires, séminaires et autres célébrations.
      </p>

      <!-- Badges de catégories -->
      <div class="flex flex-wrap gap-2 mt-8">
        @foreach($displayEventTypes as $key => $type)
          <span class="px-4 py-2 text-sm font-medium text-white transition rounded-full cursor-pointer bg-white/20 backdrop-blur-sm hover:bg-white/30">
            {{ $type }}
          </span>
        @endforeach
        
        @if($remainingCount > 0)
          <span class="px-4 py-2 text-sm font-medium text-white transition rounded-full cursor-pointer bg-white/20 backdrop-blur-sm hover:bg-white/30">
            + {{ $remainingCount }} autres
          </span>
        @endif
      </div>
    </div>
  </div>
  
  <!-- Statistiques -->
  @include("site.partials.events.stat-cards")
</div>
