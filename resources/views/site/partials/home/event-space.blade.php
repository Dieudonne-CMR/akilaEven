@php
    use App\Models\EventHall;
    use App\Models\Bookings;
   
    // Récupérer les salles de fêtes
    $popularEventHalls = EventHall::with(['agence', 'ville'])->get();
    $displayCarousel = $popularEventHalls->count() > 3;
@endphp

<style>
.swiper-button-next,
.swiper-button-prev {
    background: white;
    border-radius: 50%;
    height: 20px !important;
    width: 20px !important;
    border-radius: 50%;
    box-shadow:
        0 4px 6px -1px rgba(0, 0, 0, 0.1),
        0 2px 4px -1px rgba(0, 0, 0, 0.06);
    color: #4b5563 !important;
    transition: all 0.3s ease;
   
}
.swiper-button-prev{
  left: 3px;
}
.swiper-button-next{
  right: 3px;
}
.swiper-button-next:after,
.swiper-button-prev:after {
    font-size: 15px !important;

}
</style>

<div x-data="eventSpaceComponent()">
  <div class="flex items-center justify-between mb-8">
      <h3 class="pl-4 text-2xl font-bold border-l-4 heading !border-primary">Salles d'évènement</h3>
      <a href="{{ route('site.sallesfetes') }}" class="group flex items-center gap-2 font-medium !text-primary/80 hover:!text-primary">
          Voir toutes les salles <i data-lucide="arrow-right" class="transition-all size-4 group-hover:translate-x-1"></i>
      </a>
  </div>

  @if($popularEventHalls->isEmpty())
    <div class="w-full p-8 text-center">
        <p class="text-lg text-muted-foreground">Aucune salle d'événement n'est disponible actuellement.</p>
    </div>
  @elseif($displayCarousel)
    <div class="py-4! swiper event-hall-swiper" data-space-between="20" data-autoplay="true">
        <div class="swiper-wrapper">
            @foreach($popularEventHalls as $index => $eventHall)
                <div class="swiper-slide">
                    <x-site.home.events.card :eventHall="$eventHall" :index="$index" />
                   {{--  <div class="overflow-hidden bg-white rounded-lg shadow-md">
                        <!-- Image fixe ou carrousel selon le nombre d'images -->
                        @php
                            $imageFields = ['photo', 'photo1', 'photo2', 'photo3', 'photo4'];
                            $validImages = collect(array_filter([$eventHall->photo, $eventHall->photo1, $eventHall->photo2, $eventHall->photo3, $eventHall->photo4]));
                            $hasMultipleImages = $validImages->count() > 1;
                        @endphp

                      
                        
                        <!-- Infos de la salle -->
                        <div class="p-4">
                            <div class="flex flex-col items-center mb-4 text-center">
                                <h3 class="text-xl font-bold">{{ $eventHall->nom_salle }}</h3>
                            </div>
                            
                            <!-- Caractéristiques -->
                            <div class="grid grid-cols-1 gap-2 text-sm md:grid-cols-2">
                                <div class="flex items-center text-muted-foreground">
                                    <i class="mr-2 text-blue-500 size-4" data-lucide="building2"></i>
                                    <span>{{ $eventHall->agence->nom_agence ?? 'Agence non spécifiée' }}</span>
                                </div>
                                
                                <div class="flex items-center text-muted-foreground">
                                    <i class="mr-2 text-orange-500 size-4" data-lucide="map-pinned"></i>
                                    <span>
                                        {{ $eventHall->ville->nom ?? 'Ville non spécifiée' }},
                                        {{ Str::limit($eventHall->localisation ?? 'Localisation non spécifiée', 20, '...') }}
                                    </span>
                                </div>
                                
                                <div class="flex items-center text-muted-foreground">
                                    <i class="mr-2 text-green-500 size-4" data-lucide="users"></i>
                                    <span>{{ $eventHall->capacite }} places</span>
                                </div>
                                
                                <!-- Types d'événements supportés -->
                                @php
                                    $supportedEvents = $eventHall->event_type;
                                    $displayEvents = array_slice($supportedEvents, 0, 2);
                                    $remainingEvents = count($supportedEvents) - count($displayEvents);
                                @endphp
                                <div class="flex items-center text-muted-foreground">
                                    <i class="shrink-0 mr-2 text-yellow-500 size-4" data-lucide="martini"></i>
                                    <span class="font-medium">
                                        @foreach($displayEvents as $event)
                                            {{ Str::lower(trim($event)) . 's' }}@if(!$loop->last), @endif
                                        @endforeach
                                        @if($remainingEvents > 0)
                                            <span> , etc...</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            <a href="{{ route('site.detailSallesfetes', $eventHall->id) }}" 
                               class="flex items-center justify-center w-full p-2 mt-4 text-white transition-colors rounded-lg bg-primary hover:bg-primary/80">
                                Voir les détails
                            </a>
                        </div>
                    </div> --}}
                </div>
            @endforeach
        </div>
        
        <!-- Add Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
  @else
    <!-- Affichage en grille pour 3 salles ou moins -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach($popularEventHalls as $index => $eventHall)
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                <!-- Image fixe ou carrousel selon le nombre d'images -->
                @php
                    $imageFields = ['photo', 'photo1', 'photo2', 'photo3', 'photo4'];
                    $validImages = collect(array_filter([$eventHall->photo, $eventHall->photo1, $eventHall->photo2, $eventHall->photo3, $eventHall->photo4]));
                    $hasMultipleImages = $validImages->count() > 1;
                @endphp

                <div class="relative">
                    @if($validImages->count() > 0)
                        @if($hasMultipleImages)
                            <div class="swiper venue-swiper-{{ $index }} h-48">
                                <div class="swiper-wrapper">
                                    @foreach($validImages as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ asset('storage/' . $image) }}" 
                                                alt="{{ $eventHall->nom_salle }}" 
                                                class="object-cover w-full h-48"/>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        @else
                            <div class="h-48">
                                <img src="{{ asset('storage/' . $validImages->first()) }}" 
                                    alt="{{ $eventHall->nom_salle }}" 
                                    class="object-cover w-full h-full"/>
                            </div>
                        @endif
                    @endif
                    
                    <!-- Badge de prix -->
                    <div class="absolute px-3 py-1 text-xs font-semibold text-white rounded-full top-3 right-3 bg-primary">
                        {{ number_format($eventHall->prix, 0, ',', ' ') }} FCFA/jour
                    </div>
                </div>
                
                <!-- Infos de la salle -->
                <div class="p-4">
                    <div class="flex flex-col items-center mb-4 text-center">
                        <h3 class="text-xl font-bold">{{ $eventHall->nom_salle }}</h3>
                    </div>
                    
                    <!-- Caractéristiques -->
                    <div class="grid grid-cols-1 gap-2 text-sm md:grid-cols-2">
                        <div class="flex items-center text-muted-foreground">
                            <i class="mr-2 text-blue-500 size-4" data-lucide="building2"></i>
                            <span>{{ $eventHall->agence->nom_agence ?? 'Agence non spécifiée' }}</span>
                        </div>
                        
                        <div class="flex items-center text-muted-foreground">
                            <i class="mr-2 text-orange-500 size-4" data-lucide="map-pinned"></i>
                            <span>
                                {{ $eventHall->ville->nom ?? 'Ville non spécifiée' }},
                                {{ Str::limit($eventHall->localisation ?? 'Localisation non spécifiée', 20, '...') }}
                            </span>
                        </div>
                        
                        <div class="flex items-center text-muted-foreground">
                            <i class="mr-2 text-green-500 size-4" data-lucide="users"></i>
                            <span>{{ $eventHall->capacite }} places</span>
                        </div>
                        
                        <!-- Types d'événements supportés -->
                        @php
                            $supportedEvents = $eventHall->event_type;
                            $displayEvents = array_slice($supportedEvents, 0, 2);
                            $remainingEvents = count($supportedEvents) - count($displayEvents);
                        @endphp
                        <div class="flex items-center text-muted-foreground">
                            <i class="shrink-0 mr-2 text-yellow-500 size-4" data-lucide="martini"></i>
                            <span class="font-medium">
                                @foreach($displayEvents as $event)
                                    {{ Str::lower(trim($event)) . 's' }}@if(!$loop->last), @endif
                                @endforeach
                                @if($remainingEvents > 0)
                                    <span> , etc...</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    
                    <a href="{{ route('site.detailSallesfetes', $eventHall->id) }}" 
                       class="flex items-center justify-center w-full p-2 mt-4 text-white transition-colors rounded-lg bg-primary hover:bg-primary/80">
                        Voir les détails
                    </a>
                </div>
            </div>
        @endforeach
    </div>
  @endif
</div>

<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('eventSpaceComponent', () => ({
      init() {
        // Initialisation des mini-sliders pour chaque venue si nécessaire
        if (typeof Swiper !== 'undefined') {
          document.querySelectorAll('[class^="venue-swiper-"]').forEach(el => {
            new Swiper(el, {
              slidesPerView: 1,
              spaceBetween: 0,
              pagination: {
                el: el.querySelector('.swiper-pagination'),
                clickable: true,
              },
              autoplay: {
                delay: 3000,
              },
            });
          });
        }
      }
    }));
  });
</script>