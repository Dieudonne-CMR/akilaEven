<!-- Barre de recherche améliorée avec toggle -->
<div class="w-full max-w-6xl" x-data="{ activeTab: 'venues' }">
  <!-- Toggle switch entre salles et locations -->
  <div class="flex mb-4">
    <div class="inline-flex p-1 rounded-full bg-white/20 backdrop-blur-md">
      <button type="button" id="venuesBtn" 
              @click="activeTab = 'venues'" 
              :class="activeTab === 'venues' ? 'px-6 py-2 text-sm font-medium text-primary transition-all duration-200 bg-white rounded-full shadow-sm' : 'px-6 py-2 text-sm font-medium text-white transition-all duration-200 rounded-full'">
        Salles de fêtes
      </button>
      <button type="button" id="locationsBtn" 
              @click="activeTab = 'locations'" 
              :class="activeTab === 'locations' ? 'px-6 py-2 text-sm font-medium text-primary transition-all duration-200 bg-white rounded-full shadow-sm' : 'px-6 py-2 text-sm font-medium text-white transition-all duration-200 rounded-full'">
        Locations
      </button>
    </div>
  </div>
  
  <!-- Formulaire de recherche pour les salles -->
  <div x-show="activeTab === 'venues'" class="p-2 bg-white rounded-lg shadow-lg sm:p-3">
    @include('site.partials.home.search-event-halls')
  </div>
  
  <!-- Formulaire de recherche pour les locations -->
  <div x-show="activeTab === 'locations'" class="p-2 bg-white rounded-lg shadow-lg sm:p-3">
    @include('site.partials.home.search-locations')
  </div>
</div>

<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('searchForm', () => ({
      activeTab: 'venues',
      
      init() {
        // Initialisation
      }
    }));
  });
</script>