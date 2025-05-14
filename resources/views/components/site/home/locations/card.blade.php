@props(['location'])

<div {{ $attributes->merge(['class' => 'w-full overflow-hidden transition-all bg-white shadow-lg space-card rounded-xl']) }}>
    <!-- Image ou Carousel d'images -->
    <x-location.card-carousel :location="$location" />
    
    <!-- Informations de la location -->
    <div class="p-4 text-card-foreground">
        <div class="flex items-start justify-between mb-2">
            <div>
                <h3 class="text-lg font-bold">{{ $location->nom_location }}</h3>               
            </div>
            <span class="text-sm text-gray-500">{{ $location->agence->nom_agence }}</span>
        </div>
        
        <!-- Description avec limite de 3 lignes -->
        <p class="mb-3 text-sm text-gray-600 line-clamp-3">{{ $location->description_location }}</p>
        
        <div class="flex flex-wrap justify-between gap-3 mb-4">
            <div class="flex items-center text-sm text-muted-foreground">
                <i data-lucide="home" class="mr-1 !text-primary size-4"></i>
                <span>{{ ucfirst($location->type_location) }}, {{ ucfirst($location->type_logement) }}</span>
            </div>
            <div class="flex items-center text-sm text-muted-foreground">
                <i class="mr-1 !text-primary size-4" data-lucide="map-pinned"></i>
                <span>                    
                    {{ $location->ville->nom }}, {{ Str::limit($location->localisation, 20, '...') }}                      
                </span>
            </div>
        </div>
        
        <!-- Équipements -->
        <div class="flex flex-wrap gap-2 mb-4">
            @php
                $equipments = $location->equipments ?? [];
                $displayedEquipments = array_slice($equipments, 0, 3);
                $remainingCount = count($equipments) - 3;
            @endphp
            
            @foreach($displayedEquipments as $equipment)
                <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-md">{{ $equipment }}</span>
            @endforeach
            
            @if($remainingCount > 0)
                <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-md">+{{ $remainingCount }}</span>
            @endif
        </div>
        
        <a href="{{ route('site.detailLocation', $location->id) }}" class="flex items-center justify-center w-full h-full px-2 py-2 text-white transition-colors rounded-lg !bg-primary/80 hover:bg-primary">
            Voir les détails
        </a>
    </div>
</div> 