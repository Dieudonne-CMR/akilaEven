@props(['eventHall', 'index'])

@php
    use App\Helpers\EventTypeHelper;
    
    // Les champs d'images
    $imageFields = ['photo', 'photo1', 'photo2', 'photo3', 'photo4'];
    
    // Filtrer pour ne garder que les champs d'images remplis
    $images = collect($imageFields)->filter(function($field) use ($eventHall) {
        return !empty($eventHall->$field);
    })->map(function($field) use ($eventHall) {
        return $eventHall->$field;
    });
   /*  var_dump($images); */
    // Types d'événements avec leurs icônes et couleurs
    $eventTypeIcons = EventTypeHelper::getEventTypeIcons();
    
    // Déterminer l'icône et la couleur pour cet événement
    $eventType = $eventHall->event_type ?? 'Autre';
    $eventIcon = $eventTypeIcons[$eventType]['icon'] ?? 'la-calendar-day';
    $eventColor = $eventTypeIcons[$eventType]['color'] ?? 'bg-muted-foreground';
    
    // Vérifier s'il y a plusieurs images pour afficher un carrousel
    $hasMultipleImages = $images->count() > 1;
@endphp
<style>
    @import ('~lucide-static/font/Lucide.css');
    </style>
<div {{ $attributes }}>
    
        <!-- Image fixe ou carrousel selon le nombre d'images -->
        @if($images->count() > 0)
            @if($hasMultipleImages)
                <div class="relative h-48 overflow-hidden">
                  <div class="absolute inset-0 flex transition-transform duration-500 ease-in-out" :style="`transform: translateX(-${currentSlide.venue{{ $index }} * 100}%)`">
                      @foreach($images as $image)
                    
                          <img src="{{ asset('storage/' . $image) }}" alt="{{ $eventHall->nom_salle }}" class="flex-shrink-0 object-cover w-full h-48"/>                                     
                      
                      @endforeach 
                      <!-- Badge de type d'événement -->
                      <span class="absolute top-[15px] left-[15px] text-white text-xs font-medium me-2 px-2 py-1.5 rounded-full {{ $eventColor }} "> <i class="la {{ $eventIcon }}"></i> {{ $eventType }}</span>                     
             
                  </div>
                  <!-- Carousel Buttons -->
                  <button @click="prevSlide('venue{{ $index }}', {{ $images->count() }})" class="absolute flex items-center justify-center w-8 h-8 p-1 text-white transition-colors transform -translate-y-1/2 rounded-full left-2 top-1/2 bg-muted-foreground/30 hover:bg-muted-foreground/50">
                    <i class="text-xl ri-arrow-left-s-line"></i>
                  </button>
                  <button @click="nextSlide('venue{{ $index }}', {{ $images->count() }})" class="absolute flex items-center justify-center w-8 h-8 p-1 text-white transition-colors transform -translate-y-1/2 rounded-full right-2 top-1/2 bg-muted-foreground/30 hover:bg-muted-foreground/50">
                  <i class="text-xl ri-arrow-right-s-line"></i>
                  </button>
                  <!-- Carousel Indicators -->
                  <div class="absolute left-0 right-0 flex justify-center gap-1 bottom-2">
                    <template x-for="(_, index) in Array.from({ length: {{ $images->count() }} }).map((_, i) => i)" :key="index">
                        <button @click="currentSlide.venue{{ $loop->iteration }} = index" 
                              :class="{'bg-white': currentSlide.venue{{ $index }} === index, 'bg-white/50': currentSlide.venue{{ $index }} !== index}"
                              class="w-2 h-2 transition-colors rounded-full"></button>
                    </template>
                  </div>
                </div>
              
            
            @else
            <img src="{{ asset('storage/' . $images->first()) }}" alt="{{ $eventHall->nom_salle }}" class="flex-shrink-0 object-cover w-full h-48"/>
            @endif
        @endif
    
       
      <!-- Event Hall Card Info -->
      <div class="p-4">
        <div class="flex items-start justify-between mb-2">
        <div>
            <h3 class="text-lg font-bold text-black">{{ $eventHall->nom_salle }}</h3>
            <div class="flex items-center text-sm text-muted-foreground">
                <i data-lucide="hotel" class="mr-1 text-blue-500 size-4"></i>
                <span>{{ $eventHall->hotel->nom_hotel }}</span>
            </div>
            
        </div>
        <div class="text-right">            
            <p class="font-bold text-primary">{{ number_format($eventHall->prix, 0, ',', ' ') }}<span> FCFA</span> <span class="text-sm font-normal text-muted-foreground">/jour</span></p>
        </div>
        </div>
        
        <div class="flex flex-col gap-3 mb-4">
        <div class="flex items-center text-sm text-muted-foreground">
            <i class="mr-1 text-orange-500 size-4" data-lucide="map-pinned"></i>
            <span>
                {{ $eventHall->ville->nom ?? 'Ville non spécifiée'}},
                {{ Str::limit($eventHall->localisation ?? 'Localisation non spécifiée', 20, '...') }}
            </span>
        </div>
        <div class="flex items-center text-sm text-muted-foreground">
            <i class="mr-1 text-green-500 size-4" data-lucide="users"></i>
            <span>Jusqu'à {{ $eventHall -> capacite }} pers.</span>
        </div>
      {{--   <div class="flex items-center text-sm text-muted-foreground">
            <i class="mr-1 ri-star-line text-primary-500"></i>
            <span>4.8 (120 avis)</span>
        </div> --}}
        </div>
        
        <a href="{{route('site.detailSallesfetes',$eventHall->id)}}" class="flex items-center justify-center w-full h-full px-2 py-2 text-white transition-colors rounded-lg bg-primary hover:bg-primary/80">
            Voir les détails
        </a>
    </div>
</div>
