@props(['eventHall'])

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
    $eventColor = $eventTypeIcons[$eventType]['color'] ?? 'bg-secondary';
    
    // Vérifier s'il y a plusieurs images pour afficher un carrousel
    $hasMultipleImages = $images->count() > 1;
@endphp

<div {{ $attributes }}>
    
        <!-- Image fixe ou carrousel selon le nombre d'images -->
        @if($images->count() > 0)
            @if($hasMultipleImages)
                <div class="relative h-48 overflow-hidden">
                  <div class="absolute inset-0 flex transition-transform duration-500 ease-in-out" :style="`transform: translateX(-${currentSlide.venue{{ $loop->iteration }}} * 100}%)`">
                      @foreach($images as $image)
                    
                          <img src="{{ asset('storage/' . $image) }}" alt="{{ $eventHall->nom_salle }}" class="flex-shrink-0 object-cover w-full h-48"/>
                          <!-- Carousel Controls -->
                          <button @click="prevSlide('venue{{ $loop->iteration }}', {{ $images->count() }})" class="absolute p-1 text-white transition-colors transform -translate-y-1/2 rounded-full left-2 top-1/2 bg-black/50 hover:bg-black/70">
                            <i class="text-xl ri-arrow-left-s-line"></i>
                          </button>
                          <button @click="nextSlide('venue{{ $loop->iteration }}', {{ $images->count() }})" class="absolute p-1 text-white transition-colors transform -translate-y-1/2 rounded-full right-2 top-1/2 bg-black/50 hover:bg-black/70">
                          <i class="text-xl ri-arrow-right-s-line"></i>
                          </button>
                          <!-- Carousel Indicators -->
                          <div class="absolute left-0 right-0 flex justify-center gap-1 bottom-2">
                            <template x-for="(_, index) in Array.from({ length: {{ $images->count() }} }).map((_, i) => i)" :key="index">
                                <button @click="currentSlide.venue{{ $loop->iteration }} = index" 
                                      :class="{'bg-white': currentSlide.venue{{ $loop->iteration }} === index, 'bg-white/50': currentSlide.venue{{ $loop->iteration }} !== index}"
                                      class="w-2 h-2 transition-colors rounded-full"></button>
                            </template>
                          </div>
                      
                      @endforeach
                      <div class="absolute inset-0 flex transition-transform duration-500 ease-in-out"
                          :style="`transform: translateX(-${currentSlide.venue1 * 100}%)`">
                      <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1498&q=80" 
                              class="flex-shrink-0 object-cover w-full h-48" alt="Salle de fête">
                      <img src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80" 
                              class="flex-shrink-0 object-cover w-full h-48" alt="Salle de fête">
                      <img src="https://images.unsplash.com/photo-1505236858219-8359eb29e329?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1562&q=80" 
                              class="flex-shrink-0 object-cover w-full h-48" alt="Salle de fête">
                      </div>
                      <!-- Carousel Controls -->
                      <button @click="prevSlide('venue1', 3)" class="absolute p-1 text-white transition-colors transform -translate-y-1/2 rounded-full left-2 top-1/2 bg-black/50 hover:bg-black/70">
                      <i class="text-xl ri-arrow-left-s-line"></i>
                      </button>
                      <button @click="nextSlide('venue1', 3)" class="absolute p-1 text-white transition-colors transform -translate-y-1/2 rounded-full right-2 top-1/2 bg-black/50 hover:bg-black/70">
                      <i class="text-xl ri-arrow-right-s-line"></i>
                      </button>
                      <!-- Carousel Indicators -->
                      <div class="absolute left-0 right-0 flex justify-center gap-1 bottom-2">
                      <template x-for="(_, index) in [0, 1, 2]" :key="index">
                          <button @click="currentSlide.venue1 = index" 
                                  :class="{'bg-white': currentSlide.venue1 === index, 'bg-white/50': currentSlide.venue1 !== index}"
                                  class="w-2 h-2 transition-colors rounded-full"></button>
                      </template>
                      </div>
                  </div>
                </div>
              
            
            @else
            <img src="{{ asset('storage/' . $images->first()) }}" alt="{{ $eventHall->nom_salle }}" class="flex-shrink-0 object-cover w-full h-48"/>
            @endif
        @endif
        {{-- @else
            <img src="{{ asset('assets_site/images_site/event_halls/event-halls-1.jpg') }}" alt="{{ $eventHall->nom_salle }}" class="img-fluid event-hall-img"/>
        @endif --}}
        
        <!-- Badge de type d'événement -->
        <span class="event-type-badge {{ $eventColor }}">
            <i class="la {{ $eventIcon }}"></i> {{ $eventType }}
        </span>
   
    
      <!-- Venue Info -->
      <div class="p-4">
        <div class="flex items-start justify-between mb-2">
        <div>
            <h3 class="text-lg font-bold">{{ $eventHall->nom_salle }}</h3>
            <p class="text-sm text-muted-foreground">Hôtel Royale</p>
        </div>
        <div class="text-right">
            <p class="font-bold text-primary-600">450€<span class="text-sm font-normal text-muted-foreground">/jour</span></p>
        </div>
        </div>
        
        <div class="flex flex-wrap gap-3 mb-4">
        <div class="flex items-center text-sm text-muted-foreground">
            <i class="mr-1 ri-map-pin-line text-primary-500"></i>
            <span>Paris, 8ème</span>
        </div>
        <div class="flex items-center text-sm text-muted-foreground">
            <i class="mr-1 ri-user-line text-primary-500"></i>
            <span>Jusqu'à 150 pers.</span>
        </div>
        <div class="flex items-center text-sm text-muted-foreground">
            <i class="mr-1 ri-star-line text-primary-500"></i>
            <span>4.8 (120 avis)</span>
        </div>
        </div>
        
        <button class="w-full py-2 text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary">
        Voir les détails
        </button>
    </div>
</div>

<style>
    /* Styles pour la carte de salle de fête */
    .event-hall-card {
        border: none;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        height: 100%;
    }
    
    .event-hall-img {
        height: 220px;
        width: 100%;
        object-fit: cover;
    }
    
    .event-type-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 5px 10px;
        border-radius: 20px;
        color: white;
        font-size: 12px;
        font-weight: 600;
        z-index: 10;
    }
    
    .card-title {
        font-size: 1.15rem;
        font-weight: 600;
        margin-bottom: 5px;
        line-height: 1.3;
    }
    
    .card-title a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .card-title a:hover {
        color: #287dfa;
    }
    
    .card-location, .location-info, .capacity-info {
        font-size: 0.875rem;
        color: #666;
    }
    
    .price-info {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }
    
    .price {
        font-weight: 600;
        font-size: 1rem;
        color: #333;
    }
    
    .price-period {
        font-size: 0.75rem;
        color: #999;
    }
    
    /* Bouton de détails */
    .event-hall-card .btn-primary {
        border-radius: 4px;
        font-weight: 500;
        padding: 8px 15px;
    }
</style>

<script>
    // Script pour initialiser le carrousel uniquement s'il y a plusieurs images
    document.addEventListener('DOMContentLoaded', function() {
        $('.event-hall-carousel').each(function() {
            const $carousel = $(this);
            const slideCount = $carousel.find('.item').length;
            
            // Initialiser le carrousel seulement s'il y a plus d'une image
            if (slideCount > 1) {
                $carousel.owlCarousel({
                    items: 1,
                    loop: true,
                    margin: 0,
                    nav: true,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    navText: [
                        '<i class="la la-angle-left"></i>',
                        '<i class="la la-angle-right"></i>'
                    ]
                });
            }
        });
    });
</script> 