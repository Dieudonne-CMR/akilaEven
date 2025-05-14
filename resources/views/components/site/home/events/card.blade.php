@props(['eventHall'])

<div {{ $attributes->merge(['class' => 'w-full overflow-hidden transition-all bg-white shadow-lg space-card rounded-xl']) }}>
    <!-- Utilisation du composant carousel pour les images -->
    <x-site.home.events.card-carousel :eventHall="$eventHall" />
    
    <!-- Informations de la salle -->
    <div class="p-4 text-card-foreground">
        <div class="flex items-start justify-between mb-2">
            <div>
                <h3 class="text-lg font-bold">{{ $eventHall->nom_salle }}</h3>               
            </div>
            
        </div>
        
        <div class="flex flex-wrap justify-between gap-3 mb-4">
            <div class="flex items-center text-sm text-muted-foreground">
                <i data-lucide="agence" class="mr-1 !text-primary size-4"></i>
                <span>{{ $eventHall->agence->nom_agence}}</span>
            </div>
            <div class="flex items-center text-sm text-muted-foreground">
                <i class="mr-1 !text-primary size-4" data-lucide="map-pinned"></i>
                <span>                    
                    {{$eventHall->ville->nom }},{{ Str::limit($eventHall->localisation, 20, '...') }}                      
                </span>
            </div>
            <div class="flex items-center text-sm text-muted-foreground">
                <i class=""mr-1 size-4 fas fa-users !text-primary"></i>                
                <span>Jusqu'à {{ $eventHall->capacite }} pers.</span>
            </div>
            <div class="flex items-center text-sm text-muted-foreground">
                <i class=""mr-1 size-4 fas fa-users !text-primary"></i>                
                <span>{{ $eventHall->area }} m2 space</span>
            </div>
        </div>
        
        <a href="{{ route('site.detailSallesfetes', $eventHall->id) }}" class="flex items-center justify-center w-full h-full px-2 py-2 text-white transition-colors rounded-lg !bg-primary/80 hover:bg-primary ">
            Voir les détails
        </a>
    </div>
</div>

