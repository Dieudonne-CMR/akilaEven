@props(['eventHall'])

@php
    // Les champs d'images
    $imageFields = ['photo', 'photo1', 'photo2', 'photo3', 'photo4'];
    
    // Filtrer pour ne garder que les champs d'images remplis
    $images = collect($imageFields)->filter(function($field) use ($eventHall) {
        return !empty($eventHall->$field);
    })->map(function($field) use ($eventHall) {
        return $eventHall->$field;
    });
   
    // Types d'événements avec leurs icônes et couleurs
    $eventTypeIcons = [
        'Mariage' => ['icon' => 'la-heart', 'color' => 'bg-danger'],
        'Anniversaire' => ['icon' => 'la-birthday-cake', 'color' => 'bg-success'],
        'Conférence' => ['icon' => 'la-microphone', 'color' => 'bg-primary'],
        'Séminaire' => ['icon' => 'la-chalkboard-teacher', 'color' => 'bg-info'],
        'Concert' => ['icon' => 'la-music', 'color' => 'bg-[#4c1d95]'],
        'Fête' => ['icon' => 'la-glass-cheers', 'color' => 'bg-warning'],
        'Gala' => ['icon' => 'la-star', 'color' => 'bg-dark'],
        'Cérémonie' => ['icon' => 'la-award', 'color' => 'bg-primary'],
        'Autre' => ['icon' => 'la-calendar-day', 'color' => 'bg-secondary']
    ];
    
    // Déterminer l'icône et la couleur pour cet événement
    $eventType = $eventHall->event_type ?? 'Autre';
    $eventIcon = $eventTypeIcons[$eventType]['icon'] ?? 'la-calendar-day';
    $eventColor = $eventTypeIcons[$eventType]['color'] ?? 'bg-secondary';
@endphp

<div class="mb-4 card event-hall-card">
    <div class="card-img">
        <!-- Carrousel d'images -->
        @if($images->count() > 0)
            <div class="owl-carousel event-hall-carousel position-relative">
                @foreach($images as $image)
                    <div class="item">
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $eventHall->nom_salle }}" class="img-fluid event-hall-img"/>
                    </div>
                @endforeach
            </div>
        @else
            <img src="{{ asset('assets_site/images_site/event_halls/event-halls-1.jpg') }}" alt="{{ $eventHall->nom_salle }}" class="img-fluid event-hall-img"/>
        @endif
        
        <!-- Badge de type d'événement -->
        <span class="event-type-badge {{ $eventColor }}">
            <i class="la {{ $eventIcon }}"></i> {{ $eventType }}
        </span>
    </div>
    
    <div class="card-body">
        <div class="flex-col w-full d-flex justify-content-between align-items-start">
            <div class="w-full" style="display:flex;justify-content:space-between;align-items:flex-start;">
                <div>
                     <!-- Nom de la salle -->
                    <h3 style="font-weight:600 !important" class="card-title">
                        <a href="{{ route('site.detailSallesfetes', $eventHall->id) }}">{{ $eventHall->nom_salle }}</a>
                    </h3>
                    
                    <!-- Nom de l'hôtel et localisation -->
                    <div class="card-location">
                        <i class="la la-building text-primary me-1"></i>
                        {{ $eventHall->hotel->nom_hotel ?? 'Hôtel non spécifié' }}
                    
                    
                    </div>
                </div>
                <div class="text-right price-info">
                    <span class="price">{{ number_format($eventHall->prix, 0, ',', ' ') }} FCFA</span>
                    <span  class="price-period">par jour</span>
                </div>
                
            </div>
            <div class="w-full" style="display:flex;justify-content:space-between;align-items:flex-start;" class="mt-2">
                <div> 
                    <i class="la la-map-marker text-danger me-1"></i> 
                    {{ $eventHall->ville->nom ?? 'Ville non spécifiée' }}, 
                    {{ strlen($eventHall->localisation ?? '') > 20 ? substr($eventHall->localisation, 0, 20) . '...' : $eventHall->localisation ?? 'Localisation non spécifiée' }}
                </div>
                <!-- Capacité -->
                <div class="">
                  
                  
                    <div>
                        <i class="la la-users me-1"></i>
                        <span>{{ number_format($eventHall->capacite) }} places</span>
                    </div>
                    
                  
                </div>
            </div>
            
        </div>
   
        <!-- Prix et lien de détails -->
        <div class="mt-3 d-flex justify-content-between align-items-center">
           
            
            <a style="" href="{{ route('site.detailSallesfetes', $eventHall->id) }}" class="w-full py-2 btn btn-primary">
                Voir les détails 
            </a>
        </div>
    </div>
</div>

<script>
    // Script pour initialiser le carrousel une fois que le DOM est chargé
    document.addEventListener('DOMContentLoaded', function() {
        $('.event-hall-carousel').owlCarousel({
            items: 1,
            loop: true,
            margin: 0,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            navText: [
                '<i class="la la-angle-left"></i>',
                '<i class="la la-angle-right"></i>'
            ]
        });
    });
</script>

<style>
    /* Styles pour la carte de salle de fête */
    .event-hall-card {
        /* transition: all 0.3s ease; */
        border: none;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
 /*    
    .event-hall-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
     */
    .event-hall-img {
        height: 250px;
        width: 100%;
        object-fit: cover;
    }
    
    .event-type-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 5px 10px;
        border-radius: 20px;
        color: white;
        font-size: 12px;
        font-weight: 600;
        z-index: 10;
    }
    
    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .card-title a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .card-title a:hover {
        color: #287dfa;
    }
    
    .card-location {
        font-size: 0.875rem;
        color: #666;
        margin-bottom: 10px;
    }
    
    .card-desc {
        font-size: 0.9rem;
        color: #555;
        line-height: 1.5;
    }
    
    .capacity-badge {
        background-color: #f8f9fa;
        border-radius: 4px;
        padding: 5px 10px;
        text-align: center;
        min-width: 70px;
    }
    
    .capacity-number {
        display: block;
        font-weight: 700;
        font-size: 1.1rem;
        color: #287dfa;
    }
    
    .capacity-text {
        display: block;
        font-size: 0.75rem;
        color: #666;
    }
    
    .price-info {
        display: flex;
        flex-direction: column;
    }
    
    .price {
        font-weight: 600;
        font-size: 1rem;
        color: #333;
    }
    
    .price-period {
        
        color: #666;
        font-size: 0.75rem;
        line-height: 1rem;
    }
    
    /* Personnalisation du carrousel */
    .owl-nav button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        background-color: rgba(255,255,255,0.7) !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center;
        justify-content: center;
    }
    
    .owl-nav button.owl-prev {
        left: 10px;
    }
    
    .owl-nav button.owl-next {
        right: 10px;
    }
    
    .owl-dots {
        position: absolute;
        bottom: 10px;
        left: 0;
        right: 0;
        text-align: center;
    }
    
    .owl-dots .owl-dot span {
        background-color: rgba(255,255,255,0.5);
    }
    
    .owl-dots .owl-dot.active span {
        background-color: #287dfa;
    }
</style> 