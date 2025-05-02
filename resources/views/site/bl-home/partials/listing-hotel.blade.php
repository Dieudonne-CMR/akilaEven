@php
    use App\Models\Hotel;
    use App\Models\Bookings;

    // Récupérer les 10 hôtels avec le plus de réservations au statut "completed"
    $popularHotels = Hotel::select('hotels.*')
        ->take(10)
        ->get();
@endphp

<section class="py-4" x-data="hotelListing()">
    <div class="mx-auto max-w-7xl">
        <div class="mb-12 text-center">
            <h1 class="mb-4 text-3xl font-bold !text-primary sm:text-4xl">Hôtels à la une</h1>
            <p class="max-w-2xl mx-auto text-lg text-muted-foreground">Découvrez une sélection d'hôtels et de complexes hôteliers de luxe pour votre prochaine escapade.</p>
        </div>
    </div>
    
    <!-- Swiper -->
    <div class="swiper hotel-swiper" data-autoplay="false">
        <div class="swiper-wrapper">
            <!-- Boucle sur les hôtels -->
            @forelse($popularHotels as $hotel)
                <div class="swiper-slide">
                    <x-hotel.card :hotel="$hotel" />
                </div>
            @empty
                <div class="w-full p-8 text-center col-span-full">
                    <p class="text-lg text-muted-foreground">Aucun hôtel disponible actuellement.</p>
                </div>
            @endforelse
        </div>
        
        <!-- Add Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</section>


