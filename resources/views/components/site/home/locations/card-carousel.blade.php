@props(['location'])

@php
    // Les champs d'images
    $imageFields = ['photo', 'photo1', 'photo2', 'photo3'];
    
    // Filtrer pour ne garder que les champs d'images remplis
    $images = collect($imageFields)->filter(function($field) use ($location) {
        return !empty($location->$field);
    })->map(function($field) use ($location) {
        return $location->$field;
    });
    
    // Vérifier s'il y a plusieurs images pour afficher un carrousel
    $hasMultipleImages = $images->count() > 1;
    
    // Déterminer le prix d'affichage et son format selon le type de logement
    if ($location->type_logement === 'meublé') {
        $priceSuffix = '/jour';
    } else {
        $priceSuffix = '/mois';
    }
@endphp

<style>
.swiper-button-next,
.swiper-button-prev {    
    height: 30px !important;
    width: 30px !important;    
}

.swiper-button-next:after,
.swiper-button-prev:after {
    font-size: 10px !important;
}
</style>

<div class="relative">
    @if($images->count() > 0)
        @if($hasMultipleImages)
            <!-- Carrousel Swiper pour plusieurs images -->
            <div class="swiper h-72" data-breakpoints="0">
                <div class="swiper-wrapper">
                    @foreach($images as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $image) }}" 
                                 alt="{{ $location->nom_location }}" 
                                 class="object-cover w-full h-72">
                        </div>
                    @endforeach
                </div>
                <!-- Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        @else
            <!-- Image unique -->
            <img src="{{ asset('storage/' . $images->first()) }}" 
                 alt="{{ $location->nom_location }}" 
                 class="object-cover w-full h-72">
        @endif
        
        <!-- Badge de prix -->
        <div class="absolute px-3 py-1 text-sm font-semibold text-white rounded-full top-4 right-4 !bg-primary">
            {{ number_format($location->prix, 0, ',', ' ') }}<span> FCFA</span><span class="text-sm font-normal text-white/80">{{ $priceSuffix }}</span>
        </div>
        
        <!-- Badge de type de location -->
        <div class="absolute flex items-center gap-1 px-3 py-1 text-sm font-semibold rounded-full top-4 left-4 bg-white/90 !text-primary">
            <i data-lucide="home" class="size-4"></i> {{ ucfirst($location->type_location) }}
        </div>
    @else
        <!-- Image par défaut si aucune image n'est disponible -->
        <img src="{{ asset('assets_site/images_site/locations/default-location.jpg') }}" 
             alt="{{ $location->nom_location }}" 
             class="object-cover w-full h-72">
    @endif
</div> 