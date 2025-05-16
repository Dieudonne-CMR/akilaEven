@php
    use App\Models\Location;
    
    // Calculer le nombre total de locations
    $totalLocations = $locations->total();
@endphp

<!-- Liste des locations -->
<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    @if($locations->count() > 0)
        @foreach($locations as $location)
            <x-site.locations.listing.card
                :index="$loop->iteration"
                class="overflow-hidden transition-all duration-300 bg-white shadow-md rounded-xl hover:shadow-lg" 
                :location="$location" 
            />
        @endforeach
    @else
        <x-ui.empty-state 
            class="px-6 py-5 !bg-white shadow-md no-results col-span-full rounded-xl"
            icon="file-question"
            classIcon="!text-primary"
            title="Aucune location trouvée"
            message="Veuillez modifier vos critères de recherche et réessayer."
        >
            <a href="{{ route('site.locations') }}" class="mt-3 btn btn-primary bg-primary/80 border-primary flex justify-center items-center rounded-lg px-3 py-2 hover:bg-primary text-white gap-2">
                <i class="size-4" data-lucide="rotate-ccw"></i> Réinitialiser les filtres
            </a>
        </x-ui.empty-state>
    @endif
</div>

<!-- Inclusion du CSS et du JS de Swiper -->
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<style>
    .swiper-pagination-bullet {
        width: 8px;
        height: 8px;
        background: white;
        opacity: 0.5;
    }
    .swiper-pagination-bullet-active {
        opacity: 1;
        background: white;
    }
    .swiper-button-next,
    .swiper-button-prev {
        color: white;
        background: rgba(0, 0, 0, 0.3);
        width: 35px;
        height: 35px;
        border-radius: 50%;
        --swiper-navigation-size: 20px;
    }
    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 16px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser les carrousels Swiper
        document.querySelectorAll('.location-swiper-1, .location-swiper-2, .location-swiper-3, .location-swiper-4').forEach(function(element) {
            const swiper = new Swiper(element, {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
            });
        });
    });
</script>
@endpush