@props(['eventHall'])

@php
    use App\Helpers\EventTypeHelper;
    // Les champs d'images
    $imageFields = ['photo', 'photo1', 'photo2', 'photo3', 'photo4'];
    
    // Filtrer pour ne garder que les champs d'images remplis
    $images = collect($imageFields)->filter(function($field) use ($eventHall) {
        return !empty($eventHall->$field);
    })->map(function($field) use ($eventHall) {
        return $eventHall->$field;
    });
    
    // Vérifier s'il y a plusieurs images pour afficher un carrousel
    $hasMultipleImages = $images->count() > 1;
   
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
    /* font-weight: bold; */
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
                                 alt="{{ $eventHall->nom_salle }}" 
                                 class="object-cover w-full h-72">
                        </div>
                    @endforeach
                </div>
                <!-- Pagination -->
               {{--  <div class="swiper-pagination"></div> --}}
                <!-- Navigation -->
                <div  class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
           
        @else
            <!-- Image unique -->
            <img src="{{ asset('storage/' . $images->first()) }}" 
                 alt="{{ $eventHall->nom_salle }}" 
                 class="object-cover w-full h-72">
        @endif
        
        <!-- Badge de type d'événement -->
       {{--  <span class="z-10 absolute top-[15px] left-[15px] text-white text-xs font-medium me-2 px-2 py-1.5 rounded-full {{ $eventColor }} "> <i class="la {{ $eventIcon }}"></i> {{ $eventType }}</span>  --}}
        
        <!-- Badge de prix -->
        <div class="z-10 absolute px-3 py-1 text-sm font-semibold text-white rounded-full top-4 right-4 !bg-primary">
            {{ number_format($eventHall->prix, 0, ',', ' ') }}<span> FCFA</span><span class="text-sm font-normal text-white/80">/jour</span>
        </div>
    @endif
    {{--     <!-- Image par défaut si aucune image n'est disponible -->
        <img src="{{ asset('img/default-hall.jpg') }}" 
             alt="{{ $eventHall->nom_salle }}" 
             class="object-cover w-full h-72">
    @endif --}}
</div> 
