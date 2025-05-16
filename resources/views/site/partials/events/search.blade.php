  <!-- Search and Toggle -->
  <form action="{{ route('site.sallesfetes') }}" method="GET" class="flex flex-col w-full gap-2 p-2 mb-4 bg-white rounded-lg shadow-md md:flex-row">
      <!-- Recherche de salle -->
      <div class="relative flex-[2]">
          <i data-lucide="search" class="absolute text-gray-400 transform -translate-y-1/2 size-4 left-3 top-1/2"></i>
          <input 
              type="text" 
              name="search" 
              placeholder="Rechercher une salle..." 
              class="w-full h-full py-2 pl-10 pr-4 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
              value="{{ request('search') }}"
          >
      </div>
      
      <!-- Recherche d'agence (commentée) -->
      {{-- <div class="relative flex-1">
          <i data-lucide="agence" class="absolute text-gray-400 transform -translate-y-1/2 size-4 left-3 top-1/2"></i>
          <input type="text" placeholder="Rechercher un agence..." class="w-full h-full py-2 pl-10 pr-4 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
      </div> --}}
      
      <!-- Filtres de tri -->
      <div class="relative flex-1 w-full md:w-48">
          <select 
              name="sort_by" 
              class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg shadow-md appearance-none focus:outline-none focus:ring-2 focus:ring-primary"
          >
              <option value="">Trier par...</option>
              <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
              <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
              <option value="capacity_asc" {{ request('sort_by') == 'capacity_asc' ? 'selected' : '' }}>Capacité croissante</option>
              <option value="capacity_desc" {{ request('sort_by') == 'capacity_desc' ? 'selected' : '' }}>Capacité décroissante</option>
          </select>
          <i data-lucide="chevron-down" class="absolute transform -translate-y-1/2 pointer-events-none text-muted-foreground right-4 top-1/2 size-4"></i>
      </div>
      
      <!-- Bouton de recherche -->
      <button type="submit" class="px-4 py-2 text-white rounded-md bg-primary hover:bg-primary/90 hidden md:block">
          Rechercher
      </button>
      
      <!-- Bouton mobile pour ouvrir les filtres -->
      <button type="button" @click="showFilters = true" class="flex items-center justify-center flex-1 h-full gap-1 px-4 py-2 text-white rounded-md lg:hidden bg-primary">
          <i data-lucide="list-filter" class="size-4"></i>
          <span>Filtres</span>
      </button>
  </form>