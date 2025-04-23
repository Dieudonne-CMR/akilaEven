@props(['eventHall'])

@php
    use App\Helpers\EventTypeHelper;
    
    // Les champs d'images
    $imageFields = ['photo', 'photo1', 'photo2', 'photo3', 'photo4'];
    
    // Filtrer pour ne garder que les champs d'images remplis
    $images = collect($imageFields)->filter(function($field) use ($eventHall) {
        return !empty($eventHall->$field);
    })->map(function($field) use ($eventHall) {
        return $eventHall->$field;
    });
   var_dump($images);
    // Types d'événements avec leurs icônes et couleurs
    $eventTypeIcons = EventTypeHelper::getEventTypeIcons();
    
    // Déterminer l'icône et la couleur pour cet événement
    $eventType = $eventHall->event_type ?? 'Autre';
    $eventIcon = $eventTypeIcons[$eventType]['icon'] ?? 'la-calendar-day';
    $eventColor = $eventTypeIcons[$eventType]['color'] ?? 'bg-secondary';
    
    // Vérifier s'il y a plusieurs images pour afficher un carrousel
    $hasMultipleImages = $images->count() > 1;
@endphp

<div class="card event-hall-card">
    <div class="card-img">
        <!-- Image fixe ou carrousel selon le nombre d'images -->
        @if($images->count() > 0)
            @if($hasMultipleImages)
                <div class="owl-carousel event-hall-carousel position-relative">
                    @foreach($images as $image)
                        <div class="item">
                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $eventHall->nom_salle }}" class="img-fluid event-hall-img"/>
                        </div>
                    @endforeach
                </div>
            @else
                <img src="{{ asset('storage/' . $images->first()) }}" alt="{{ $eventHall->nom_salle }}" class="img-fluid event-hall-img"/>
            @endif
        @else
            <img src="{{ asset('assets_site/images_site/event_halls/event-halls-1.jpg') }}" alt="{{ $eventHall->nom_salle }}" class="img-fluid event-hall-img"/>
        @endif
        
        <!-- Badge de type d'événement -->
        <span class="event-type-badge {{ $eventColor }}">
            <i class="la {{ $eventIcon }}"></i> {{ $eventType }}
        </span>
    </div>
    
    <div class="card-body">
        <div class="w-100 d-flex justify-content-between align-items-start flex-column">
            <div class="w-100 d-flex justify-content-between align-items-start">
                <div>
                    <!-- Nom de la salle -->
                    <h3 class="card-title">
                        <a href="{{ route('site.detailSallesfetes', $eventHall->id) }}">{{ $eventHall->nom_salle }}</a>
                    </h3>
                    
                    <!-- Nom de l'hôtel -->
                    <div class="card-location">
                        <i class="la la-building text-primary me-1"></i>
                        {{ $eventHall->hotel->nom_hotel ?? 'Hôtel non spécifié' }}
                    </div>
                </div>
                <div class="price-info text-end">
                    <span class="price">{{ number_format($eventHall->prix, 0, ',', ' ') }} FCFA</span>
                    <span class="price-period">par jour</span>
                </div>
            </div>
            
            <div class="mt-2 w-100 d-flex justify-content-between align-items-center">
                <div class="location-info"> 
                    <i class="la la-map-marker text-danger me-1"></i> 
                    {{ $eventHall->ville->nom ?? 'Ville non spécifiée' }}, 
                    {{ strlen($eventHall->localisation ?? '') > 20 ? substr($eventHall->localisation, 0, 20) . '...' : $eventHall->localisation ?? 'Localisation non spécifiée' }}
                </div>
                
                <!-- Capacité -->
                <div class="capacity-info">
                    <i class="la la-users me-1"></i>
                    <span>{{ number_format($eventHall->capacite) }} places</span>
                </div>
            </div>
        </div>
   
        <!-- Lien de détails -->
        <div class="mt-3 d-grid">
            <a href="{{ route('site.detailSallesfetes', $eventHall->id) }}" class="btn btn-primary">
                Voir les détails 
            </a>
        </div>
    </div>
</div>

<style>
    /* Styles pour la carte de salle de fête */
    .event-hall-card {
        border: none;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        height: 100%;
    }
    
    .event-hall-img {
        height: 220px;
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
        font-size: 1.15rem;
        font-weight: 600;
        margin-bottom: 5px;
        line-height: 1.3;
    }
    
    .card-title a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .card-title a:hover {
        color: #287dfa;
    }
    
    .card-location, .location-info, .capacity-info {
        font-size: 0.875rem;
        color: #666;
    }
    
    .price-info {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }
    
    .price {
        font-weight: 600;
        font-size: 1rem;
        color: #333;
    }
    
    .price-period {
        font-size: 0.75rem;
        color: #999;
    }
    
    /* Bouton de détails */
    .event-hall-card .btn-primary {
        border-radius: 4px;
        font-weight: 500;
        padding: 8px 15px;
    }
</style>

<script>
    // Script pour initialiser le carrousel uniquement s'il y a plusieurs images
    document.addEventListener('DOMContentLoaded', function() {
        $('.event-hall-carousel').each(function() {
            const $carousel = $(this);
            const slideCount = $carousel.find('.item').length;
            
            // Initialiser le carrousel seulement s'il y a plus d'une image
            if (slideCount > 1) {
                $carousel.owlCarousel({
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
            }
        });
    });
</script> 