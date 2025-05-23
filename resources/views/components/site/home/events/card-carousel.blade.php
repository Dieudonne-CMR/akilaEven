@props(['eventHall', 'index'])

@php
    use App\Helpers\EventTypeHelper;
    // Les champs d'images
    $imageFields = ['photo', 'photo1', 'photo2', 'photo3', 'photo4'];
    
    // Filtrer pour ne garder que les champs d'images remplis
    $validImages = collect(array_filter([$eventHall->photo, $eventHall->photo1, $eventHall->photo2, $eventHall->photo3, $eventHall->photo4]));
    
    // Vérifier s'il y a plusieurs images pour afficher un carrousel
    $hasMultipleImages = $validImages->count() > 1;
   
@endphp

<div class="relative">
    @if($validImages->count() > 0)
        @if($hasMultipleImages)
            <div data-breakpoints="0" class="swiper  venue-swiper-{{ $index }} h-48">
                <div class="swiper-wrapper">
                    @foreach($validImages as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $image) }}" 
                                alt="{{ $eventHall->nom_salle }}" 
                                class="object-cover w-full h-48"/>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        @else
            <div class="h-48">
                <img src="{{ asset('storage/' . $validImages->first()) }}" 
                    alt="{{ $eventHall->nom_salle }}" 
                    class="object-cover w-full h-full"/>
            </div>
        @endif
    @endif
    
    <!-- Badge de prix -->
    <div class="z-100 absolute px-3 py-1 text-xs font-semibold text-white rounded-full top-3 right-3 !bg-primary">
        {{ number_format($eventHall->prix, 0, ',', ' ') }} FCFA/jour
    </div>
</div> 
