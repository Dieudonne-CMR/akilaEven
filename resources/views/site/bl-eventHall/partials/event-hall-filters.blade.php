@php
    use App\Models\EventHall;
    use App\Models\Hotel;
    use App\Helpers\EventTypeHelper;
    
    // Récupérer les hotels qui ont des salles de fêtes
    $hotels = Hotel::whereHas('eventHalls')->pluck('nom_hotel', 'id');
    
    // Récupérer les localisations disponibles
    $localisations = EventHall::whereNotNull('localisation')
        ->distinct()
        ->pluck('localisation')
        ->toArray();
    
    // Récupérer min et max capacité
    $minCapacite = EventHall::min('capacite') ?: 10;
    $maxCapacite = EventHall::max('capacite') ?: 500;
    
    // Récupérer min et max prix
    $minPrix = EventHall::min('prix') ?: 50000;
    $maxPrix = EventHall::max('prix') ?: 1000000;
    
    // Types d'événements
    $eventTypes = EventTypeHelper::getEventTypes();
    
    // Récupérer les filtres actuels
    $filters = request()->all();
@endphp

<div class="sidebar-filters">
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h3 class="filter-title">Filtrer les salles</h3>
        <a href="{{ route('site.sallesfetes') }}" class="btn-reset">Réinitialiser</a>
    </div>
    
    <form action="{{ route('site.sallesfetes') }}" method="GET" id="filter-form">
        <!-- Recherche par mot-clé -->
        <div class="accordion filter-accordion" id="searchAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSearch">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSearch" aria-expanded="true" aria-controls="collapseSearch">
                        Recherche
                    </button>
                </h2>
                <div id="collapseSearch" class="accordion-collapse collapse show" aria-labelledby="headingSearch">
                    <div class="accordion-body">
                        <div class="form-group position-relative">
                            <i class="la la-search position-absolute" style="top: 12px; left: 15px;"></i>
                            <input 
                                type="text" 
                                name="search" 
                                class="form-control ps-5" 
                                placeholder="Nom de salle, description..." 
                                value="{{ $filters['search'] ?? '' }}"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Filtre par capacité -->
        <div class="mt-3 accordion filter-accordion" id="capacityAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingCapacity">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCapacity" aria-expanded="false" aria-controls="collapseCapacity">
                        Capacité
                    </button>
                </h2>
                <div id="collapseCapacity" class="accordion-collapse collapse" aria-labelledby="headingCapacity">
                    <div class="accordion-body">
                        <div class="range-slider-wrap">
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <span id="capacite-min-value">{{ $filters['min_capacite'] ?? $minCapacite }} personnes</span>
                                <span id="capacite-max-value">{{ $filters['max_capacite'] ?? $maxCapacite }} personnes</span>
                            </div>
                            <div class="range-slider-ui" 
                                data-min="{{ $minCapacite }}" 
                                data-max="{{ $maxCapacite }}" 
                                data-min-value="{{ $filters['min_capacite'] ?? $minCapacite }}" 
                                data-max-value="{{ $filters['max_capacite'] ?? $maxCapacite }}"
                                data-step="10">
                            </div>
                            <input type="hidden" name="min_capacite" id="min-capacite" value="{{ $filters['min_capacite'] ?? $minCapacite }}">
                            <input type="hidden" name="max_capacite" id="max-capacite" value="{{ $filters['max_capacite'] ?? $maxCapacite }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Filtre par prix -->
        <div class="mt-3 accordion filter-accordion" id="priceAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingPrice">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrice" aria-expanded="false" aria-controls="collapsePrice">
                        Prix (FCFA)
                    </button>
                </h2>
                <div id="collapsePrice" class="accordion-collapse collapse" aria-labelledby="headingPrice">
                    <div class="accordion-body">
                        <div class="range-slider-wrap">
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <span id="prix-min-value">{{ number_format($filters['min_prix'] ?? $minPrix, 0, ',', ' ') }} FCFA</span>
                                <span id="prix-max-value">{{ number_format($filters['max_prix'] ?? $maxPrix, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="range-slider-ui" 
                                data-min="{{ $minPrix }}" 
                                data-max="{{ $maxPrix }}" 
                                data-min-value="{{ $filters['min_prix'] ?? $minPrix }}" 
                                data-max-value="{{ $filters['max_prix'] ?? $maxPrix }}"
                                data-step="10000">
                            </div>
                            <input type="hidden" name="min_prix" id="min-prix" value="{{ $filters['min_prix'] ?? $minPrix }}">
                            <input type="hidden" name="max_prix" id="max-prix" value="{{ $filters['max_prix'] ?? $maxPrix }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Filtre par localisation -->
        <div class="mt-3 accordion filter-accordion" id="locationAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingLocation">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLocation" aria-expanded="false" aria-controls="collapseLocation">
                        Localisation
                    </button>
                </h2>
                <div id="collapseLocation" class="accordion-collapse collapse" aria-labelledby="headingLocation">
                    <div class="accordion-body">
                        <div class="form-group">
                            <input 
                                type="text" 
                                name="localisation" 
                                class="form-control" 
                                placeholder="Rechercher une localisation" 
                                list="localisation-list"
                                value="{{ $filters['localisation'] ?? '' }}"
                            >
                            <datalist id="localisation-list">
                                @foreach($localisations as $localisation)
                                    <option value="{{ $localisation }}">
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Filtre par type d'événement -->
        <div class="mt-3 accordion filter-accordion" id="eventTypeAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEventType">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEventType" aria-expanded="false" aria-controls="collapseEventType">
                        Type d'événement
                    </button>
                </h2>
                <div id="collapseEventType" class="accordion-collapse collapse" aria-labelledby="headingEventType">
                    <div class="accordion-body">
                        <div class="checkbox-wrap">
                            @foreach($eventTypes as $value => $label)
                                <div class="custom-checkbox">
                                    <input 
                                        type="checkbox" 
                                        id="event-type-{{ $loop->index }}" 
                                        name="event_types[]" 
                                        value="{{ $value }}"
                                        {{ in_array($value, $filters['event_types'] ?? []) ? 'checked' : '' }}
                                    >
                                    <label for="event-type-{{ $loop->index }}">{{ $label }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Filtre par Hôtel -->
        <div class="mt-3 accordion filter-accordion" id="hotelAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingHotel">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHotel" aria-expanded="false" aria-controls="collapseHotel">
                        Hôtel
                    </button>
                </h2>
                <div id="collapseHotel" class="accordion-collapse collapse" aria-labelledby="headingHotel">
                    <div class="accordion-body">
                        <select name="hotel_id" class="form-select">
                            <option value="">Tous les hôtels</option>
                            @foreach($hotels as $id => $hotel)
                                <option value="{{ $id }}" {{ ($filters['hotel_id'] ?? '') == $id ? 'selected' : '' }}>
                                    {{ $hotel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bouton d'action -->
        <div class="pt-4 d-grid">
            <button type="submit" class="btn btn-primary apply-filters-btn">Appliquer les filtres</button>
        </div>
    </form>
</div>

<style>
    /* Styles pour les filtres */
    .sidebar-filters {
        padding: 20px 0;
    }
    
    .filter-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #287dfa;
        margin-bottom: 0;
    }
    
    .btn-reset {
        color: #666;
        font-size: 0.9rem;
        text-decoration: none;
        border: 1px solid #333;
        padding: 4px 10px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    
    .btn-reset:hover {
        background-color: transparent;
        color: #333;
    }
    
    .filter-accordion .accordion-item {
        border: none;
        border-bottom: 1px solid #eee;
    }
    
    .filter-accordion .accordion-item:last-child {
        border-bottom: none;
    }
    
    .filter-accordion .accordion-button {
        padding: 12px 0;
        font-weight: 500;
        font-size: 1rem;
        color: #333;
        background-color: transparent;
        box-shadow: none;
    }
    
    .filter-accordion .accordion-button:not(.collapsed) {
        background-color: transparent;
        color: #287dfa;
    }
    
    .filter-accordion .accordion-button:focus {
        box-shadow: none;
    }
    
    .filter-accordion .accordion-body {
        padding: 12px 0;
    }
    
    /* Style pour les sliders */
    .ui-slider {
        height: 4px;
        background-color: #eee;
        border: none;
        border-radius: 4px;
    }
    
    .ui-slider .ui-slider-range {
        background-color: #287dfa;
    }
    
    .ui-slider .ui-slider-handle {
        width: 14px;
        height: 14px;
        background-color: #fff;
        border: 2px solid #287dfa;
        border-radius: 50%;
        cursor: pointer;
        top: -5px;
    }
    
    .ui-slider .ui-slider-handle:focus {
        outline: none;
    }
    
    /* Style pour les checkboxes */
    .custom-checkbox {
        margin-bottom: 8px;
    }
    
    .custom-checkbox input {
        display: none;
    }
    
    .custom-checkbox label {
        position: relative;
        padding-left: 28px;
        cursor: pointer;
        display: inline-block;
        color: #555;
        font-size: 0.9rem;
    }
    
    .custom-checkbox label:before {
        content: '';
        position: absolute;
        left: 0;
        top: 2px;
        width: 18px;
        height: 18px;
        border: 1px solid #ddd;
        border-radius: 3px;
        background-color: #fff;
    }
    
    .custom-checkbox input:checked + label:before {
        background-color: #287dfa;
        border-color: #287dfa;
    }
    
    .custom-checkbox input:checked + label:after {
        content: '\f00c';
        font-family: 'Line Awesome Free';
        font-weight: 900;
        position: absolute;
        left: 3px;
        top: 2px;
        color: white;
        font-size: 12px;
    }
    
    /* Bouton appliquer les filtres */
    .apply-filters-btn {
        padding: 10px;
        border-radius: 4px;
        font-weight: 500;
    }
</style> 