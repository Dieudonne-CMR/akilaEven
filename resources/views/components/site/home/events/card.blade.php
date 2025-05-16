@props(['eventHall', 'index'])

<div {{ $attributes->merge(['class' => ' bg-white rounded-lg shadow-md']) }}>
    <!-- Utilisation du composant carousel pour les images -->
    <x-site.home.events.card-carousel :eventHall="$eventHall" :index="$index" />
    
    <!-- Informations de la salle -->
    <div class="p-4 text-card-foreground">
        <div class="flex flex-col items-center mb-4 text-center">
            <h3 class="text-xl font-bold">{{ $eventHall->nom_salle }}</h3>
        </div>
        
        <!-- Caractéristiques -->
        <div class="grid grid-cols-1 gap-2 text-sm md:grid-cols-2">
            <div class="flex items-center text-muted-foreground">
                <i class="mr-2 text-blue-500 size-4" data-lucide="building2"></i>
                <span>{{ $eventHall->agence->nom_agence ?? 'Agence non spécifiée' }}</span>
            </div>
            
            <div class="flex items-center text-muted-foreground">
                <i class="mr-2 text-orange-500 size-4" data-lucide="map-pinned"></i>
                <span>
                    {{ $eventHall->ville->nom ?? 'Ville non spécifiée' }},
                    {{ Str::limit($eventHall->localisation ?? 'Localisation non spécifiée', 20, '...') }}
                </span>
            </div>
            
            <div class="flex items-center text-muted-foreground">
                <i class="mr-2 text-green-500 size-4" data-lucide="users"></i>
                <span>{{ $eventHall->capacite }} places</span>
            </div>
            
            <!-- Types d'événements supportés -->
            @php
                $supportedEvents = $eventHall->event_type;
                $displayEvents = array_slice($supportedEvents, 0, 2);
                $remainingEvents = count($supportedEvents) - count($displayEvents);
            @endphp
            <div class="flex items-center text-muted-foreground">
                <i class="flex-shrink-0 mr-2 text-yellow-500 size-4" data-lucide="martini"></i>
                <span class="font-medium">
                    @foreach($displayEvents as $event)
                        {{ Str::lower(trim($event)) . 's' }}@if(!$loop->last), @endif
                    @endforeach
                    @if($remainingEvents > 0)
                        <span> , etc...</span>
                    @endif
                </span>
            </div>
        </div>
        
        <a href="{{ route('site.detailSallesfetes', $eventHall->id) }}" 
           class="flex items-center justify-center w-full p-2 mt-4 text-white transition-colors rounded-lg !bg-primary/80 hover:bg-primary">
            Voir les détails
        </a>
    </div>
</div>

