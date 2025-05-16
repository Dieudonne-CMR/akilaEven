@php
    use App\Models\EventHall;
    
    // Calculer le nombre total de salles
    $totalEventHalls = $eventHalls->total();
@endphp

       
      <!-- Liste des salles de fêtes -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        @if($eventHalls->count() > 0)
            
                @foreach($eventHalls as $eventHall)
                  
                        <x-site.events.listing.card2
                        :index="$loop->iteration"
                        x-init="initCarousel('venue{{ $loop->iteration }}')"
                        class="overflow-hidden transition-all duration-300 bg-white shadow-md rounded-xl hover:shadow-lg" :eventHall="$eventHall" />
                    {{-- </div> --}}
                @endforeach
                     
    
        @else
        <x-ui.empty-state 
        class="px-6 py-5 !bg-white shadow-md no-results col-span-full rounded-xl "
        icon="file-question"
        classIcon="!text-primary"
        title="Aucune salle de fête trouvée"
        message="Veuillez modifier vos critères de recherche et réessayer."
    >
        <a href="{{ route('site.sallesfetes') }}" class="mt-3 btn btn-primary bg-primary">
            <i class="la la-redo"></i> Réinitialiser les filtres
        </a>
    </x-ui.empty-state>
        @endif
        
    </div>


@push('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser les carrousels Swiper
        document.querySelectorAll('.swiper').forEach(function(element, index) {
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
