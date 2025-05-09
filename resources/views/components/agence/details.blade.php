@props(['agence'])

<div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
    <h2 class="flex items-center mb-4 text-xl font-bold text-gray-900 dark:text-white">
        <i data-lucide="info" class="w-5 h-5 mr-2 text-blue-600"></i>
        Détails de l'agence
    </h2>
    
    <div class="mb-6">
        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">{{ $agence->nom_agence }}</h3>
        <div class="mb-4 prose text-gray-700 dark:text-gray-300 max-w-none">
            {!! nl2br(e($agence->description_agence)) !!}
        </div>
        
        @if($agence->services)
            @agenceServices($agence->services)
        @endif
    </div>
    
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        @if($agence->telephone)
        <div class="flex items-center">
            <i data-lucide="phone" class="w-5 h-5 mr-2 text-blue-600"></i>
            <span class="text-gray-700 dark:text-gray-300">{{ $agence->telephone }}</span>
        </div>
        @endif
        
        @if($agence->email)
        <div class="flex items-center">
            <i data-lucide="mail" class="w-5 h-5 mr-2 text-blue-600"></i>
            <span class="text-gray-700 dark:text-gray-300">{{ $agence->email }}</span>
        </div>
        @endif
        
        <div class="flex items-center">
            <i data-lucide="map-pin" class="w-5 h-5 mr-2 text-blue-600"></i>
            <span class="text-gray-700 dark:text-gray-300">{{ $agence->ville }}, {{ $agence->localisation }}</span>
        </div>
        
        @if($agence->matricule_agence)
        <div class="flex items-center">
            <i data-lucide="hash" class="w-5 h-5 mr-2 text-blue-600"></i>
            <span class="text-gray-700 dark:text-gray-300">{{ $agence->matricule_agence }}</span>
        </div>
        @endif
    </div>
</div> 