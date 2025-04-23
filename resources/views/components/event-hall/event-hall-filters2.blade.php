@props(['showFilters' => false, 'isDesktop' => true])
@php
  use App\Models\EventHall;
  use App\Models\Hotel;
  use App\Helpers\EventTypeHelper;
  use App\Models\Ville;
  use Illuminate\Support\Facades\DB;

  
  // Récupérer les hotels qui ont des salles de fêtes
  $hotels = Hotel::whereHas('eventHalls')->pluck('nom_hotel', 'id');
  
  // Récupérer toutes les villes liées aux salles de fête(localisations)
  $villesList = Ville::whereHas('eventHalls')->pluck('nom')->toArray();

  // Villes populaires : top 5 par nombre de salles
  $popularCities = DB::table('event_halls')
      ->join('villes', 'event_halls.ville_id', '=', 'villes.id')
      ->select('villes.nom', DB::raw('COUNT(*) as total'))
      ->groupBy('villes.id', 'villes.nom')
      ->orderByDesc('total')
      ->pluck('villes.nom')
      ->take(5)
      ->toArray();
      
  // Récupérer min et max capacité
  $minCapacite = EventHall::min('capacite') ?: 10;
  $maxCapacite = EventHall::max('capacite') ?: 500;
  
  // Récupérer min et max prix
  $minPrix = EventHall::min('prix') ?: 50000;
  $maxPrix = EventHall::max('prix') ?: 1000000;
  
  // Types d'événements
  /* eventTypes = Event */
  /* $eventTypes = EventTypeHelper::getEventTypes(); */
  $eventTypes = EventHall::distinct()->pluck('event_type')->toArray();
  var_dump($eventTypes);
  
  // Récupérer les filtres actuels(de l'url)
  $filters = request()->all();
  /* var_dump($filters); */
  
  // Valeurs par défaut ou valeurs des filtres actuels
  $currentMinPrice = $filters['min_prix'] ?? $minPrix;
  $currentMaxPrice = $filters['max_prix'] ?? $maxPrix;
  $currentMinCapacity = $filters['min_capacite'] ?? $minCapacite;
  $currentMaxCapacity = $filters['max_capacite'] ?? $maxCapacite;
  $currentLocations = isset($filters['locations']) ? explode(',', $filters['locations']) : [];
  $currentEventTypes = isset($filters['event_types']) ? explode(',', $filters['event_types']) : [];
  $range       = ($currentMaxPrice - $currentMinPrice);
  $factor      = $range / 100;         // pourcent par unité
  $gap         = intval($range / 20);  // 5 % de la plage
  $minGap      = min(max(intval($range / 20), 50), $range);        // au moins ton step
  
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
    capacity: [{{ $currentMinCapacity }}, {{ $currentMaxCapacity }}],
    selectedLocations: {{ json_encode($currentLocations) }},
    selectedEventTypes: {{ json_encode($currentEventTypes) }},
    searchTerm: '',
    eventTypeSearchTerm: '',
    showResults: false,
    showEventTypeResults: false,
    activeIndex: -1,
    eventTypeActiveIndex: -1,
    cities: {{ json_encode($villesList) }},
    eventTypes: {{ json_encode($eventTypes) }},
    popularCities: {{ json_encode($popularCities) }},
    
    // Filtrer les villes selon le terme de recherche
    filteredCities() {
      if (!this.searchTerm) return [];
      return this.cities.filter(city => 
        city.toLowerCase().includes(this.searchTerm.toLowerCase()) && 
        !this.selectedLocations.includes(city)
      ).slice(0, 5);
    },
    
    // Filtrer les types d'événements selon le terme de recherche
    filteredEventTypes() {
      if (!this.eventTypeSearchTerm) return [];
      return this.eventTypes.filter(type => 
        type.toLowerCase().includes(this.eventTypeSearchTerm.toLowerCase()) && 
        !this.selectedEventTypes.includes(type)
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
    
    // Ajouter un type d'événement
    addEventType(type) {
      if (this.selectedEventTypes.length < 3 && !this.selectedEventTypes.includes(type)) {
        this.selectedEventTypes.push(type);
        this.eventTypeSearchTerm = '';
        this.showEventTypeResults = false;
      }
    },
    
    // Supprimer un type d'événement
    removeEventType(type) {
      this.selectedEventTypes = this.selectedEventTypes.filter(t => t !== type);
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
    
    // Gestion des touches clavier pour la recherche de types d'événements
    handleEventTypeKeydown(event) {
      const results = this.filteredEventTypes();
      if (event.key === 'ArrowDown') {
        event.preventDefault();
        this.eventTypeActiveIndex = Math.min(this.eventTypeActiveIndex + 1, results.length - 1);
      } else if (event.key === 'ArrowUp') {
        event.preventDefault();
        this.eventTypeActiveIndex = Math.max(this.eventTypeActiveIndex - 1, 0);
      } else if (event.key === 'Enter' && this.eventTypeActiveIndex >= 0) {
        event.preventDefault();
        this.addEventType(results[this.eventTypeActiveIndex]);
      } else if (event.key === 'Escape') {
        this.showEventTypeResults = false;
      }
    },
    
    // Appliquer les filtres en mettant à jour l'URL
    applyFilters() {
      const params = new URLSearchParams(window.location.search);
      
      // Mise à jour des paramètres de prix
      params.set('min_prix', this.priceRange[0]);
      params.set('max_prix', this.priceRange[1]);
      
      // Mise à jour des paramètres de capacité
      params.set('min_capacite', this.capacity[0]);
      params.set('max_capacite', this.capacity[1]);
      
      // Mise à jour des localisations
      if (this.selectedLocations.length > 0) {
        params.set('locations', this.selectedLocations.join(','));
      } else {
        params.delete('locations');
      }
      
      // Mise à jour des types d'événements
      if (this.selectedEventTypes.length > 0) {
        params.set('event_types', this.selectedEventTypes.join(','));
      } else {
        params.delete('event_types');
      }
      
      // Navigation vers la nouvelle URL avec les paramètres
      window.location.href = window.location.pathname + '?' + params.toString();
    },
    
    // Réinitialiser tous les filtres
    resetFilters() {
      this.priceRange = [{{ $minPrix }}, {{ $maxPrix }}];
      this.capacity = [{{ $minCapacite }}, {{ $maxCapacite }}];
      this.selectedLocations = [];
      this.selectedEventTypes = [];
      
      // Redirection vers l'URL sans paramètres
      window.location.href = window.location.pathname;
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
    
    <!-- Section Prix par jour -->
    <div x-data="{ open: true }" class="pb-4 mb-4 border-b border-gray-200">
      <button @click="open = !open" class="flex justify-between w-full">
        <h3 class="font-semibold">Prix par jour</h3>
        <i :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'" class="text-xl"></i>
      </button>
      <div x-show="open" class="mt-3 animate-fade-in">
        <div class="flex justify-between mb-2">
          <span x-text="`${priceRange[0]}€`" class="text-sm text-muted-foreground"></span>
          <span x-text="`${priceRange[1]}€`" class="text-sm text-muted-foreground"></span>
        </div>
        <div class="relative h-2 mb-6">
          <div class="range-track"></div>
          <div class="range-track-highlight"
              :style="`left:${(priceRange[0] - {{ $currentMinPrice }}) / {{ $factor }}}%; right:${100 - (priceRange[1] - {{ $currentMinPrice}}) / {{ $factor }}}%`"></div>
          <div class="range-min-handle"
              :style="`left: ${(priceRange[0] - {{ $currentMinPrice }}) / {{ ($maxPrix - $currentMinPrice) / 100 }}}%`"></div>
          <div class="range-max-handle"
              :style="`left: ${(priceRange[1] - {{ $minPrix }}) / {{ ($currentMaxPrice - $currentMinPrice) / 100 }}}%`"></div>
          <input type="range" min="{{ $currentMinPrice }}" max="{{ $currentMaxPrice }}" step="50"
                x-model.number="priceRange[0]"
                @input="priceRange[0] = Math.min(priceRange[0], priceRange[1] - {{ $minGap }})"
                class="absolute w-full h-2 opacity-0 cursor-pointer">
          <input type="range" min="{{ $currentMinPrice }}" max="{{ $currentMaxPrice }}" step="50"
                x-model.number="priceRange[1]"
                @input="
                console.log(
      '▶ before clamp:',
      'max=', priceRange[1],
      'minPole=', priceRange[0],
      'minGap=', {{ $minGap }}
    );
                priceRange[1] = Math.max(priceRange[1], priceRange[0] + {{ $minGap }});
                console.log('▶ after clamp:', priceRange[1]);
                
                "
                class="absolute w-full h-2 opacity-0 cursor-pointer">
        </div>
        <div class="flex justify-between gap-2 mt-4">
          <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-muted-foreground">€</span>
            <input type="number" min="{{ $currentMinPrice }}" max="{{ $currentMaxPrice - $minGap}}" 
                  step="50"
                  x-model.number="priceRange[0]"
                  @input="priceRange[0] = Math.min(priceRange[0], priceRange[1] - {{ $minGap }})"
                  class="w-full py-2 pl-8 pr-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
          </div>
          <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-muted-foreground">€</span>
            <input type="number" min="{{ $minPrix + $minGap }}" max="{{ $currentMaxPrice }}" 
                  step="50"
                  x-model.number="priceRange[1]"
                  @input="priceRange[1] = Math.max(priceRange[1], priceRange[0] + {{ $minGap }})"
                  class="w-full py-2 pl-8 pr-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
          </div>
        </div>
      </div>
    </div>

    <!-- Section Capacité -->
    <div x-data="{ open: true }" class="pb-4 mb-4 border-b border-gray-200">
      <button @click="open = !open" class="flex justify-between w-full">
        <h3 class="font-semibold">Capacité</h3>
        <i :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'" class="text-xl"></i>
      </button>
      <div x-show="open" class="mt-3 animate-fade-in">
        <div class="flex justify-between mb-2">
          <span x-text="`${capacity[0]} personnes`" class="text-sm text-muted-foreground"></span>
          <span x-text="`${capacity[1]} personnes`" class="text-sm text-muted-foreground"></span>
        </div>
        <div class="relative h-2 mb-6">
          <div class="range-track"></div>
          <div class="range-track-highlight"
              :style="`left: ${(capacity[0] - {{ $minCapacite }}) / {{ ($maxCapacite - $minCapacite) / 100 }}%; right: ${100 - (capacity[1] - {{ $minCapacite }}) / {{ ($maxCapacite - $minCapacite) / 100 }}%`"></div>
          <div class="range-min-handle"
              :style="`left: ${(capacity[0] - {{ $minCapacite }}) / {{ ($maxCapacite - $minCapacite) / 100 }}%`"></div>
          <div class="range-max-handle"
              :style="`left: ${(capacity[1] - {{ $minCapacite }}) / {{ ($maxCapacite - $minCapacite) / 100 }}%`"></div>
          <input type="range" min="{{ $minCapacite }}" max="{{ $maxCapacite }}" step="{{ max(intval(($maxCapacite - $minCapacite) / 20), 10) }}"
                x-model.number="capacity[0]"
                @input="capacity[0] = Math.min(capacity[0], capacity[1] - {{ max(intval(($maxCapacite - $minCapacite) / 20), 10) }})"
                class="absolute w-full h-2 opacity-0 cursor-pointer">
          <input type="range" min="{{ $minCapacite }}" max="{{ $maxCapacite }}" step="{{ max(intval(($maxCapacite - $minCapacite) / 20), 10) }}"
                x-model.number="capacity[1]"
                @input="capacity[1] = Math.max(capacity[1], capacity[0] + {{ max(intval(($maxCapacite - $minCapacite) / 20), 10) }})"
                class="absolute w-full h-2 opacity-0 cursor-pointer">
        </div>
        <div class="flex justify-between gap-2 mt-4">
          <input type="number" min="{{ $minCapacite }}" max="{{ $maxCapacite - max(intval(($maxCapacite - $minCapacite) / 20), 10) }}" 
                step="{{ max(intval(($maxCapacite - $minCapacite) / 20), 10) }}"
                x-model.number="capacity[0]"
                @input="capacity[0] = Math.min(capacity[0], capacity[1] - {{ max(intval(($maxCapacite - $minCapacite) / 20), 10) }})"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
          <input type="number" min="{{ $minCapacite + max(intval(($maxCapacite - $minCapacite) / 20), 10) }}" max="{{ $maxCapacite }}" 
                step="{{ max(intval(($maxCapacite - $minCapacite) / 20), 10) }}"
                x-model.number="capacity[1]"
                @input="capacity[1] = Math.max(capacity[1], capacity[0] + {{ max(intval(($maxCapacite - $minCapacite) / 20), 10) }})"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
        </div>
      </div>
    </div>

    <!-- Section Localisation -->
    <div x-data="{ open: true }" class="pb-4 mb-4 border-b border-gray-200">
      <button @click="open = !open" class="flex justify-between w-full">
        <h3 class="font-semibold">Localisation</h3>
        <i :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'" class="text-xl"></i>
      </button>
      <div x-show="open" class="mt-3 animate-fade-in">
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
          <i class="absolute text-gray-400 -translate-y-1/2 left-3 top-1/2 ri-search-line"></i>
          <input type="text"
                placeholder="Rechercher une ville..."
                x-model="searchTerm"
                @focus="showResults = true"
                @blur="setTimeout(() => showResults = false, 200)"
                @keydown="handleKeydown($event)"
                class="w-full py-2 pl-10 pr-4 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
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

    <!-- Section Type d'événement (ajoutée selon les instructions) -->
    <div x-data="{ open: true }" class="pb-4 mb-4 border-b border-gray-200">
      <button @click="open = !open" class="flex justify-between w-full">
        <h3 class="font-semibold">Type d'événement</h3>
        <i :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'" class="text-xl"></i>
      </button>
      <div x-show="open" class="mt-3 animate-fade-in">
        <!-- Affichage des types d'événements sélectionnés -->
        <div x-show="selectedEventTypes.length > 0" class="flex flex-wrap mb-3">
          <template x-for="type in selectedEventTypes" :key="type">
            <div class="flex items-center px-2 py-1 mb-2 mr-2 bg-gray-100 rounded-full tag">
              <span x-text="type" class="mr-1"></span>
              <button @click="removeEventType(type)">
                <i class="ri-close-line"></i>
              </button>
            </div>
          </template>
        </div>
        <!-- Champ de recherche pour les types d'événements -->
        <div class="relative mb-3">
          <i class="absolute text-gray-400 -translate-y-1/2 left-3 top-1/2 ri-search-line"></i>
          <input type="text"
                placeholder="Rechercher un type d'événement..."
                x-model="eventTypeSearchTerm"
                @focus="showEventTypeResults = true"
                @blur="setTimeout(() => showEventTypeResults = false, 200)"
                @keydown="handleEventTypeKeydown($event)"
                class="w-full py-2 pl-10 pr-4 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
          <div x-show="showEventTypeResults && filteredEventTypes().length" class="absolute w-full mt-1 overflow-auto bg-white border rounded-md max-h-40">
            <template x-for="(type, idx) in filteredEventTypes()" :key="type">
              <div
                @mouseenter="eventTypeActiveIndex = idx"
                @click="addEventType(type)"
                :class="{'bg-primary/10': eventTypeActiveIndex === idx}"
                class="px-4 py-2 cursor-pointer"
                x-text="type"
              ></div>
            </template>
          </div>
        </div>
        <!-- Message de limite atteinte -->
        <p x-show="selectedEventTypes.length >= 3" class="text-xs text-muted-foreground">
          Vous avez atteint le nombre maximum de types d'événements (3).
        </p>
        <!-- Types d'événements populaires -->
        <div x-show="selectedEventTypes.length < 3" class="mt-4">
          <p class="mb-2 text-sm font-medium">Types d'événements courants:</p>
          <div class="flex flex-wrap gap-2">
            <template x-for="type in eventTypes.slice(0, 5)" :key="type">
              <button
                @click="addEventType(type)"
                :disabled="selectedEventTypes.includes(type)"
                :class="selectedEventTypes.includes(type) ? 'opacity-50 cursor-not-allowed' : ''"
                class="px-3 py-1 text-sm bg-gray-100 rounded-full hover:bg-gray-200"
              >
                <span x-text="type"></span>
              </button>
            </template>
          </div>
        </div>
      </div>
    </div>

    <!-- Section Équipements (inchangée selon les instructions) -->
    <div x-data="{ open: true }" class="pb-4 mb-4 border-b border-gray-200">
      <button @click="open = !open" class="flex justify-between w-full">
        <h3 class="font-semibold">Équipements</h3>
        <i :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'" class="text-xl"></i>
      </button>
      <div x-show="open" class="mt-3 space-y-2 animate-fade-in">
        <label class="flex items-center">
          <input type="checkbox" class="w-5 h-5 rounded form-checkbox text-primary-600 focus:ring-primary-500"/>
          <span class="ml-2">Climatisation</span>
        </label>
        <label class="flex items-center">
          <input type="checkbox" class="w-5 h-5 rounded form-checkbox text-primary-600 focus:ring-primary-500"/>
          <span class="ml-2">Parking</span>
        </label>
        <label class="flex items-center">
          <input type="checkbox" class="w-5 h-5 rounded form-checkbox text-primary-600 focus:ring-primary-500"/>
          <span class="ml-2">Système audio</span>
        </label>
        <label class="flex items-center">
          <input type="checkbox" class="w-5 h-5 rounded form-checkbox text-primary-600 focus:ring-primary-500"/>
          <span class="ml-2">Cuisine équipée</span>
        </label>
        <label class="flex items-center">
          <input type="checkbox" class="w-5 h-5 rounded form-checkbox text-primary-600 focus:ring-primary-500"/>
          <span class="ml-2">Accès PMR</span>
        </label>
        <label class="flex items-center">
          <input type="checkbox" class="w-5 h-5 rounded form-checkbox text-primary-600 focus:ring-primary-500"/>
          <span class="ml-2">Terrasse</span>
        </label>
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
</aside>