<!-- Formulaire de recherche pour les salles de fêtes -->
<?php
// Récupération des villes qui ont des salles de fêtes
$villes = App\Models\Ville::whereHas('eventHalls')->pluck('nom');

// Récupération des types d'événements
$eventTypes = App\Helpers\EventTypeHelper::getEventTypes();
?>

<form action="{{ route('site.sallesfetes') }}" method="GET">
  <div class="grid gap-8 text-muted-foreground grid-cols-[repeat(auto-fit,minmax(100px,1fr))]">
    <!-- Champ Ville/Localisation -->
    <div class="w-full">
      <label for="locations" class="sr-only">Ville</label>
      <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <i data-lucide="map-pin" class="w-5 h-5 text-muted-foreground"></i>
        </div>
        <input 
          id="locations" 
          list="venues-locations" 
          name="locations" 
          placeholder="Destination" 
          class="block w-full py-3 pl-10 pr-3 leading-5 bg-gray-100 border border-transparent rounded-md placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white">
        <datalist id="venues-locations" class="bg-white border rounded-lg shadow-lg">
          @foreach($villes as $ville)
            <option value="{{ $ville }}">{{ $ville }}</option>
          @endforeach
        </datalist>
      </div>
    </div>
    
    <!-- Type d'événement -->
    <div class="w-full">
      <label for="event_types" class="sr-only">Type d'événement</label>
      <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <i data-lucide="calendar" class="w-5 h-5 text-muted-foreground"></i>
        </div>
        <select 
          id="event_types" 
          name="event_types" 
          class="block w-full py-3 pl-10 pr-3 leading-5 bg-gray-100 border border-transparent rounded-md placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white">
          <option value="">Type d'événement</option>
          @foreach($eventTypes as $key => $type)
            <option value="{{ $type }}">{{ $type }}</option>
          @endforeach
        </select>
      </div>
    </div>
    
    <!-- Capacité (nombre d'invités) -->
    <div class="w-full">
      <label for="min_capacite" class="sr-only">Capacité minimum</label>
      <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <i data-lucide="users" class="w-5 h-5 text-muted-foreground"></i>
        </div>
        <input 
          id="min_capacite" 
          name="min_capacite" 
          
          min="1"
          placeholder="Nombre minimum d'invités" 
          class="block w-full py-3 pl-10 pr-3 leading-5 bg-gray-100 border border-transparent rounded-md placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white">
      </div>
    </div>
    
    <!-- Bouton de recherche -->
    <button type="submit" class="shrink-0 w-full px-6 py-3 font-medium text-white transition duration-150 ease-in-out rounded-md bg-primary/80 sm:w-auto hover:bg-primary">
      Rechercher
    </button>
  </div>
</form>

<style>
/* Style pour les datalists */
datalist {
  position: absolute;
  max-height: 20em;
  border: 0 none;
  overflow-x: hidden;
  overflow-y: auto;
  z-index: 50;
}

datalist option {
  font-size: 0.8em;
  padding: 0.5em;
  background-color: white;
  cursor: pointer;
  color: #444;
  border-bottom: 1px solid #ddd;
  transition: background-color 0.2s ease;
}

datalist option:hover, datalist option:focus {
  background-color: #f2f2f2;
  color: #000;
}
</style> 