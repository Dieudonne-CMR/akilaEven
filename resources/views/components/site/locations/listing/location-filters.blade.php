@props(['showFilters' => false, 'isDesktop' => true])
@php
  use App\Models\Location;
  use App\Models\Agence;
  use App\Models\Ville;
  use Illuminate\Support\Facades\DB;

  // Récupérer les agences qui ont des locations
  $agences = Agence::whereHas('locations')->pluck('nom_agence', 'id');
  
  // Récupérer toutes les villes liées aux locations
  $villesList = Ville::whereHas('locations')->pluck('nom')->toArray();

  // Villes populaires : top 5 par nombre de locations
  $popularCities = DB::table('locations')
      ->join('villes', 'locations.ville_id', '=', 'villes.id')
      ->select('villes.nom', DB::raw('COUNT(*) as total'))
      ->groupBy('villes.id', 'villes.nom')
      ->orderByDesc('total')
      ->pluck('villes.nom')
      ->take(5)
      ->toArray();
      
  // Récupérer min et max prix
  $minPrix = Location::min('prix');
  $maxPrix = Location::max('prix');
  
  // Récupérer les types de locations depuis le modèle
  $allLocationTypes = Location::TYPE_LOCATION;
  $logementTypes = Location::TYPE_LOGEMENT;
  
  // Récupérer les types de locations les plus courants dans la BD
  $popularLocationTypes = Location::query()
    ->whereNotNull('type_location')
    ->pluck('type_location')
    ->countBy()
    ->sortDesc()
    ->take(5)
    ->keys()
    ->toArray();

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
  $priceFactor = $priceRange / 100;
  $priceMinGap = max(intval($priceRange / 20), 5000);
@endphp

<!-- Overlay sombre si on est sur mobile et que les filtres sont affichés -->
@if(!$isDesktop && !$showFilters)
  <div
    @click="showFilters = false"
    class="absolute inset-0 z-40 bg-black/50"
    x-transition:enter="transition-opacity ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-50"
    x-transition:leave="transition-opacity ease-in duration-300"
    x-transition:leave-start="opacity-50"
    x-transition:leave-end="-translate-x-full"
  >
  </div>
@endif

<!-- Barre latérale des filtres -->
<aside
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
    locationTypes: {{ json_encode($allLocationTypes) }},
    logementTypes: {{ json_encode($logementTypes) }},
    popularCities: {{ json_encode($popularCities) }},
    popularLocationTypes: {{ json_encode($popularLocationTypes) }},
    
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
      
      // Navigation vers la nouvelle URL avec les paramètres
      const url = window.location.pathname + '?' + params.toString() + '#listing';
      window.location.href = url;
    },
    
    // Réinitialiser tous les filtres
    resetFilters() {
      this.priceRange = [{{ $minPrix }}, {{ $maxPrix }}];
      this.selectedLocations = [];
      this.selectedTypeLocation = '';
      this.selectedTypeLogement = '';
      
      // Redirection vers l'URL sans paramètres
      window.location.href = window.location.pathname + '#listing';
    }
  }"
  x-show="{{ $showFilters }} && {{ !$isDesktop}}"
  {{ $attributes->merge([
    'class' => Arr::toCssClasses([
        "bg-white shadow-md overflow-x-hidden",
        $isDesktop ? "sticky order-2 hidden w-full p-5 rounded-lg lg:block top-4": "relative z-50 flex flex-col w-3/4 h-full max-w-xs p-5",
    ])
  ])}}
  @click.away="showFilters = false"
  @if(!$isDesktop)
    x-transition:enter="transition ease-out duration-300 delay-200 transform"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300 transform"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full delay-0"
  @endif
