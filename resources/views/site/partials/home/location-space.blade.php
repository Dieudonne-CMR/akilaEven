@php
    use App\Models\Location;
    
    // Récupérer les locations
    $popularLocations = Location::with(['agence', 'ville'])->get();
    $displayCarousel = $popularLocations->count() > 3;
@endphp

<style>
.swiper-button-next,
.swiper-button-prev {
    background: white;
    border-radius: 50%;
    height: 50px !important;
    width: 50px !important;
    border-radius: 50%;
    box-shadow:
        0 4px 6px -1px rgba(0, 0, 0, 0.1),
        0 2px 4px -1px rgba(0, 0, 0, 0.06);
    color: #4b5563 !important;
    transition: all 0.3s ease;
}
.swiper-button-next:after,
.swiper-button-prev:after {
    font-size: 15px !important;
}
.swiper-button-prev{
  left: 3px;
}
.swiper-button-next{
  right: 3px;
}
</style>

<div x-data="locationSpaceComponent()">
  <div class="flex items-center justify-between mb-8">
      <h3 class="pl-4 text-2xl font-bold border-l-4 heading !border-primary">Locations</h3>
      <a href="{{ route('site.locations') }}" class="group flex items-center gap-2 font-medium !text-primary/80 hover:!text-primary">
          Voir toutes les locations <i data-lucide="arrow-right" class="transition-all size-4 group-hover:translate-x-1"></i>
      </a>
  </div>

  @if($popularLocations->isEmpty())
    <div class="w-full p-8 text-center">
        <p class="text-lg text-muted-foreground">Aucune location n'est disponible actuellement.</p>
    </div>
  @elseif($displayCarousel)
    <div class="!py-4 swiper location-swiper" data-space-between="20" data-autoplay="true">
        <div class="swiper-wrapper">
            @foreach($popularLocations as $index => $location)
                <div class="swiper-slide">
                    <div class="overflow-hidden bg-white rounded-lg shadow-md">
                        <!-- Image fixe ou carrousel selon le nombre d'images -->
                        @php
                            $photos = [$location->photo, $location->photo1, $location->photo2, $location->photo3];
                            $photos = array_filter($photos); // Supprimer les valeurs nulles
                            $hasMultipleImages = count($photos) > 1;
                        @endphp

                        <div class="relative h-48 overflow-hidden bg-gray-200 rounded-t-xl">
                            <!-- Type de logement (Badge) -->
                            <div class="absolute z-10 px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded-full right-3 top-3">
                                {{ ucfirst($location->type_logement) }}
                            </div>
                            
                            <!-- Badge de prix -->
                            <div class="absolute z-10 px-3 py-1 text-xs font-semibold text-white bg-green-600 rounded-full left-3 top-3">
                                {{ number_format($location->prix, 0, ',', ' ') }} FCFA
                                <span class="text-xs">
                                    @if($location->type_logement === 'meublé')
                                        /jour
                                    @else
                                        /mois
                                    @endif
                                </span>
                            </div>

                            @if(count($photos) > 0)
                                @if($hasMultipleImages)
                                    <div data-breakpoints="0"  class="swiper location-swiper-{{ $index }} h-48">
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
                            <!-- Titre et type -->
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="text-lg font-semibold">
                                    {{ $location->nom_location }}
                                </h3>
                                <span class="px-2 py-1 text-xs font-medium rounded-md text-primary bg-primary/10">
                                    {{ ucfirst($location->type_location) }}
                                </span>
                            </div>
                            
                            <!-- Localisation -->
                            <div class="flex items-center mb-3 text-sm">
                                <i data-lucide="map-pin" class="flex-shrink-0 mr-1 text-orange-500 size-4"></i>
                                <span>{{ $location->ville->nom ?? 'Ville non spécifiée' }}, {{ $location->localisation ?? 'Localisation non spécifiée' }}</span>
                            </div>
                            
                            <!-- Caractéristiques -->
                            <div class="grid grid-cols-2 gap-2 py-3 mb-3 text-sm border-t">
                                <!-- Surface -->
                                <div class="flex items-center">
                                    <i data-lucide="square" class="w-4 h-4 mr-2 text-green-500"></i>
                                    <span>{{ $location->area ?? 'N/A' }} m²</span>
                                </div>
                                
                                <!-- Équipements -->
                                @if(isset($location->equipments) && is_array($location->equipments) && count($location->equipments) > 0)
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
                            <a href="{{ route('site.detail-locations', $location) }}" 
                               class="flex items-center justify-center w-full p-2 text-white transition-colors rounded-lg !bg-primary/80 hover:bg-primary">
                                Voir les détails
                            </a>
                        </div>
                    </div>
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
    <!-- Affichage en grille pour 3 locations ou moins -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach($popularLocations as $index => $location)
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                <!-- Image fixe ou carrousel selon le nombre d'images -->
                @php
                    $photos = [$location->photo, $location->photo1, $location->photo2, $location->photo3];
                    $photos = array_filter($photos); // Supprimer les valeurs nulles
                    $hasMultipleImages = count($photos) > 1;
                @endphp

                <div class="relative h-48 overflow-hidden bg-gray-200 rounded-t-xl">
                    <!-- Type de logement (Badge) -->
                    <div class="absolute z-10 px-3 py-1 text-xs font-semibold text-white rounded-full right-3 top-3 bg-primary">
                        {{ ucfirst($location->type_logement) }}
                    </div>
                    
                    <!-- Badge de prix -->
                    <div class="absolute z-10 px-3 py-1 text-xs font-semibold text-white bg-green-600 rounded-full left-3 top-3">
                        {{ number_format($location->prix, 0, ',', ' ') }} FCFA
                        <span class="text-xs">
                            @if($location->type_logement === 'meublé')
                                /jour
                            @else
                                /mois
                            @endif
                        </span>
                    </div>

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
                    <!-- Titre et type -->
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-lg font-semibold">
                            {{ $location->nom_location }}
                        </h3>
                        <span class="px-2 py-1 text-xs font-medium rounded-md text-primary bg-primary/10">
                            {{ ucfirst($location->type_location) }}
                        </span>
                    </div>
                    
                    <!-- Localisation -->
                    <div class="flex items-center mb-3 text-sm">
                        <i data-lucide="map-pin" class="flex-shrink-0 mr-1 text-orange-500 size-4"></i>
                        <span>{{ $location->ville->nom ?? 'Ville non spécifiée' }}, {{ $location->localisation ?? 'Localisation non spécifiée' }}</span>
                    </div>
                    
                    <!-- Caractéristiques -->
                    <div class="grid grid-cols-2 gap-2 py-3 mb-3 text-sm border-t">
                        <!-- Surface -->
                        <div class="flex items-center">
                            <i data-lucide="square" class="w-4 h-4 mr-2 text-green-500"></i>
                            <span>{{ $location->area ?? 'N/A' }} m²</span>
                        </div>
                        
                        <!-- Équipements -->
                        @if(isset($location->equipments) && is_array($location->equipments) && count($location->equipments) > 0)
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
                    <a href="{{ route('site.detail-locations', $location) }}" 
                       class="flex items-center justify-center w-full p-2 text-white transition-colors rounded-lg !bg-primary/80 !hover:bg-primary">
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
    Alpine.data('locationSpaceComponent', () => ({
      init() {
        // Initialisation des mini-sliders pour chaque location si nécessaire
        if (typeof Swiper !== 'undefined') {
          document.querySelectorAll('[class^="location-swiper-"]').forEach(el => {
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