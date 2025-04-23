  <!-- Search and Toggle -->
  <div class="flex flex-col gap-4 mb-6 md:flex-row">
         
    <div class="flex flex-col gap-2 p-2 bg-white rounded-lg shadow-md md:flex-row">
      <div class="relative flex-1">
        <i class="absolute text-gray-400 transform -translate-y-1/2 ri-search-line left-3 top-1/2"></i>
        <input type="text" placeholder="Rechercher une salle..." class="w-full h-full py-2 pl-10 pr-4 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
      </div>
      <div class="relative flex-1">
        <i class="absolute text-gray-400 transform -translate-y-1/2 ri-hotel-line left-3 top-1/2"></i>
        <input type="text" placeholder="Rechercher un hôtel..." class="w-full h-full py-2 pl-10 pr-4 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
      </div>
    
      
        <div class="relative flex-1 w-full md:w-48">
          <select class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg shadow-md appearance-none focus:outline-none focus:ring-2 focus:ring-primary-500">
            <option>Prix croissant</option>
            <option>Prix décroissant</option>
            <option>Capacité croissante</option>
            <option>Capacité décroissante</option>
            <option>Meilleures notes</option>
          </select>
          <i class="absolute transform -translate-y-1/2 pointer-events-none text-muted-foreground ri-arrow-down-s-line right-4 top-1/2"></i>
        </div>
         <!-- Bouton mobile pour ouvrir les filtres -->
         <button @click="showFilters = true" class="flex-1 h-full px-4 py-2 text-white rounded-md lg:hidden bg-primary">
          <i class="ri-filter-3-line"></i>
          <span>Filtres</span>
        </button>
    </div>        
  
  
</div>