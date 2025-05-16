@props(['location'])

@php
    // Filtrer pour ne garder que les champs d'images remplis
    $validImages = collect(array_filter([$location->photo, $location->photo1, $location->photo2, $location->photo3]));
    
    // Nombre total d'images valides
    $imagesCount = $validImages->count();
    
    // Déterminer le libellé de tarification
    $pricingLabel = $location->type_logement === 'meublé' ? '/jour' : '/mois';
@endphp

<div class="order-2 w-full">
    <!-- En-tête avec titre, prix et caractéristiques -->
    <div class="flex flex-col justify-between gap-6 mb-6 md:flex-row md:items-start">
        <div>
            <div class="text-3xl flex flex-wrap items-center gap-4">
                <h1 class="font-bold">{{ $location->nom_location }}</h1>
                <span class="">/</span>
                <p class="font-bold text-primary">
                    {{ number_format($location->prix, 0, ',', ' ') }}<span> FCFA</span> 
                    <span class="text-sm font-normal text-muted-foreground">{{ $pricingLabel }}</span>
                </p>
            </div>
            
            <!-- Caractéristiques -->
            <div class="flex flex-wrap items-center gap-3 mt-3 text-sm location-subtitle">
                <span class="flex items-center">
                    <i data-lucide="building-2" class="size-4 mr-1 text-blue-500"></i> 
                    {{ $location->agence->nom_agence ?? 'Agence non spécifiée' }}
                </span>
                
                <span class="flex items-center">
                    <i class="size-4 mr-1 text-orange-500 fas fa-map-marker-alt"></i> 
                    {{ $location->ville->nom ?? 'Ville non spécifiée' }}, {{ $location->localisation ?? 'Localisation non spécifiée' }}
                </span>
                
                <span class="flex items-center">
                    <i class="size-4 mr-1 text-green-500 fas fa-home"></i>
                    {{ ucfirst($location->type_location) }}
                </span>
                
                <span class="flex items-center">
                    <i class="size-4 mr-1 text-purple-500 fas fa-vector-square"></i>
                    {{ number_format($location->area ?? 0) }} m²
                </span>
                
                <span class="flex items-center">
                    <i class="size-4 mr-1 text-pink-500 fas fa-bed"></i>
                    {{ ucfirst($location->type_logement) }}
                </span>
            </div>
        </div>
        
        <button 
            x-text="showCalendar ? 'Fermer' : 'Réserver'"
            @click="toggleCalendarView()"
            class="text-lg py-3 px-8 text-white transition-colors rounded-lg bg-primary hover:bg-primary/80">
        </button>
    </div>
    
    <!-- Calendrier inline (affiché/masqué uniquement pour type meublé) -->
    <div x-show="showCalendar && isRental" x-cloak class="p-4 mb-6 bg-white rounded-lg shadow-md">
        <h3 class="mb-2 text-lg font-semibold">Sélectionnez vos dates</h3>
        <div id="inline-calendar" class="w-full"></div>
        <div class="flex max-lg:flex-col justify-between mt-4">
            <div x-show="startDate && endDate" class="flex items-center gap-3">
                <p class="text-sm text-muted-foreground">Dates sélectionnées:</p>
                <p class="text-sm font-medium">
                    <span x-text="formatDate(startDate)"></span> - <span x-text="formatDate(endDate)"></span>
                </p>
                <p class="font-bold text-primary">
                    <span x-text="formatPrice(calculateNights() * {{ $location->prix }})"></span>
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
                    alt="{{ $location->nom_location }}"
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
                    alt="{{ $location->nom_location }}"
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
                                alt="{{ $location->nom_location }} – Vue {{ $idx + 1 }}"
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
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $location->nom_location }}" class="object-cover w-full h-64">
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    
    <!-- Onglets interactifs -->
    <x-site.locations.details.tabs :location="$location" />
    
    <!-- Carte Google Maps -->
    <x-site.locations.details.map :location="$location" />
</div> 