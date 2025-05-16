@props(['eventHall'])

@php
    use App\Helpers\EventTypeHelper;
    
    // Filtrer pour ne garder que les champs d'images remplis
    $validImages = collect(array_filter([$eventHall->photo,$eventHall->photo1, $eventHall->photo2, $eventHall->photo3, $eventHall->photo4]));
                    
    
    // Récupérer les types d'événements supportés
    $supportedEvents = $eventHall->event_type ?? [];
    $displayEvents = array_slice($supportedEvents, 0, 3);
    $remainingEvents = count($supportedEvents) - count($displayEvents);
    
    // Nombre total d'images valides
    $imagesCount = $validImages->count();
@endphp

<div class="order-2 w-full">
    <!-- En-tête avec titre, prix et caractéristiques -->
    <div class="flex flex-col justify-between gap-6 mb-6 md:flex-row md:items-start">
        <div>
            <div class="text-3xl flex flex-wrap items-center gap-4">
                <h1 class="font-bold">{{ $eventHall->nom_salle }}</h1>
                <span class="">/</span>
                <p class=" font-bold text-primary">
                    {{ number_format($eventHall->prix, 0, ',', ' ') }}<span> FCFA</span> 
                    <span class="text-sm font-normal text-muted-foreground">/jour</span>
                </p>
            </div>
            
            <!-- Caractéristiques -->
            <div class="flex flex-wrap items-center gap-3 mt-3 text-sm event-hall-subtitle">
                <span class="flex items-center">
                    <i data-lucide="building-2" class="size-4 mr-1 text-blue-500"></i> 
                    {{ $eventHall->agence->nom_agence ?? 'Agence non spécifiée' }}
                </span>
                
                <span class="flex items-center">
                    <i class="size-4 mr-1 text-orange-500 fas fa-map-marker-alt"></i> 
                    {{ $eventHall->ville->nom ?? 'Ville non spécifiée' }}, {{ $eventHall->localisation ?? 'Localisation non spécifiée' }}
                </span>
                
                <span class="flex items-center">
                    <i class="size-4 mr-1 text-green-500 fas fa-users"></i>
                    {{ number_format($eventHall->capacite) }} places
                </span>
                
                <span class="flex items-center">
                    <i class="size-4 mr-1 text-purple-500 fas fa-vector-square"></i>
                    {{ number_format($eventHall->area ?? 0) }} m²
                </span>
            </div>
            
            <!-- Types d'événements supportés -->
            <div class="flex items-center mt-4 text-sm text-muted-foreground">
              <i class="size-4 text-rose-500 mr-1" data-lucide="martini"></i>
                <span class="font-medium">
                  Idéal pour les
                  @foreach($supportedEvents as $event)
                  {{ Str::lower(trim($event)) . 's' }}
                  @endforeach
                </span>
               
             
            </div>
        </div>
        
            
            
            <button 
                x-text="showCalendar ? 'Fermer' : 'Réserver'"
                @click="toggleCalendarView()"
                class="py-3 px-4 text-sm text-white transition-colors rounded-lg bg-primary hover:bg-primary/80">
            </button>
      
    </div>
    
    <!-- Calendrier inline (affiché/masqué) -->
    <div x-show="showCalendar" x-cloak class="p-4 mb-6 bg-white rounded-lg shadow-md">
        <h3 class="mb-2 text-lg font-semibold">Sélectionnez vos dates</h3>
        <div id="inline-calendar" class="w-full"></div>
        <div class="flex max-lg:flex-col justify-between mt-4">
            <div x-show="startDate && endDate" class="flex items-center gap-3">
                <p class="text-sm text-muted-foreground">Dates sélectionnées:</p>
                <p class="text-sm font-medium">
                    <span x-text="formatDate(startDate)"></span> - <span x-text="formatDate(endDate)"></span>
                </p>
                <p class="font-bold text-primary">
                    <span x-text="formatPrice(calculateNights() * {{ $eventHall->prix }})"></span>
                </p>
            </div>
            <button 
                data-modal-target="default-modal" data-modal-toggle="default-modal"
                :disabled="!startDate || !endDate"
                :class="{'bg-primary hover:bg-primary/80': startDate && endDate, 'bg-muted-foreground cursor-not-allowed': !startDate || !endDate}"  
                @click="applyDates(); showReservationModal = true;"
                class="px-4 py-2 text-white transition-colors rounded-lg bg-primary hover:bg-primary/80 ml-auto">
                Réserver maintenant
            </button>
        </div>
    </div>
    
    <!-- Galerie d'images (desktop) -->
    @if($imagesCount === 1)
        {{-- Disposition pour 1 seule image --}}
        <div class="hidden gap-2 mb-8 md:grid">
            <div class="aspect-video">
                <img
                    src="{{ asset('storage/' . $validImages->first()) }}"
                    alt="{{ $eventHall->nom_salle }}"
                    class="object-cover w-full h-full rounded-lg"
                >
            </div>
        </div>
    @else
        {{-- Disposition pour plusieurs images --}}
        <div class="hidden mb-8 md:block">
            {{-- Image principale --}}
            <div class="w-full mb-2 aspect-[2/1]">
                <img
                    src="{{ asset('storage/' . $validImages->first()) }}"
                    alt="{{ $eventHall->nom_salle }}"
                    class="object-cover w-full h-full rounded-lg"
                >
            </div>
            
            {{-- Images secondaires en grid --}}
            @if($validImages->count() > 1)
                <div class="grid grid-cols-4 gap-2">
                    @foreach($validImages->skip(1)->take(4) as $idx => $image)
                        <div class="aspect-square">
                            <img
                                src="{{ asset('storage/' . $image) }}"
                                alt="{{ $eventHall->nom_salle }} – Vue {{ $idx + 1 }}"
                                class="object-cover w-full h-full rounded-lg"
                            >
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
    
    <!-- Carrousel d'images (mobile) -->
    <div class="mb-8 md:hidden h-[250px]">
        <div class="overflow-hidden rounded-lg swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach($validImages as $image)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $eventHall->nom_salle }}" class="object-cover w-full h-64">
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    
    <!-- Onglets interactifs -->
    <x-site.events.details.tabs :eventHall="$eventHall" />
    
    <!-- Carte Google Maps -->
    <x-site.events.details.map :eventHall="$eventHall" />
</div>