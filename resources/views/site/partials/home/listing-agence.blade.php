@php
    use App\Models\Agence;
    use App\Models\Bookings;

    // Récupérer les 10 agences avec le plus de réservations au statut "completed"
    $popularAgences = Agence::select('agences.*')
        ->take(10)
        ->get();
@endphp

<section class="py-4" x-data="agenceListing()">
    <div class="mx-auto max-w-7xl">
        <div class="mb-12 text-center">
            <h1 class="mb-4 text-3xl font-bold !text-primary sm:text-4xl">Agences à la une</h1>
            <p class="max-w-2xl mx-auto text-lg text-muted-foreground">Découvrez une sélection d'agences et de complexes agenceiers de luxe pour votre prochaine escapade.</p>
        </div>
    </div>
    
    <!-- Swiper -->
    <div class="swiper agence-swiper" data-autoplay="false">
        <div class="swiper-wrapper">
            <!-- Boucle sur les agences -->
            @forelse($popularAgences as $agence)
                <div class="swiper-slide">
                    <x-agence.card :agence="$agence" />
                </div>
            @empty
                <div class="w-full p-8 text-center col-span-full">
                    <p class="text-lg text-muted-foreground">Aucun agence disponible actuellement.</p>
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


