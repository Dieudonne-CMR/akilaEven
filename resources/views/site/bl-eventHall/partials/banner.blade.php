@php
  use App\Models\EventHall;
  $totalEventHalls = EventHall::count();
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
      
  {{--     <!-- Barre de recherche -->
      <div class="flex flex-col items-center w-full max-w-3xl gap-3 p-2 bg-white rounded-lg shadow-lg sm:p-3 sm:flex-row">
        <div class="w-full sm:w-1/3">
          <label for="location" class="sr-only">Lieu</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
              </svg>
            </div>
            <input id="location" name="location" placeholder="Où ?" class="block w-full py-3 pl-10 pr-3 leading-5 placeholder-gray-500 bg-gray-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white">
          </div>
        </div>
        
        <div class="w-full sm:w-1/3">
          <label for="date" class="sr-only">Date</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
              </svg>
            </div>
            <input id="date" name="date" type="text" placeholder="Quand ?" class="block w-full py-3 pl-10 pr-3 leading-5 placeholder-gray-500 bg-gray-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white">
          </div>
        </div>
        
        <div class="w-full sm:w-1/3">
          <label for="guests" class="sr-only">Invités</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
              </svg>
            </div>
            <input id="guests" name="guests" type="text" placeholder="Combien d'invités ?" class="block w-full py-3 pl-10 pr-3 leading-5 placeholder-gray-500 bg-gray-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white">
          </div>
        </div>
        
        <button type="submit" class="flex-shrink-0 w-full px-6 py-3 font-medium text-white transition duration-150 ease-in-out bg-purple-600 rounded-md sm:w-auto hover:bg-purple-700">
          Rechercher
        </button>
      </div> --}}
      
      <!-- Badges de catégories -->
      <div class="flex flex-wrap gap-2 mt-8">
        <span class="px-4 py-2 text-sm font-medium text-white transition rounded-full cursor-pointer bg-white/20 backdrop-blur-sm hover:bg-white/30">
          Mariages
        </span>
        <span class="px-4 py-2 text-sm font-medium text-white transition rounded-full cursor-pointer bg-white/20 backdrop-blur-sm hover:bg-white/30">
          Anniversaires
        </span>
        <span class="px-4 py-2 text-sm font-medium text-white transition rounded-full cursor-pointer bg-white/20 backdrop-blur-sm hover:bg-white/30">
          Séminaires
        </span>
        <span class="px-4 py-2 text-sm font-medium text-white transition rounded-full cursor-pointer bg-white/20 backdrop-blur-sm hover:bg-white/30">
          Conférences
        </span>
        <span class="px-4 py-2 text-sm font-medium text-white transition rounded-full cursor-pointer bg-white/20 backdrop-blur-sm hover:bg-white/30">
          Soirées privées
        </span>
      </div>
    </div>
  </div>
  
  <!-- Statistiques -->
  @include("site.bl-eventHall.partials.stat-cards")
</div>
{{-- <div class="relative overflow-hidden text-white">
  <div class="absolute inset-0 z-0">
    <img src="{{ asset('assets_site/images_site/event_halls/event-halls-4.jpg') }}"
         alt="Salle de fête" 
         class="object-cover w-full h-full opacity-30">
  </div>
  <div class="absolute inset-0 bg-gradient-to-l from-bg-primary"></div>
  <div class="container relative z-10 px-4 py-16 mx-auto md:py-24">
    <div class="max-w-3xl">
    
      <div class="inline-flex transition-colors border border-accent bg-white px-3 py-0.5 gap-2">
        <h1 class="mb-4 text-3xl font-bold leading-[49px] md:text-5xl text-primary">Trouvez la Salle Parfaite pour votre évènement</h1>
      </div>
     
     
      <div class="flex flex-wrap gap-3 mt-8">
        <div class="flex items-center px-4 py-2 rounded-full bg-white/50 backdrop-blur-sm">
          <i class="mr-2 text-blue-800 ri-map-pin-line"></i>
          <span class="font-normal text-muted-foreground">Plus de {{ $totalEventHalls < 10 ? '0' . $totalEventHalls : $totalEventHalls }} salles disponibles</span>
        </div>
        <div class="flex items-center px-4 py-2 rounded-full bg-white/50 backdrop-blur-sm">
          <i class="mr-2 text-yellow-500 ri-star-line"></i>
          <span class="font-normal text-muted-foreground"> Notées par nos clients</span> 
        </div>
        <div class="flex items-center px-4 py-2 rounded-full bg-white/50 backdrop-blur-sm">
          <i class="mr-2 text-green-500 ri-shield-check-line"></i>
          <span class="font-normal text-muted-foreground">Réservation sécurisée</span>
        </div>
      </div>
    </div>
  </div>

</div> --}}