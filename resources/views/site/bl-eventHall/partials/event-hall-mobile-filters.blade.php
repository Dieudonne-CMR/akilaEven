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

<!-- Offcanvas filtres mobile -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="filtersOffcanvas" aria-labelledby="filtersOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="filtersOffcanvasLabel">Filtrer les salles</h5>
        <div>
            <a href="{{ route('site.sallesfetes') }}" class="btn-reset me-2">Réinitialiser</a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fermer"></button>
        </div>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('site.sallesfetes') }}" method="GET" id="mobile-filter-form">
            <!-- Recherche par mot-clé -->
            <div class="accordion filter-accordion" id="mobileSearchAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="mobileHeadingSearch">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#mobileCollapseSearch" aria-expanded="true" aria-controls="mobileCollapseSearch">
                            Recherche
                        </button>
                    </h2>
                    <div id="mobileCollapseSearch" class="accordion-collapse collapse show" aria-labelledby="mobileHeadingSearch" data-bs-parent="#mobileSearchAccordion">
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
            <div class="accordion filter-accordion mt-3" id="mobileCapacityAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="mobileHeadingCapacity">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mobileCollapseCapacity" aria-expanded="false" aria-controls="mobileCollapseCapacity">
                            Capacité
                        </button>
                    </h2>
                    <div id="mobileCollapseCapacity" class="accordion-collapse collapse" aria-labelledby="mobileHeadingCapacity" data-bs-parent="#mobileCapacityAccordion">
                        <div class="accordion-body">
                            <div class="range-slider-wrap">
                                <div class="mb-2 d-flex align-items-center justify-content-between">
                                    <span id="mobile-capacite-min-value">{{ $filters['min_capacite'] ?? $minCapacite }} personnes</span>
                                    <span id="mobile-capacite-max-value">{{ $filters['max_capacite'] ?? $maxCapacite }} personnes</span>
                                </div>
                                <div class="range-slider-ui" 
                                    data-min="{{ $minCapacite }}" 
                                    data-max="{{ $maxCapacite }}" 
                                    data-min-value="{{ $filters['min_capacite'] ?? $minCapacite }}" 
                                    data-max-value="{{ $filters['max_capacite'] ?? $maxCapacite }}"
                                    data-step="10">
                                </div>
                                <input type="hidden" name="min_capacite" id="mobile-min-capacite" value="{{ $filters['min_capacite'] ?? $minCapacite }}">
                                <input type="hidden" name="max_capacite" id="mobile-max-capacite" value="{{ $filters['max_capacite'] ?? $maxCapacite }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Filtre par prix -->
            <div class="accordion filter-accordion mt-3" id="mobilePriceAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="mobileHeadingPrice">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mobileCollapsePrice" aria-expanded="false" aria-controls="mobileCollapsePrice">
                            Prix (FCFA)
                        </button>
                    </h2>
                    <div id="mobileCollapsePrice" class="accordion-collapse collapse" aria-labelledby="mobileHeadingPrice" data-bs-parent="#mobilePriceAccordion">
                        <div class="accordion-body">
                            <div class="range-slider-wrap">
                                <div class="mb-2 d-flex align-items-center justify-content-between">
                                    <span id="mobile-prix-min-value">{{ number_format($filters['min_prix'] ?? $minPrix, 0, ',', ' ') }} FCFA</span>
                                    <span id="mobile-prix-max-value">{{ number_format($filters['max_prix'] ?? $maxPrix, 0, ',', ' ') }} FCFA</span>
                                </div>
                                <div class="range-slider-ui" 
                                    data-min="{{ $minPrix }}" 
                                    data-max="{{ $maxPrix }}" 
                                    data-min-value="{{ $filters['min_prix'] ?? $minPrix }}" 
                                    data-max-value="{{ $filters['max_prix'] ?? $maxPrix }}"
                                    data-step="10000">
                                </div>
                                <input type="hidden" name="min_prix" id="mobile-min-prix" value="{{ $filters['min_prix'] ?? $minPrix }}">
                                <input type="hidden" name="max_prix" id="mobile-max-prix" value="{{ $filters['max_prix'] ?? $maxPrix }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Filtre par localisation -->
            <div class="accordion filter-accordion mt-3" id="mobileLocationAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="mobileHeadingLocation">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mobileCollapseLocation" aria-expanded="false" aria-controls="mobileCollapseLocation">
                            Localisation
                        </button>
                    </h2>
                    <div id="mobileCollapseLocation" class="accordion-collapse collapse" aria-labelledby="mobileHeadingLocation" data-bs-parent="#mobileLocationAccordion">
                        <div class="accordion-body">
                            <div class="form-group">
                                <input 
                                    type="text" 
                                    name="localisation" 
                                    class="form-control" 
                                    placeholder="Rechercher une localisation" 
                                    list="mobile-localisation-list"
                                    value="{{ $filters['localisation'] ?? '' }}"
                                >
                                <datalist id="mobile-localisation-list">
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
            <div class="accordion filter-accordion mt-3" id="mobileEventTypeAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="mobileHeadingEventType">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mobileCollapseEventType" aria-expanded="false" aria-controls="mobileCollapseEventType">
                            Type d'événement
                        </button>
                    </h2>
                    <div id="mobileCollapseEventType" class="accordion-collapse collapse" aria-labelledby="mobileHeadingEventType" data-bs-parent="#mobileEventTypeAccordion">
                        <div class="accordion-body">
                            <div class="checkbox-wrap">
                                @foreach($eventTypes as $value => $label)
                                    <div class="custom-checkbox">
                                        <input 
                                            type="checkbox" 
                                            id="mobile-event-type-{{ $loop->index }}" 
                                            name="event_types[]" 
                                            value="{{ $value }}"
                                            {{ in_array($value, $filters['event_types'] ?? []) ? 'checked' : '' }}
                                        >
                                        <label for="mobile-event-type-{{ $loop->index }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Filtre par Hôtel -->
            <div class="accordion filter-accordion mt-3" id="mobileHotelAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="mobileHeadingHotel">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mobileCollapseHotel" aria-expanded="false" aria-controls="mobileCollapseHotel">
                            Hôtel
                        </button>
                    </h2>
                    <div id="mobileCollapseHotel" class="accordion-collapse collapse" aria-labelledby="mobileHeadingHotel" data-bs-parent="#mobileHotelAccordion">
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
            <div class="mt-4 mb-2 d-grid">
                <button type="submit" class="btn btn-primary">Appliquer les filtres</button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Styles pour le offcanvas mobile */
    .offcanvas-header {
        border-bottom: 1px solid #eee;
    }
    
    .offcanvas-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #287dfa;
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
    
    /* Style pour les sliders (mobile) */
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
    
    /* Style pour les checkboxes (mobile) */
    .custom-checkbox {
        margin-bottom: 10px;
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
</style>

<script>
    // Script pour initialiser les sliders de plage dans le filtre mobile
    document.addEventListener('DOMContentLoaded', function() {
        $('.range-slider-ui').each(function() {
            var $this = $(this);
            var min = $this.data('min');
            var max = $this.data('max');
            var minValue = $this.data('min-value');
            var maxValue = $this.data('max-value');
            var step = $this.data('step');
            
            $this.slider({
                range: true,
                min: min,
                max: max,
                values: [minValue, maxValue],
                step: step,
                slide: function(event, ui) {
                    // Mise à jour de l'interface et des champs cachés (mobile)
                    var parent = $(this).closest('.offcanvas-body');
                    if (parent.find('#mobile-capacite-min-value').length) {
                        parent.find('#mobile-capacite-min-value').text(ui.values[0] + ' personnes');
                        parent.find('#mobile-capacite-max-value').text(ui.values[1] + ' personnes');
                        parent.find('#mobile-min-capacite').val(ui.values[0]);
                        parent.find('#mobile-max-capacite').val(ui.values[1]);
                    } else {
                        parent.find('#mobile-prix-min-value').text(ui.values[0].toLocaleString('fr-FR') + ' FCFA');
                        parent.find('#mobile-prix-max-value').text(ui.values[1].toLocaleString('fr-FR') + ' FCFA');
                        parent.find('#mobile-min-prix').val(ui.values[0]);
                        parent.find('#mobile-max-prix').val(ui.values[1]);
                    }
                }
            });
        });
    });
</script> 