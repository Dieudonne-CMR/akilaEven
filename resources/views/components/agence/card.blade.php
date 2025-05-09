@props(['agence'])

<div class="h-full overflow-hidden bg-white agence-card rounded-xl">
    <div class="relative">
        <!-- Image principale (logo ou bannière) -->
        @if($agence->logo)
            <img src="{{ asset('storage/' . $agence->logo) }}" alt="{{ $agence->nom_agence }}" class="object-cover w-full h-64">
        @elseif($agence->bannier1)
            <img src="{{ asset('storage/' . $agence->bannier1) }}" alt="{{ $agence->nom_agence }}" class="object-cover w-full h-64">
        @else
            <img src="{{ asset('img/default-agence.jpg') }}" alt="{{ $agence->nom_agence }}" class="object-cover w-full h-64">
        @endif
        
        <!-- Badge matricule si présent -->
        @if($agence->matricule_agence)
            <div class="absolute px-3 py-1 text-sm font-semibold text-gray-800 bg-white rounded-full top-4 right-4">
                {{ $agence->matricule_agence }}
            </div>
        @endif
    </div>
    
    <div class="p-6">
        <div class="flex items-start justify-between mb-2">
            <h3 class="text-xl font-bold text-gray-900">{{ $agence->nom_agence }}</h3>
        </div>
        
        <p class="mb-4 text-gray-600">{{ Str::limit($agence->description_agence, 100) }}</p>
        
        <div class="flex items-center mb-4 text-sm text-gray-500">
            <i class="mr-2 text-red-500 fas fa-map-marker-alt"></i>
            <!-- Formater l'emplacement: ville, localisation -->
            <span>
                @if($agence->ville)
                    {{ $agence->ville }}
                    @if($agence->localisation)
                        , {{ $agence->localisation }}
                    @endif
                @elseif($agence->localisation)
                    {{ $agence->localisation }}
                @else
                    Emplacement non spécifié
                @endif
            </span>
        </div>
        
        <div class="flex items-center justify-between">
            <div class="flex space-x-2">
                @if(!empty($agence->services) && is_array($agence->services))
                    @php $serviceCount = count($agence->services); @endphp
                    <!-- Afficher les 3 premiers services -->
                    @foreach(array_slice($agence->services, 0, 3) as $index => $service)
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