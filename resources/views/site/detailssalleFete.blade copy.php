@extends('site.layouts.app-site')

@section('content-site')

<!-- ================================
   START HALL DETAIL AREA
================================= -->
<section class="hall-detail-area">
    <div class="container">
        <!-- En-tête avec informations principales -->
        <div class="mb-4 row">
            <div class="col-lg-8">
                <div class="hall-detail-header">
                    <h1 class="hall-title">{{ $eventHall->nom_salle }}</h1>
                    <div class="hall-location">
                        <i class="la la-map-marker text-danger"></i> 
                        {{ $eventHall->ville->nom ?? 'Ville non spécifiée' }}, {{ $eventHall->localisation ?? 'Localisation non spécifiée' }}
                    </div>
                    <div class="mt-2 hall-meta">
                        <span class="hall-capacity me-3"><i class="la la-users"></i> {{ number_format($eventHall->capacite) }} places</span>
                        <span class="hall-hotel"><i class="la la-building"></i> {{ $eventHall->hotel->nom_hotel ?? 'Hôtel non spécifié' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="hall-price-card">
                    <div class="price-title">TARIF</div>
                    <div class="price-amount">{{ number_format($eventHall->prix, 0, ',', ' ') }} <span>FCFA</span></div>
                    <div class="mb-3 price-period">par jour</div>
                    
                    <button type="button" class="btn btn-primary reserve-btn w-100" data-bs-toggle="modal" data-bs-target="#reservationModal">
                        Réserver maintenant
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Galerie d'images -->
        <div class="mb-5 row">
            <div class="col-12">
                <div class="hall-gallery">
                    @php
                        // Les champs d'images
                        $imageFields = ['photo', 'photo1', 'photo2', 'photo3', 'photo4'];
                        
                        // Filtrer pour ne garder que les champs d'images remplis
                        $images = collect($imageFields)->filter(function($field) use ($eventHall) {
                            return !empty($eventHall->$field);
                        })->map(function($field) use ($eventHall) {
                            return $eventHall->$field;
                        });
                        
                        // Si aucune image, utiliser une image par défaut
                        if ($images->isEmpty()) {
                            $images = collect(['assets_site/images_site/event_halls/event-halls-1.jpg']);
                            $isStorage = false;
                        } else {
                            $isStorage = true;
                        }
                    @endphp
                    
                    @if($images->count() > 1)
                        <!-- Carrousel pour plusieurs images -->
                        <div class="owl-carousel hall-gallery-carousel">
                            @foreach($images as $image)
                                <div class="gallery-item">
                                    <img src="{{ $isStorage ? asset('storage/' . $image) : asset($image) }}" alt="{{ $eventHall->nom_salle }}" class="img-fluid">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Image unique -->
                        <div class="gallery-item single-image">
                            <img src="{{ $isStorage ? asset('storage/' . $images->first()) : asset($images->first()) }}" alt="{{ $eventHall->nom_salle }}" class="img-fluid">
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Description et Informations -->
        <div class="mb-5 row">
            <div class="col-lg-8">
                <!-- Description -->
                <div class="mb-4 hall-description card">
                    <div class="card-header">
                        <h2 class="section-title">À propos de cette salle</h2>
                    </div>
                    <div class="card-body">
                        @if(!empty($eventHall->description))
                            <p>{{ $eventHall->description }}</p>
                        @else
                            <p class="text-muted">Aucune description disponible pour cette salle.</p>
                        @endif
                    </div>
                </div>
                
                <!-- Types d'événements -->
                <div class="mb-4 hall-event-types card">
                    <div class="card-header">
                        <h2 class="section-title">Types d'événements</h2>
                    </div>
                    <div class="card-body">
                        @php
                            use App\Helpers\EventTypeHelper;
                            $eventTypeIcons = EventTypeHelper::getEventTypeIcons();
                            $eventType = $eventHall->event_type ?? 'Autre';
                            $eventIcon = $eventTypeIcons[$eventType]['icon'] ?? 'la-calendar-day';
                            $eventColor = $eventTypeIcons[$eventType]['color'] ?? 'bg-secondary';
                        @endphp
                        
                        <div class="event-type-badge {{ $eventColor }} d-inline-block">
                            <i class="la {{ $eventIcon }}"></i> {{ $eventType }}
                        </div>
                    </div>
                </div>
                
                <!-- Caractéristiques de la salle -->
                <div class="hall-features card">
                    <div class="card-header">
                        <h2 class="section-title">Caractéristiques</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li><i class="la la-users"></i> <strong>Capacité:</strong> {{ number_format($eventHall->capacite) }} personnes</li>
                                    <li><i class="la la-building"></i> <strong>Hôtel:</strong> {{ $eventHall->hotel->nom_hotel ?? 'Non spécifié' }}</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li><i class="la la-map-marker"></i> <strong>Localisation:</strong> {{ $eventHall->localisation ?? 'Non spécifiée' }}</li>
                                    <li><i class="la la-city"></i> <strong>Ville:</strong> {{ $eventHall->ville->nom ?? 'Non spécifiée' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Carte de localisation -->
                <div class="mb-4 hall-map card">
                    <div class="card-header">
                        <h2 class="section-title">Localisation</h2>
                    </div>
                    <div class="p-0 card-body">
                        <div class="py-5 text-center map-placeholder">
                            <i class="la la-map-marker fa-3x text-secondary"></i>
                            <p class="mt-2 text-muted">{{ $eventHall->ville->nom ?? 'Ville non spécifiée' }}, {{ $eventHall->localisation ?? 'Localisation non spécifiée' }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Coordonnées du responsable -->
                <div class="hall-contact card">
                    <div class="card-header">
                        <h2 class="section-title">Contact</h2>
                    </div>
                    <div class="card-body">
                        <ul class="contact-list">
                            <li>
                                <i class="la la-user"></i> 
                                <span>{{ $eventHall->user->name ?? 'Manager' }}</span>
                            </li>
                            <li>
                                <i class="la la-envelope"></i> 
                                <span>{{ $eventHall->hotel->email ?? 'contact@akilaeven.com' }}</span>
                            </li>
                            <li>
                                <i class="la la-phone"></i> 
                                <span>{{ $eventHall->hotel->telephone ?? 'Non disponible' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Salles similaires -->
        <div class="similar-halls">
            <h2 class="mb-4">Salles similaires</h2>
            <div class="row">
                @foreach($event_Halls as $hall)
                    <div class="col-md-6">
                        <x-event-hall.card :eventHall="$hall" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- ================================
   END HALL DETAIL AREA
================================= -->

<!-- Modal de réservation -->
<div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationModalLabel">Réserver "{{ $eventHall->nom_salle }}"</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="reservationForm">
                    @csrf
                    <input type="hidden" name="event_hall_id" value="{{ $eventHall->id }}">
                    
                    <div class="mb-3 row">
                        <!-- Dates de réservation -->
                        <div class="mb-3 col-md-6">
                            <label for="start_date" class="form-label">Date de début</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="end_date" class="form-label">Date de fin</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>
                    
                    <!-- Informations personnelles -->
                    <div class="mb-3 row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Nom complet</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <div class="mb-3 col-md-6">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="event_type" class="form-label">Type d'événement</label>
                            <select class="form-select" id="event_type" name="event_type" required>
                                <option value="">Sélectionner</option>
                                @foreach(App\Helpers\EventTypeHelper::getEventTypes() as $type => $label)
                                    <option value="{{ $type }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <!-- Détails supplémentaires -->
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes supplémentaires</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                    </div>
                    
                    <!-- Résumé de la réservation -->
                    <div class="p-3 mb-3 rounded reservation-summary bg-light">
                        <h6 class="mb-3">Résumé de votre réservation</h6>
                        <div class="mb-2 d-flex justify-content-between">
                            <span>Prix par jour:</span>
                            <span>{{ number_format($eventHall->prix, 0, ',', ' ') }} FCFA</span>
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <span>Nombre de jours:</span>
                            <span id="days_count">0</span>
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <span>Frais de service:</span>
                            <span>5,000 FCFA par jour</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total:</span>
                            <span id="total_price">0 FCFA</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary submit-reservation">Réserver</button>
            </div>
        </div>
    </div>
</div>

<!-- Styles pour la page détail -->
<style>
    .hall-detail-area {
        padding: 60px 0;
    }
    
    /* En-tête */
    .hall-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #333;
    }
    
    .hall-location {
        font-size: 1rem;
        color: #666;
    }
    
    .hall-meta {
        color: #666;
    }
    
    /* Carte de prix */
    .hall-price-card {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        text-align: center;
    }
    
    .price-title {
        color: #888;
        font-size: 0.9rem;
        margin-bottom: 5px;
    }
    
    .price-amount {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
    }
    
    .price-amount span {
        font-size: 1rem;
        font-weight: 500;
    }
    
    .price-period {
        color: #888;
        font-size: 0.9rem;
    }
    
    .reserve-btn {
        padding: 12px 20px;
        font-weight: 600;
    }
    
    /* Galerie */
    .hall-gallery {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .gallery-item img {
        width: 100%;
        height: 500px;
        object-fit: cover;
    }
    
    /* Cards d'informations */
    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }
    
    .card-header {
        background-color: #fff;
        border-bottom: 1px solid #eee;
        padding: 15px 20px;
    }
    
    .section-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0;
        color: #333;
    }
    
    .card-body {
        padding: 20px;
    }
    
    /* Badge de type d'événement */
    .event-type-badge {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 20px;
        color: white;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    /* Listes */
    .feature-list, .contact-list {
        list-style-type: none;
        padding: 0;
    }
    
    .feature-list li, .contact-list li {
        margin-bottom: 12px;
        display: flex;
        align-items: center;
    }
    
    .feature-list li i, .contact-list li i {
        width: 25px;
        font-size: 1.1rem;
        color: #287dfa;
    }
    
    /* Carte placeholder */
    .map-placeholder {
        height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa;
    }
    
    /* Salles similaires */
    .similar-halls h2 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
    }
    
    /* Modal réservation */
    .reservation-summary {
        background-color: #f8f9fa;
        border-radius: 8px;
    }
    
    /* Responsive */
    @media (max-width: 991px) {
        .hall-title {
            font-size: 1.8rem;
        }
        
        .hall-price-card {
            margin-top: 20px;
        }
        
        .gallery-item img {
            height: 350px;
        }
    }
    
    @media (max-width: 767px) {
        .hall-detail-area {
            padding: 40px 0;
        }
        
        .gallery-item img {
            height: 250px;
        }
    }
</style>

<!-- Scripts pour la page détail -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser le carrousel de la galerie
        $('.hall-gallery-carousel').owlCarousel({
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
        
        // Calcul du prix total lors de la sélection des dates
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const daysCountElement = document.getElementById('days_count');
        const totalPriceElement = document.getElementById('total_price');
        const pricePerDay = {{ $eventHall->prix }};
        const serviceFee = 5000; // 5,000 FCFA par jour
        
        function calculateTotal() {
            if (startDateInput.value && endDateInput.value) {
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);
                
                // Vérifier que la date de fin est après la date de début
                if (endDate < startDate) {
                    endDateInput.value = startDateInput.value;
                    return;
                }
                
                // Calculer le nombre de jours (inclut le jour de début et de fin)
                const diffTime = Math.abs(endDate - startDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                
                // Mettre à jour l'affichage
                daysCountElement.textContent = diffDays;
                
                // Calculer le prix total
                const totalPrice = (pricePerDay + serviceFee) * diffDays;
                totalPriceElement.textContent = totalPrice.toLocaleString('fr-FR') + ' FCFA';
            }
        }
        
        // Écouter les changements de dates
        startDateInput.addEventListener('change', calculateTotal);
        endDateInput.addEventListener('change', calculateTotal);
        
        // Initialiser avec la date d'aujourd'hui
        const today = new Date();
        const yyyy = today.getFullYear();
        let mm = today.getMonth() + 1;
        let dd = today.getDate();
        
        if (mm < 10) mm = '0' + mm;
        if (dd < 10) dd = '0' + dd;
        
        const formattedToday = yyyy + '-' + mm + '-' + dd;
        startDateInput.value = formattedToday;
        endDateInput.value = formattedToday;
        calculateTotal();
        
        // Soumission du formulaire
        document.querySelector('.submit-reservation').addEventListener('click', function() {
            // Ici, vous pouvez ajouter la logique de soumission du formulaire
            // Pour l'instant, affichons juste un message de confirmation
            alert('Votre demande de réservation a été envoyée avec succès! Un responsable vous contactera pour confirmer.');
            document.getElementById('reservationForm').reset();
            $('#reservationModal').modal('hide');
        });
    });
</script>
@endpush

@endsection
