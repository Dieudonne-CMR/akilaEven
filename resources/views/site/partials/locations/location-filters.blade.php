@props(['isDesktop' => true])
@php
  use App\Models\Location;
  use App\Models\Ville;
  use Illuminate\Support\Facades\DB;

  // Récupérer les types de locations depuis le modèle
  $allLocationTypes = Location::TYPE_LOCATION;
  $logementTypes = Location::TYPE_LOGEMENT;
  
  // Récupérer toutes les villes liées aux locations
  $villesList = Ville::whereHas('locations')->pluck('nom')->toArray();

  // Villes populaires : top 5 par nombre de locations
  $popularCities = DB::table('locations')
      ->join('villes', 'locations.ville_id', '=', 'villes.id')
      ->select('villes.nom', DB::raw('COUNT(*) as total'))
      ->groupBy('villes.id', 'villes.nom')
      ->orderByDesc('total')
      ->take(5)
      ->toArray();
      
  // Récupérer min et max prix
  $minPrix = Location::min('prix') ?: 0;
  $maxPrix = Location::max('prix') ?: 1000000;
  
  // Récupérer les filtres actuels(de l'url)
  $filters = request()->all();
  
  // Valeurs par défaut ou valeurs des filtres actuels
  $currentMinPrice = $filters['min_prix'] ?? $minPrix;
  $currentMaxPrice = $filters['max_prix'] ?? $maxPrix;
  $currentLocations = isset($filters['locations']) ? explode(',', $filters['locations']) : [];
  $currentTypeLocation = $filters['type_location'] ?? null;
  $currentTypeLogement = $filters['type_logement'] ?? null;
  
  // Calculs pour les sliders
  $priceRange = $currentMaxPrice - $currentMinPrice;
  $priceFactor = max($priceRange / 100, 1);
  $priceMinGap = max(intval($priceRange / 20), 5000);
@endphp

<div class="bg-white rounded-lg shadow-md {{ $isDesktop ? 'p-5 sticky top-4' : 'h-full p-5 z-50 overflow-y-auto' }}"
    x-data="{
      // Initialisation des variables Alpine
      priceRange: [{{ $currentMinPrice }}, {{ $currentMaxPrice }}],
      selectedLocations: {{ json_encode($currentLocations) }},
      selectedTypeLocation: '{{ $currentTypeLocation }}',
      selectedTypeLogement: '{{ $currentTypeLogement }}',
      searchTerm: '',
      showResults: false,
      activeIndex: -1,
      cities: {{ json_encode($villesList) }},
      
      // Filtrer les villes selon le terme de recherche
      filteredCities() {
        if (!this.searchTerm) return [];
        return this.cities.filter(city => 
          city.toLowerCase().includes(this.searchTerm.toLowerCase()) && 
          !this.selectedLocations.includes(city)
        ).slice(0, 5);
      },
      
      // Ajouter une localisation
      addLocation(city) {
        if (this.selectedLocations.length < 3 && !this.selectedLocations.includes(city)) {
          this.selectedLocations.push(city);
          this.searchTerm = '';
          this.showResults = false;
        }
      },
      
      // Supprimer une localisation
      removeLocation(city) {
        this.selectedLocations = this.selectedLocations.filter(loc => loc !== city);
      },
      
      // Gestion des touches clavier pour la recherche de villes
      handleKeydown(event) {
        const results = this.filteredCities();
        if (event.key === 'ArrowDown') {
          event.preventDefault();
          this.activeIndex = Math.min(this.activeIndex + 1, results.length - 1);
        } else if (event.key === 'ArrowUp') {
          event.preventDefault();
          this.activeIndex = Math.max(this.activeIndex - 1, 0);
        } else if (event.key === 'Enter' && this.activeIndex >= 0) {
          event.preventDefault();
          this.addLocation(results[this.activeIndex]);
        } else if (event.key === 'Escape') {
          this.showResults = false;
        }
      },
      
      // Appliquer les filtres en mettant à jour l'URL
      applyFilters() {
        const params = new URLSearchParams(window.location.search);
        
        // Mise à jour des paramètres de prix
        params.set('min_prix', this.priceRange[0]);
        params.set('max_prix', this.priceRange[1]);
        
        // Mise à jour des localisations
        if (this.selectedLocations.length > 0) {
          params.set('locations', this.selectedLocations.join(','));
        } else {
          params.delete('locations');
        }
        
        // Mise à jour du type de location
        if (this.selectedTypeLocation) {
          params.set('type_location', this.selectedTypeLocation);
        } else {
          params.delete('type_location');
        }
        
        // Mise à jour du type de logement
        if (this.selectedTypeLogement) {
          params.set('type_logement', this.selectedTypeLogement);
        } else {
          params.delete('type_logement');
        }
        
        // Navigation vers la nouvelle URL avec les paramètres et scroll doux
        window.location.href = window.location.pathname + '?' + params.toString() + '#listing';
      },
      
      // Réinitialiser tous les filtres
      resetFilters() {
        this.priceRange = [{{ $minPrix }}, {{ $maxPrix }}];
        this.selectedLocations = [];
        this.selectedTypeLocation = '';
        this.selectedTypeLogement = '';
        
        // Redirection vers l'URL sans paramètres et scroll doux
        window.location.href = window.location.pathname + '#listing';
      }
    }"
