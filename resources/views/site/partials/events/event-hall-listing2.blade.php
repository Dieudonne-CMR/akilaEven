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
            <div class="py-5 text-center bg-white rounded no-results">
                <i class="la la-search fa-3x text-muted"></i>
                <h3 class="mt-3">Aucune salle de fête trouvée</h3>
                <p class="text-muted">Veuillez modifier vos critères de recherche et réessayer.</p>
                <a href="{{ route('site.sallesfetes') }}" class="mt-3 btn btn-primary">
                    <i class="la la-redo"></i> Réinitialiser les filtres
                </a>
            </div>
        @endif
        
    </div>
