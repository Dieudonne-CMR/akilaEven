<!-- Barre de recherche améliorée avec toggle -->
<div class="w-full max-w-6xl" x-data="searchForm()">
  <!-- Toggle switch entre salles et chambres -->
  <div class="flex mb-4">
    <div class="inline-flex p-1 rounded-full bg-white/20 backdrop-blur-md">
      <button type="button" id="venuesBtn" 
              @click="activeTab = 'venues'" 
              :class="activeTab === 'venues' ? 'px-6 py-2 text-sm font-medium text-purple-700 transition-all duration-200 bg-white rounded-full shadow-sm' : 'px-6 py-2 text-sm font-medium text-white transition-all duration-200 rounded-full'">
        Salles de fêtes
      </button>
      <button type="button" id="roomsBtn" 
              @click="activeTab = 'rooms'" 
              :class="activeTab === 'rooms' ? 'px-6 py-2 text-sm font-medium text-purple-700 transition-all duration-200 bg-white rounded-full shadow-sm' : 'px-6 py-2 text-sm font-medium text-white transition-all duration-200 rounded-full'">
        Chambres
      </button>
    </div>
  </div>
  
  <!-- Formulaire de recherche pour les salles -->
  <div x-show="activeTab === 'venues'" class="p-2 bg-white rounded-lg shadow-lg sm:p-3">
    <form @submit.prevent="submitSearch('venues')">
      <div class="flex flex-col items-center gap-3 sm:flex-row">
        <div class="w-full sm:w-1/5">
          <label for="location-venues" class="sr-only">Lieu</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
              </svg>
            </div>
            <input 
              id="location-venues" 
              x-model="venues.location" 
              list="venues-locations" 
              name="location" 
              placeholder="Où ?" 
              class="block w-full py-3 pl-10 pr-3 leading-5 placeholder-gray-500 bg-gray-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white">
            <datalist id="venues-locations">
              <template x-for="location in availableLocations" :key="location">
                <option :value="location"></option>
              </template>
            </datalist>
          </div>
        </div>
        
        <div class="w-full sm:w-1/5">
          <label for="event-type-venues" class="sr-only">Type d'événement</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
              </svg>
            </div>
            <select 
              id="event-type-venues" 
              x-model="venues.eventType" 
              name="event_type" 
              class="block w-full py-3 pl-10 pr-3 leading-5 placeholder-gray-500 bg-gray-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white">
              <option value="">Type d'événement</option>
              <template x-for="type in eventTypes" :key="type">
                <option :value="type" x-text="type"></option>
              </template>
            </select>
          </div>
        </div>
        
        <div class="w-full sm:w-1/5">
          <label for="start-date-venues" class="sr-only">Date de début</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
              </svg>
            </div>
            <input 
              id="start-date-venues" 
              x-model="venues.startDate" 
              type="date" 
              name="start_date" 
              placeholder="Date début" 
              min="<?= date('Y-m-d') ?>"
              class="block w-full py-3 pl-10 pr-3 leading-5 placeholder-gray-500 bg-gray-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white">
          </div>
        </div>
        
        <div class="w-full sm:w-1/5">
          <label for="end-date-venues" class="sr-only">Date de fin</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
              </svg>
            </div>
            <input 
              id="end-date-venues" 
              x-model="venues.endDate" 
              type="date" 
              name="end_date" 
              placeholder="Date fin" 
              :min="venues.startDate || '<?= date('Y-m-d') ?>'"
              class="block w-full py-3 pl-10 pr-3 leading-5 placeholder-gray-500 bg-gray-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white">
          </div>
        </div>
        
        <div class="w-full sm:w-1/5">
          <label for="guests-venues" class="sr-only">Capacité</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
              </svg>
            </div>
            <input 
              id="guests-venues" 
              x-model="venues.capacity" 
              name="capacity" 
              type="number" 
              min="1"
              placeholder="Nombre d'invités" 
              class="block w-full py-3 pl-10 pr-3 leading-5 placeholder-gray-500 bg-gray-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white">
          </div>
        </div>
        
        <button type="submit" class="flex-shrink-0 w-full px-6 py-3 font-medium text-white transition duration-150 ease-in-out bg-purple-600 rounded-md sm:w-auto hover:bg-purple-700">
          Rechercher
        </button>
      </div>
    </form>
  </div>
  
  <!-- Formulaire de recherche pour les chambres -->
  <div x-show="activeTab === 'rooms'" class="p-2 bg-white rounded-lg shadow-lg sm:p-3">
    <form @submit.prevent="submitSearch('rooms')">
      <div class="flex flex-col items-center gap-3 sm:flex-row">
        <div class="w-full sm:w-1/5">
          <label for="location-rooms" class="sr-only">Lieu</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
              </svg>
            </div>
            <input 
              id="location-rooms" 
              x-model="rooms.location" 
              list="rooms-locations" 
              name="location" 
              placeholder="Destination" 
              class="block w-full py-3 pl-10 pr-3 leading-5 placeholder-gray-500 bg-gray-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white">
            <datalist id="rooms-locations">
              <template x-for="location in availableLocations" :key="location">
                <option :value="location"></option>
              </template>
            </datalist>
          </div>
        </div>
        
        <div class="w-full sm:w-1/5">
          <label for="checkin-rooms" class="sr-only">Arrivée</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
              </svg>
            </div>
            <input 
              id="checkin-rooms" 
              x-model="rooms.checkIn" 
              name="checkin" 
              type="date" 
              min="<?= date('Y-m-d') ?>"
              placeholder="Arrivée" 
              class="block w-full py-3 pl-10 pr-3 leading-5 placeholder-gray-500 bg-gray-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white">
          </div>
        </div>
        
        <div class="w-full sm:w-1/5">
          <label for="checkout-rooms" class="sr-only">Départ</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
              </svg>
            </div>
            <input 
              id="checkout-rooms" 
              x-model="rooms.checkOut" 
              name="checkout" 
              type="date" 
              :min="rooms.checkIn || '<?= date('Y-m-d') ?>'"
              placeholder="Départ" 
              class="block w-full py-3 pl-10 pr-3 leading-5 placeholder-gray-500 bg-gray-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white">
          </div>
        </div>
        
        <div class="w-full sm:w-1/5">
          <label for="guests-rooms" class="sr-only">Voyageurs</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
              </svg>
            </div>
            <input 
              id="guests-rooms" 
              x-model="rooms.guests" 
              name="guests" 
              type="number" 
              min="1"
              placeholder="Voyageurs" 
              class="block w-full py-3 pl-10 pr-3 leading-5 placeholder-gray-500 bg-gray-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white">
          </div>
        </div>
        
        <button type="submit" class="flex-shrink-0 w-full px-6 py-3 font-medium text-white transition duration-150 ease-in-out bg-purple-600 rounded-md sm:w-auto hover:bg-purple-700">
          Rechercher
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('searchForm', () => ({
      activeTab: 'venues',
      
      // Données pour les salles de fêtes
      venues: {
        location: '',
        eventType: '',
        startDate: '',
        endDate: '',
        capacity: ''
      },
      
      // Données pour les chambres
      rooms: {
        location: '',
        checkIn: '',
        checkOut: '',
        guests: ''
      },
      
      // Types d'événements disponibles
      eventTypes: ['Mariage', 'Anniversaire', 'Conférence', 'Séminaire', 'Gala', 'Autre'],
      
      // Localisations disponibles (à charger depuis l'API)
      availableLocations: [],
      
      init() {
        // Charger les localisations disponibles
        this.fetchLocations();
      },
      
      fetchLocations() {
        // Simulation - Dans un cas réel, fetch depuis une API
        this.availableLocations = [
          'Douala, Bepanda', 
          'Douala, Akwa', 
          'Yaoundé, Centre', 
          'Yaoundé, Bastos',
          'Bafoussam, Centre'
        ];
      },
      
      submitSearch(type) {
        let searchParams = new URLSearchParams();
        
        if (type === 'venues') {
          if (this.venues.location) searchParams.append('location', this.venues.location);
          if (this.venues.eventType) searchParams.append('event_type', this.venues.eventType);
          if (this.venues.startDate) searchParams.append('start_date', this.venues.startDate);
          if (this.venues.endDate) searchParams.append('end_date', this.venues.endDate);
          if (this.venues.capacity) searchParams.append('capacity', this.venues.capacity);
        } else {
          if (this.rooms.location) searchParams.append('location', this.rooms.location);
          if (this.rooms.checkIn) searchParams.append('checkin', this.rooms.checkIn);
          if (this.rooms.checkOut) searchParams.append('checkout', this.rooms.checkOut);
          if (this.rooms.guests) searchParams.append('guests', this.rooms.guests);
        }
        
        // Redirection avec les paramètres de recherche
        const targetUrl = type === 'venues' 
          ? '{{ route("site.sallesfetes") }}' 
          : '{{ route("site.bl-rooms.rooms") }}';
        
        window.location.href = targetUrl + '?' + searchParams.toString();
      }
    }));
  });
</script>