>
  <!-- En-tête du filtre -->
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold">Filtres</h2>
    @if(!$isDesktop)
      <button @click="showFilters = false" class="lg:hidden">
        <i class="text-xl ri-close-line"></i>
      </button>
    @endif
  </div>

  <!-- Contenu des filtres avec défilement -->
  <div class="overflow-y-auto space-y-6 {{ !$isDesktop ? 'max-h-[calc(100vh-10rem)]' : '' }} scrollbar-hide">
    <!-- Section Prix -->
    <div x-data="{ open: true }" class="pb-4 border-b border-gray-200">
      <button @click="open = !open" class="flex justify-between w-full mb-3">
        <h3 class="font-semibold">Prix</h3>
        <i :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'" class="text-xl"></i>
      </button>
      <div x-show="open" 
           x-transition:enter="transition ease-out duration-200"
           x-transition:enter-start="opacity-0 transform -translate-y-4"
           x-transition:enter-end="opacity-100 transform translate-y-0">
        <div class="flex justify-between mb-2">
          <span x-text="`${priceRange[0]} FCFA`" class="text-sm text-gray-500"></span>
          <span x-text="`${priceRange[1]} FCFA`" class="text-sm text-gray-500"></span>
        </div>
        <div class="relative h-2 mb-6">
          <div class="absolute top-0 left-0 right-0 h-2 bg-gray-200 rounded-full"></div>
          <div class="absolute top-0 h-2 rounded-full bg-primary"
               :style="`left:${(priceRange[0] - {{ $currentMinPrice }}) / {{ $priceFactor }}}%; right:${100 - (priceRange[1] - {{ $currentMinPrice}}) / {{ $priceFactor }}}%`"></div>
          <div class="absolute top-1/2 w-4 h-4 -mt-2 -ml-2 bg-white border-2 rounded-full cursor-pointer border-primary"
               :style="`left: ${(priceRange[0] - {{ $currentMinPrice }}) / {{ $priceFactor }}}%`"></div>
          <div class="absolute top-1/2 w-4 h-4 -mt-2 -ml-2 bg-white border-2 rounded-full cursor-pointer border-primary"
               :style="`left: ${(priceRange[1] - {{ $currentMinPrice }}) / {{ $priceFactor }}}%`"></div>
          <input type="range" min="{{ $currentMinPrice }}" max="{{ $currentMaxPrice }}" step="{{ max(intval($priceRange / 100), 1000) }}"
                 x-model.number="priceRange[0]"
                 @input="priceRange[0] = Math.min(priceRange[0], priceRange[1] - {{ $priceMinGap }})"
                 class="absolute w-full h-2 opacity-0 cursor-pointer">
          <input type="range" min="{{ $currentMinPrice }}" max="{{ $currentMaxPrice }}" step="{{ max(intval($priceRange / 100), 1000) }}"
                 x-model.number="priceRange[1]"
                 @input="priceRange[1] = Math.max(priceRange[1], priceRange[0] + {{ $priceMinGap }})"
                 class="absolute w-full h-2 opacity-0 cursor-pointer">
        </div>
        <div class="flex gap-2">
          <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">F</span>
            <input type="number" min="{{ $currentMinPrice }}" max="{{ $currentMaxPrice - $priceMinGap }}" 
                   step="1000"
                   x-model.number="priceRange[0]"
                   @input="priceRange[0] = Math.min(priceRange[0], priceRange[1] - {{ $priceMinGap }})"
                   class="w-full py-2 pl-8 pr-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
          </div>
          <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">F</span>
            <input type="number" min="{{ $currentMinPrice + $priceMinGap }}" max="{{ $currentMaxPrice }}" 
                   step="1000"
                   x-model.number="priceRange[1]"
                   @input="priceRange[1] = Math.max(priceRange[1], priceRange[0] + {{ $priceMinGap }})"
                   class="w-full py-2 pl-8 pr-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
          </div>
        </div>
      </div>
    </div>

    <!-- Section Type de Location -->
    <div x-data="{ open: true }" class="pb-4 border-b border-gray-200">
      <button @click="open = !open" class="flex justify-between w-full mb-3">
        <h3 class="font-semibold">Type de location</h3>
        <i :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'" class="text-xl"></i>
      </button>
      <div x-show="open" 
           x-transition:enter="transition ease-out duration-200"
           x-transition:enter-start="opacity-0 transform -translate-y-4"
           x-transition:enter-end="opacity-100 transform translate-y-0"
           class="grid grid-cols-2 gap-2">
        <div class="flex items-center">
          <input 
            type="radio" 
            name="type_location" 
            id="type_location_all" 
            value="" 
            x-model="selectedTypeLocation"
            class="w-4 h-4 text-primary border-gray-300 focus:ring-primary"
          >
          <label for="type_location_all" class="ml-2 text-sm text-gray-700">
            Tous
          </label>
        </div>
        @foreach($allLocationTypes as $type)
          <div class="flex items-center">
            <input 
              type="radio" 
              name="type_location" 
              id="type_location_{{ $loop->index }}" 
              value="{{ $type }}" 
              x-model="selectedTypeLocation"
              class="w-4 h-4 text-primary border-gray-300 focus:ring-primary"
            >
            <label for="type_location_{{ $loop->index }}" class="ml-2 text-sm text-gray-700">
              {{ ucfirst($type) }}
            </label>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Section Type de Logement -->
    <div x-data="{ open: true }" class="pb-4 border-b border-gray-200">
      <button @click="open = !open" class="flex justify-between w-full mb-3">
        <h3 class="font-semibold">Type de logement</h3>
        <i :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'" class="text-xl"></i>
      </button>
      <div x-show="open" 
           x-transition:enter="transition ease-out duration-200"
           x-transition:enter-start="opacity-0 transform -translate-y-4"
           x-transition:enter-end="opacity-100 transform translate-y-0"
           class="grid grid-cols-2 gap-2">
        <div class="flex items-center">
          <input 
            type="radio" 
            name="type_logement" 
            id="type_logement_all" 
            value="" 
            x-model="selectedTypeLogement"
            class="w-4 h-4 text-primary border-gray-300 focus:ring-primary"
          >
          <label for="type_logement_all" class="ml-2 text-sm text-gray-700">
            Tous
          </label>
        </div>
        @foreach($logementTypes as $type)
          <div class="flex items-center">
            <input 
              type="radio" 
              name="type_logement" 
              id="type_logement_{{ $loop->index }}" 
              value="{{ $type }}" 
              x-model="selectedTypeLogement"
              class="w-4 h-4 text-primary border-gray-300 focus:ring-primary"
            >
            <label for="type_logement_{{ $loop->index }}" class="ml-2 text-sm text-gray-700">
              {{ ucfirst($type) }}
            </label>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Section Localisation -->
    <div x-data="{ open: true }" class="pb-4 border-b border-gray-200">
      <button @click="open = !open" class="flex justify-between w-full mb-3">
        <h3 class="font-semibold">Localisation</h3>
        <i :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'" class="text-xl"></i>
      </button>
      <div x-show="open" 
           x-transition:enter="transition ease-out duration-200"
           x-transition:enter-start="opacity-0 transform -translate-y-4"
           x-transition:enter-end="opacity-100 transform translate-y-0">
        <!-- Affichage des villes sélectionnées -->
        <div x-show="selectedLocations.length > 0" class="flex flex-wrap mb-3">
          <template x-for="loc in selectedLocations" :key="loc">
            <div class="flex items-center px-2 py-1 mb-2 mr-2 bg-gray-100 rounded-full">
              <span x-text="loc" class="mr-1 text-sm"></span>
              <button @click="removeLocation(loc)" class="text-gray-500 hover:text-gray-700">
                <i class="ri-close-line"></i>
              </button>
            </div>
          </template>
        </div>
        <!-- Champ de recherche pour les villes -->
        <div class="relative mb-3">
          <i data-lucide="search" class="absolute text-gray-400 -translate-y-1/2 left-3 top-1/2 size-4"></i>
          <input type="text"
                 placeholder="Rechercher une ville..."
                 x-model="searchTerm"
                 @focus="showResults = true"
                 @blur="setTimeout(() => showResults = false, 200)"
                 @keydown="handleKeydown($event)"
                 class="w-full py-2 pl-10 pr-4 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
          <div x-show="showResults && filteredCities().length" class="absolute z-10 w-full mt-1 overflow-auto bg-white border rounded-md shadow-lg max-h-40">
            <template x-for="(city, idx) in filteredCities()" :key="city">
              <div
                @mouseenter="activeIndex = idx"
                @click="addLocation(city)"
                :class="{'bg-primary/10': activeIndex === idx}"
                class="px-4 py-2 cursor-pointer hover:bg-gray-100"
                x-text="city"
              ></div>
            </template>
          </div>
        </div>
        <!-- Message de limite atteinte -->
        <p x-show="selectedLocations.length >= 3" class="text-xs text-gray-500">
          Vous avez atteint le nombre maximum de villes (3).
        </p>
      </div>
    </div>
  </div>

  <!-- Actions des filtres -->
  <div class="flex gap-3 pt-4 mt-4 border-t border-gray-200">
    <button @click="resetFilters()" class="flex-1 px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50">
      Réinitialiser
    </button>
    <button @click="applyFilters()" class="flex-1 px-4 py-2 text-white rounded-md bg-primary hover:bg-primary/90">
      Appliquer
    </button>
  </div>
</div>

<!-- Style pour la scrollbar -->
<style>
  .scrollbar-hide::-webkit-scrollbar {
    display: none;
  }
  .scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
  }
</style> 