@props(['agence', 'updateLogoRoute'])

<div class="absolute bottom-0 left-0 right-0 z-50 p-6 bg-linear-to-t from-black/80 to-transparent profile-overlay">
    <div class="container flex flex-col items-end justify-between mx-auto md:flex-row md:items-center">
        <div class="flex items-center mb-4 md:mb-0">
            <div class="w-20 h-20 overflow-hidden bg-white border-4 border-white rounded-full shadow-lg md:w-24 md:h-24">
                @if($agence->logo)
                    <img src="{{ asset('storage/' . $agence->logo) }}" 
                        alt="Logo de {{ $agence->nom_agence }}" 
                        class="object-cover w-full h-full">
                @else
                    <div class="flex items-center justify-center w-full h-full text-xl font-bold text-blue-600 bg-blue-100">
                        @avatarBadge($agence->nom_agence)
                    </div>
                @endif
            </div>
            <div class="ml-4">
                <h1 class="text-2xl font-bold text-white md:text-3xl">{{ $agence->nom_agence }}</h1>
                <div class="flex flex-col sm:flex-row sm:items-center mt-1">
                    @if($agence->telephone)
                        <div class="flex items-center">
                            <i data-lucide="phone" class="text-white size-4"></i>
                            <span class="ml-1 text-white">{{ $agence->telephone }}</span>
                        </div>
                        <span class="hidden mx-2 text-white sm:block">•</span>
                    @endif
                    <span class="flex items-center text-white">
                        <i data-lucide="map-pin" class="mr-1 size-4"></i>
                        {{ $agence->ville }}, {{ $agence->localisation }}
                    </span>
                </div>
            </div>
        </div>
        <div class="flex space-x-2">
            <button 
                type="button" 
                class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300"
                data-modal-target="update-media-modal"
                data-modal-toggle="update-media-modal"
            >
                <i data-lucide="image" class="w-4 h-4 mr-2"></i>
                Mettre à jour les médias
            </button>
        </div>
    </div>
</div> 