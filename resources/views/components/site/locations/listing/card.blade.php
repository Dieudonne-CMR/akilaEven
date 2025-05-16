@props(['location', 'index'])

<div {{ $attributes }}>
    <!-- Slider d'images -->
    <div class="relative h-48 overflow-hidden bg-gray-200 rounded-t-xl">
        <!-- Type de logement (Badge) -->
        <div class="absolute z-10 px-3 py-1 text-xs font-semibold text-white rounded-full right-3 top-3 bg-primary">
            {{ ucfirst($location->type_logement) }}
        </div>

        @php
            $photos = [$location->photo, $location->photo1, $location->photo2, $location->photo3];
            $photos = array_filter($photos); // Supprimer les valeurs nulles
            $hasMultipleImages = count($photos) > 1;
        @endphp

        @if(count($photos) > 0)
            @if($hasMultipleImages)
                <div class="swiper location-swiper-{{ $index }} h-48">
                    <div class="swiper-wrapper">
                        @foreach($photos as $photo)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $photo) }}" 
                                    alt="{{ $location->nom_location }}" 
                                    class="object-cover w-full h-48"/>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            @else
                <div class="h-48">
                    <img src="{{ asset('storage/' . $photos[0]) }}" 
                        alt="{{ $location->nom_location }}" 
                        class="object-cover w-full h-full"/>
                </div>
            @endif
        @else
            <div class="flex items-center justify-center w-full h-full bg-gray-200">
                <i data-lucide="image" class="w-12 h-12 text-gray-400"></i>
            </div>
        @endif
    </div>
    
    <!-- Contenu -->
    <div class="p-4">
        <!-- Titre et prix -->
        <div class="flex items-start justify-between mb-2">
            <h3 class="text-lg font-semibold">
                <a href="{{ route('site.detail-locations', $location) }}" class="hover:text-primary">
                    {{ $location->nom_location }}
                </a>
            </h3>
            <div class="flex flex-col items-end">
                <span class="text-lg font-bold text-primary">{{ number_format($location->prix, 0, ',', ' ') }} FCFA</span>
                <span class="text-xs text-gray-500">
                    @if($location->type_logement === 'meublé')
                        /jour
                    @else
                        /mois
                    @endif
                </span>
            </div>
        </div>
        
        <!-- Type et localisation -->
        <div class="flex flex-wrap items-center mb-3 text-sm gap-x-2">
            <span class="px-2 py-1 text-xs font-medium text-primary bg-primary/10 rounded-md">
                {{ ucfirst($location->type_location) }}
            </span>
            
            
                <span class="flex items-center">
                    <i data-lucide="map-pin" class="size-4 mr-1 text-orange-500 flex-shrink-0"></i>
                    {{ $location->ville->nom }}, {{ $location->localisation }}
                </span>
           
        </div>
        
        <!-- Caractéristiques -->
        <div class="grid grid-cols-2 gap-2 py-3 mb-3 text-sm border-t">
            <!-- Surface -->
            <div class="flex items-center">
                <i data-lucide="square" class="w-4 h-4 mr-2 text-green-500"></i>
                <span>{{ $location->area }} m²</span>
            </div>
            
            <!-- Équipements -->
            @if(is_array($location->equipments) && count($location->equipments) > 0)
                <div class="flex items-center">
                    <i data-lucide="check-square" class="w-4 h-4 mr-2 text-gray-500"></i>
                    <span>{{ count($location->equipments) }} équipement(s)</span>
                </div>
            @endif
            
            <!-- Agence -->
            @if($location->agence)
                <div class="flex items-center col-span-2">
                    <i data-lucide="building2" class="w-4 h-4 mr-2 text-blue-500"></i>
                    <span>{{ $location->agence->nom_agence }}</span>
                </div>
            @endif
        </div>
        
        <!-- Actions -->
        <div class="flex items-center justify-between">
            <a href="{{ route('site.detail-locations', $location) }}"   class="flex items-center justify-center w-full p-2 text-white transition-colors rounded-lg bg-primary hover:bg-primary/80">
                Voir les détails
                
            </a>
            
       
        </div>
    </div>
</div>