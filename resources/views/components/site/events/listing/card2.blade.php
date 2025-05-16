@props(['eventHall', 'index'])

@php
    use App\Helpers\EventTypeHelper;
    
    // Les champs d'images
    $imageFields = ['photo', 'photo1', 'photo2', 'photo3', 'photo4'];
    
    // Filtrer pour ne garder que les champs d'images remplis
    $validImages = collect(array_filter([$eventHall->photo,$eventHall->photo1, $eventHall->photo2, $eventHall->photo3, $eventHall->photo4]));   
   
    
    // Récupérer les types d'événements supportés
    
    $supportedEvents = $eventHall->event_type;
    $displayEvents = array_slice($supportedEvents, 0, 2);
    $remainingEvents = count($supportedEvents) - count($displayEvents);
    
    // Vérifier s'il y a plusieurs images pour afficher un carrousel
    $hasMultipleImages = $validImages->count() > 1;
@endphp

<div {{ $attributes }}>
    <!-- Image fixe ou carrousel selon le nombre d'images -->
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
              {{--   <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div> --}}
            </div>
        @else
            <div class="h-48">
                <img src="{{ asset('storage/' . $validImages->first()) }}" 
                alt="{{ $eventHall->nom_salle }}" 
                class="object-cover w-full h-full"/>
            </div>
           
        @endif
    @endif
    
    <!-- Event Hall Card Info -->
    <div class="grid grid-cols-1 gap-8 p-4">
        <!-- Nom et prix -->
        <div class="flex flex-col items-center text-center">
            <h3 class="text-xl font-bold">{{ $eventHall->nom_salle }}</h3>
            <p class="font-bold text-primary">
                {{ number_format($eventHall->prix, 0, ',', ' ') }}<span> FCFA</span> 
                <span class="text-sm font-normal text-muted-foreground">/jour</span>
            </p>
        </div>
        
        <!-- Caractéristiques -->
        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-2 gap-y-2 justify-items-center 2xl:grid-cols-3">
            <div class="flex items-center text-sm text-muted-foreground">
                <i class="mr-2 text-blue-500 size-4" data-lucide="building2"></i>
                <span>{{ $eventHall->agence->nom_agence ?? 'Agence non spécifiée' }}</span>
            </div>
            
            <div class="flex items-center text-sm text-muted-foreground">
                <i class="mr-2 text-orange-500 size-4" data-lucide="map-pinned"></i>
                <span>
                    {{ $eventHall->ville->nom ?? 'Ville non spécifiée' }} ,
                    {{ Str::limit($eventHall->localisation ?? 'Localisation non spécifiée', 20, '...') }}
                </span>
            </div>
            
            <div class="flex items-center text-sm text-muted-foreground">
                <i class="mr-2 text-green-500 size-4" data-lucide="users"></i>
                <span>{{ $eventHall->capacite }} places</span>
            </div>
                <!-- Types d'événements supportés -->
            <div class="flex items-center text-sm text-muted-foreground">
                <i class="flex-shrink-0 mr-2 text-yellow-500 size-4" data-lucide="martini"></i>
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
        <a href="{{route('site.detailSallesfetes',$eventHall->id)}}" 
           class="flex items-center justify-center w-full p-2 text-white transition-colors rounded-lg bg-primary hover:bg-primary/80">
            Voir les détails
        </a>

    </div>
</div>
