<!-- Formulaire de recherche pour les locations -->
<?php
// Récupération des villes qui ont des locations
$villes = App\Models\Ville::whereHas('locations')->pluck('nom');

// Récupération des types de logement et de location
$typeLogements = App\Models\Location::TYPE_LOGEMENT;
$typeLocations = App\Models\Location::TYPE_LOCATION;
?>

<form action="{{ route('site.locations') }}" method="GET">
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
          list="location-cities" 
          name="locations" 
          placeholder="Où?" 
          class="block w-full py-3 pl-10 pr-3 leading-5 bg-gray-100 border border-transparent rounded-md placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white">
        <datalist id="location-cities" class="bg-white border rounded-lg shadow-lg">
          @foreach($villes as $ville)
            <option value="{{ $ville }}">{{ $ville }}</option>
          @endforeach
        </datalist>
      </div>
    </div>
    
    <!-- Type de logement -->
    <div class="w-full">
      <label for="type_logement" class="sr-only">Type de logement</label>
      <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <i data-lucide="home" class="w-5 h-5 text-muted-foreground"></i>
        </div>
        <select 
          id="type_logement" 
          name="type_logement" 
          class="block w-full py-3 pl-10 pr-3 leading-5 bg-gray-100 border border-transparent rounded-md placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white">
          <option value="">Type de logement</option>
          @foreach($typeLogements as $type)
            <option value="{{ $type }}">{{ ucfirst($type) }}</option>
          @endforeach
        </select>
      </div>
    </div>
    
    <!-- Type de location -->
    <div class="w-full">
      <label for="type_location" class="sr-only">Type de location</label>
      <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <i data-lucide="building" class="w-5 h-5 text-muted-foreground"></i>
        </div>
        <select 
          id="type_location" 
          name="type_location" 
          class="block w-full py-3 pl-10 pr-3 leading-5 bg-gray-100 border border-transparent rounded-md placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white">
          <option value="">Type de location</option>
          @foreach($typeLocations as $type)
            <option value="{{ $type }}">{{ ucfirst($type) }}</option>
          @endforeach
        </select>
      </div>
    </div>
    
    <!-- Bouton de recherche -->
    <button type="submit" class="flex items-center justify-center flex-shrink-0 w-full px-6 py-3 font-medium text-white transition duration-150 ease-in-out rounded-md !bg-primary/80 sm:w-auto hover:bg-primary">
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