>
   
  <!-- En-tête de la barre latérale -->
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-bold">Filtres</h2>
    @if(!$isDesktop)
      <button @click="showFilters = false" class="lg:hidden">
        <i class="text-2xl ri-close-line"></i>
      </button>
    @endif
  </div>

  <!-- Contenu des filtres avec défilement -->
  <div class="h-[calc(100vh-2rem)] flex-1 overflow-y-auto overflow-x-hidden scrollbar-hide">
    
    <!-- Section Prix -->
    <div x-data="{ open: true }" class="pb-4 mb-4 border-b border-gray-200">
      <button @click="open = !open" class="flex justify-between w-full">
        <h3 class="font-semibold">Prix</h3>
        <i :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'" class="text-xl"></i>
      </button>
      <div x-show="open" 
           x-transition:enter="transition ease-out duration-200"
           x-transition:enter-start="opacity-0 transform -translate-y-4"
           x-transition:enter-end="opacity-100 transform translate-y-0"
           class="mt-3">
        <div class="flex justify-between mb-2">
          <span x-text="`${priceRange[0]}FCFA`" class="text-sm text-muted-foreground"></span>
          <span x-text="`${priceRange[1]}FCFA`" class="text-sm text-muted-foreground"></span>
        </div>
        <div class="relative h-2 mb-6">
          <div class="range-track"></div>
          <div class="range-track-highlight"
              :style="`left:${(priceRange[0] - {{ $currentMinPrice }}) / {{ $priceFactor }}}%; right:${100 - (priceRange[1] - {{ $currentMinPrice}}) / {{ $priceFactor }}}%`"></div>
          <div class="range-min-handle"
              :style="`left: ${(priceRange[0] - {{ $currentMinPrice }}) / {{ $priceFactor }}}%`"></div>
          <div class="range-max-handle"
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
        <div class="flex justify-between gap-2 mt-4">
          <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-sm text-muted-foreground">F</span>
            <input type="number" min="{{ $currentMinPrice }}" max="{{ $currentMaxPrice - $priceMinGap }}" 
                  step="1000"
                  x-model.number="priceRange[0]"
                  @input="priceRange[0] = Math.min(priceRange[0], priceRange[1] - {{ $priceMinGap }})"
                  class="w-full py-2 pl-8 pr-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
          </div>
          <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-sm text-muted-foreground">F</span>
            <input type="number" min="{{ $currentMinPrice + $priceMinGap }}" max="{{ $currentMaxPrice }}" 
                  step="1000"
                  x-model.number="priceRange[1]"
                  @input="priceRange[1] = Math.max(priceRange[1], priceRange[0] + {{ $priceMinGap }})"
                  class="w-full py-2 pl-8 pr-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
          </div>
        </div>
      </div>
    </div>

    <!-- Section Type de Location -->
    <div x-data="{ open: true }" class="pb-4 mb-4 border-b border-gray-200">
      <button @click="open = !open" class="flex justify-between w-full">
        <h3 class="font-semibold">Type de location</h3>
        <i :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'" class="text-xl"></i>
      </button>
      <div x-show="open" 
           x-transition:enter="transition ease-out duration-200"
           x-transition:enter-start="opacity-0 transform -translate-y-4"
           x-transition:enter-end="opacity-100 transform translate-y-0"
           class="grid grid-cols-2 gap-2 mt-3">
        @foreach($allLocationTypes as $type)
          <div class="flex items-center">
            <input 
              type="radio" 
              name="type_location" 
              id="type_location_{{ $loop->index }}" 
              value="{{ $type }}" 
              x-model="selectedTypeLocation"
              class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500"
            >
            <label for="type_location_{{ $loop->index }}" class="ml-2 mb-0 text-sm text-gray-700">
              {{ ucfirst($type) }}
            </label>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Section Type de Logement -->
    <div x-data="{ open: true }" class="pb-4 mb-4 border-b border-gray-200">
      <button @click="open = !open" class="flex justify-between w-full">
        <h3 class="font-semibold">Type de logement</h3>
        <i :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'" class="text-xl"></i>
      </button>
      <div x-show="open" 
           x-transition:enter="transition ease-out duration-200"
           x-transition:enter-start="opacity-0 transform -translate-y-4"
           x-transition:enter-end="opacity-100 transform translate-y-0"
           class="grid grid-cols-2 gap-2 mt-3">
        @foreach($logementTypes as $type)
          <div class="flex items-center">
            <input 
              type="radio" 
              name="type_logement" 
              id="type_logement_{{ $loop->index }}" 
              value="{{ $type }}" 
              x-model="selectedTypeLogement"
              class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500"
            >
            <label for="type_logement_{{ $loop->index }}" class="ml-2 mb-0 text-sm text-gray-700">
              {{ ucfirst($type) }}
            </label>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Section Localisation -->
    <div x-data="{ open: true }" class="pb-4 mb-4 border-b border-gray-200">
      <button @click="open = !open" class="flex justify-between w-full">
        <h3 class="font-semibold">Localisation</h3>
        <i :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'" class="text-xl"></i>
      </button>
      <div x-show="open" 
           x-transition:enter="transition ease-out duration-200"
           x-transition:enter-start="opacity-0 transform -translate-y-4"
           x-transition:enter-end="opacity-100 transform translate-y-0"
           class="mt-3">
        <!-- Affichage des villes sélectionnées -->
        <div x-show="selectedLocations.length > 0" class="flex flex-wrap mb-3">
          <template x-for="loc in selectedLocations" :key="loc">
            <div class="flex items-center px-2 py-1 mb-2 mr-2 bg-gray-100 rounded-full tag">
              <span x-text="loc" class="mr-1"></span>
              <button @click="removeLocation(loc)">
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
          <div x-show="showResults && filteredCities().length" class="absolute w-full mt-1 overflow-auto bg-white border rounded-md max-h-40">
            <template x-for="(city, idx) in filteredCities()" :key="city">
              <div
                @mouseenter="activeIndex = idx"
                @click="addLocation(city)"
                :class="{'bg-primary/10': activeIndex === idx}"
                class="px-4 py-2 cursor-pointer"
                x-text="city"
              ></div>
            </template>
          </div>
        </div>
        <!-- Message de limite atteinte -->
        <p x-show="selectedLocations.length >= 3" class="text-xs text-muted-foreground">
          Vous avez atteint le nombre maximum de villes (3).
        </p>
        <!-- Villes populaires -->
        <div x-show="selectedLocations.length < 3" class="mt-4">
          <p class="mb-2 text-sm font-medium">Villes populaires:</p>
          <div class="flex flex-wrap gap-2">
            <template x-for="city in popularCities" :key="city">
              <button
                @click="addLocation(city)"
                :disabled="selectedLocations.includes(city)"
                :class="selectedLocations.includes(city) ? 'opacity-50 cursor-not-allowed' : ''"
                class="px-3 py-1 text-sm bg-gray-100 rounded-full hover:bg-gray-200"
              >
                <span x-text="city"></span>
              </button>
            </template>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Actions des filtres -->
  <div class="flex gap-3 pt-4 mt-auto border-t border-gray-200">
    <button @click="resetFilters()" class="flex-1 px-4 py-2 border border-gray-300 rounded-md text-muted-foreground hover:bg-gray-50">
      Réinitialiser
    </button>
    <button @click="applyFilters()" class="flex-1 px-4 py-2 text-white rounded-md bg-primary hover:bg-primary/90">
      Appliquer
    </button>
  </div>

  <!-- Style CSS pour les sliders -->
  <style>
   /*  .range-track {
      @apply absolute top-0 left-0 right-0 h-2 rounded-full bg-gray-200;
    }
    .range-track-highlight {
      @apply absolute top-0 h-2 rounded-full bg-primary;
    }
    .range-min-handle, .range-max-handle {
      @apply absolute top-1/2 w-4 h-4 -mt-2 -ml-2 rounded-full bg-white border-2 border-primary cursor-pointer;
    } */
    .scrollbar-hide::-webkit-scrollbar {
      display: none;
    }
    .scrollbar-hide {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
  </style>
</aside> 