@props(['hotel'])

<div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
    <h2 class="flex items-center mb-4 text-xl font-bold text-gray-900 dark:text-white">
        <i data-lucide="info" class="w-5 h-5 mr-2 text-blue-600"></i>
        Détails de l'hôtel
    </h2>
    
    <div class="mb-6">
        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">{{ $hotel->nom_hotel }}</h3>
        <div class="mb-4 prose text-gray-700 dark:text-gray-300 max-w-none">
            {!! nl2br(e($hotel->description_hotel)) !!}
        </div>
        
        @if($hotel->services)
            @hotelServices($hotel->services)
        @endif
    </div>
    
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        @if($hotel->telephone)
        <div class="flex items-center">
            <i data-lucide="phone" class="w-5 h-5 mr-2 text-blue-600"></i>
            <span class="text-gray-700 dark:text-gray-300">{{ $hotel->telephone }}</span>
        </div>
        @endif
        
        @if($hotel->email)
        <div class="flex items-center">
            <i data-lucide="mail" class="w-5 h-5 mr-2 text-blue-600"></i>
            <span class="text-gray-700 dark:text-gray-300">{{ $hotel->email }}</span>
        </div>
        @endif
        
        <div class="flex items-center">
            <i data-lucide="map-pin" class="w-5 h-5 mr-2 text-blue-600"></i>
            <span class="text-gray-700 dark:text-gray-300">{{ $hotel->ville }}, {{ $hotel->localisation }}</span>
        </div>
        
        @if($hotel->matricule_hotel)
        <div class="flex items-center">
            <i data-lucide="hash" class="w-5 h-5 mr-2 text-blue-600"></i>
            <span class="text-gray-700 dark:text-gray-300">{{ $hotel->matricule_hotel }}</span>
        </div>
        @endif
    </div>
</div> 