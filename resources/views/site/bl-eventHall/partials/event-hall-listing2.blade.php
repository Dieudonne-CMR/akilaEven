@php
    use App\Models\EventHall;
    
    // Calculer le nombre total de salles
    $totalEventHalls = $eventHalls->total();
@endphp

       
      <!-- Liste des salles de fêtes -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        @if($eventHalls->count() > 0)
            
                @foreach($eventHalls as $eventHall)
                  
                        <x-event-hall.card2
                        x-init="initCarousel('venue{{ $loop->iteration }}')"
                        class="overflow-hidden transition-all duration-300 bg-white shadow-md rounded-xl hover:shadow-lg" :eventHall="$eventHall" />
                    {{-- </div> --}}
                @endforeach
                     
        
         {{--    <!-- Pagination -->
            <div class="mt-4 pagination-wrap">
                {{ $eventHalls->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div> --}}
        @else
        <p>asss</p>
        @endif
        
    </div>
