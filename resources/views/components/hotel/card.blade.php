@props(['hotel'])

<div class="h-full overflow-hidden bg-white hotel-card rounded-xl">
    <div class="relative">
        <!-- Image principale (logo ou bannière) -->
        @if($hotel->logo)
            <img src="{{ asset('storage/' . $hotel->logo) }}" alt="{{ $hotel->nom_hotel }}" class="object-cover w-full h-64">
        @elseif($hotel->bannier1)
            <img src="{{ asset('storage/' . $hotel->bannier1) }}" alt="{{ $hotel->nom_hotel }}" class="object-cover w-full h-64">
        @else
            <img src="{{ asset('img/default-hotel.jpg') }}" alt="{{ $hotel->nom_hotel }}" class="object-cover w-full h-64">
        @endif
        
        <!-- Badge matricule si présent -->
        @if($hotel->matricule_hotel)
            <div class="absolute px-3 py-1 text-sm font-semibold text-gray-800 bg-white rounded-full top-4 right-4">
                {{ $hotel->matricule_hotel }}
            </div>
        @endif
    </div>
    
    <div class="p-6">
        <div class="flex items-start justify-between mb-2">
            <h3 class="text-xl font-bold text-gray-900">{{ $hotel->nom_hotel }}</h3>
        </div>
        
        <p class="mb-4 text-gray-600">{{ Str::limit($hotel->description_hotel, 100) }}</p>
        
        <div class="flex items-center mb-4 text-sm text-gray-500">
            <i class="mr-2 text-red-500 fas fa-map-marker-alt"></i>
            <!-- Formater l'emplacement: ville, localisation -->
            <span>
                @if($hotel->ville)
                    {{ $hotel->ville }}
                    @if($hotel->localisation)
                        , {{ $hotel->localisation }}
                    @endif
                @elseif($hotel->localisation)
                    {{ $hotel->localisation }}
                @else
                    Emplacement non spécifié
                @endif
            </span>
        </div>
        
        <div class="flex items-center justify-between">
            <div class="flex space-x-2">
                @if(!empty($hotel->services) && is_array($hotel->services))
                    @php $serviceCount = count($hotel->services); @endphp
                    <!-- Afficher les 3 premiers services -->
                    @foreach(array_slice($hotel->services, 0, 3) as $index => $service)
                        <span class="px-2 py-1 text-xs {{ getServiceClass($index) }}">{{ $service }}</span>
                    @endforeach
                    
                    <!-- Badge pour les services supplémentaires -->
                    @if($serviceCount > 3)
                        <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-md">+{{ $serviceCount - 3 }}</span>
                    @endif
                @else
                    <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-md">Services non spécifiés</span>
                @endif
            </div>
            <a href="#" class="px-4 py-2 font-medium text-white rounded-md bg-primary hover:bg-primary/80">Consulter</a>
        </div>
    </div>
</div>

@php
    // Helper function pour les classes CSS des services si elle n'existe pas déjà ailleurs
    if (!function_exists('getServiceClass')) {
        function getServiceClass($index) {
            $classes = [
                'text-blue-800 bg-blue-100 rounded-md',
                'text-green-800 bg-green-100 rounded-md',
                'text-purple-800 bg-purple-100 rounded-md'
            ];
            return $classes[$index % count($classes)];
        }
    }
@endphp 