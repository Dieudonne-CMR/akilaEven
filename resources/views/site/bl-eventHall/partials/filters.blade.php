@php
    use App\Models\EventHall;
    use App\Models\Hotel;
    use App\Models\Ville;
    
    // Récupérer les hotels qui ont des salles de fêtes
    $hotels = Hotel::whereHas('eventHalls')->pluck('nom_hotel', 'id');
    
    // Récupérer les villes qui ont des salles de fêtes
    $villes = Ville::whereHas('eventHalls')->pluck('nom', 'id');
    
    // Récupérer min et max capacité
    $minCapacite = EventHall::min('capacite') ?: 10;
    $maxCapacite = EventHall::max('capacite') ?: 500;
    
    // Récupérer min et max prix
    $minPrix = EventHall::min('prix') ?: 50000;
    $maxPrix = EventHall::max('prix') ?: 1000000;
    
    // Types d'événements
    $eventTypes = [
        'Mariage' => 'Mariage',
        'Anniversaire' => 'Anniversaire',
        'Conférence' => 'Conférence',
        'Séminaire' => 'Séminaire',
        'Réunion d\'affaires' => 'Réunion d\'affaires',
        'Fête' => 'Fête',
        'Gala' => 'Gala',
        'Cérémonie' => 'Cérémonie',
        'Autre' => 'Autre'
    ];
    
    // Récupérer les filtres actuels
    $filters = request()->all();
@endphp

<div class="sidebar-widget">
    <div class="p-4 bg-white rounded shadow-sm sidebar-filter-wrap">
        <h3 style="color:#287dfa" class="mb-4 filter-title">Filtrer les salles</h3>
        
        <form action="{{ route('site.sallesfetes') }}" method="GET" id="filter-form">
            <!-- Recherche par mot-clé -->
            <div class="mb-4 filter-block">
                <h5 class="mb-3 filter-heading">Recherche</h5>
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
            
            <!-- Filtre par capacité -->
            <div class="mb-4 filter-block">
                <h5 class="mb-3 filter-heading">Capacité</h5>
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
            
            <!-- Filtre par prix -->
            <div class="mb-4 filter-block">
                <h5 class="mb-3 filter-heading">Prix (FCFA)</h5>
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
            
            <!-- Filtre par type d'événement -->
            <div class="mb-4 filter-block">
                <h5 class="mb-3 filter-heading">Type d'événement</h5>
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
            
            <!-- Filtre par Ville -->
            <div class="mb-4 filter-block">
                <h5 class="mb-3 filter-heading">Ville</h5>
                <select name="ville_id" class="form-select">
                    <option value="">Toutes les villes</option>
                    @foreach($villes as $id => $ville)
                        <option value="{{ $id }}" {{ ($filters['ville_id'] ?? '') == $id ? 'selected' : '' }}>
                            {{ $ville }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Filtre par Hôtel -->
            <div class="mb-4 filter-block">
                <h5 class="mb-3 filter-heading">Hôtel</h5>
                <select name="hotel_id" class="form-select">
                    <option value="">Tous les hôtels</option>
                    @foreach($hotels as $id => $hotel)
                        <option value="{{ $id }}" {{ ($filters['hotel_id'] ?? '') == $id ? 'selected' : '' }}>
                            {{ $hotel }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Boutons d'action -->
            <div class="pt-2 btn-box">
                <button type="submit" class="mb-2 theme-btn w-100">Appliquer les filtres</button>
                <a href="{{ route('site.sallesfetes') }}" class="btn btn-outline-secondary w-100">Réinitialiser</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialisation des sliders de plage
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
                    // Mise à jour de l'interface et des champs cachés
                    if ($this.closest('.filter-block').find('#capacite-min-value').length) {
                        $('#capacite-min-value').text(ui.values[0] + ' personnes');
                        $('#capacite-max-value').text(ui.values[1] + ' personnes');
                        $('#min-capacite').val(ui.values[0]);
                        $('#max-capacite').val(ui.values[1]);
                    } else {
                        $('#prix-min-value').text(ui.values[0].toLocaleString('fr-FR') + ' FCFA');
                        $('#prix-max-value').text(ui.values[1].toLocaleString('fr-FR') + ' FCFA');
                        $('#min-prix').val(ui.values[0]);
                        $('#max-prix').val(ui.values[1]);
                    }
                }
            });
        });
    });
</script>

<style>
    /* Styles pour le widget de filtre */
    .sidebar-filter-wrap {
        background-color: #fff;
        border-radius: 8px;
    }
    
    .filter-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }
    
    .filter-heading {
        font-size: 1rem;
      /*   font-weight: 600; */
        color:#9ca3af !important;

        margin-bottom: 10px;
    }
    
    .filter-block {
        margin-bottom: 25px;
        border-bottom: 1px solid #eee;
        padding-bottom: 20px;
    }
    
    .filter-block:last-child {
        border-bottom: none;
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
        padding-left: 30px;
        cursor: pointer;
        display: inline-block;
        color: #555;
        font-size: 0.9rem;
    }
    
    .custom-checkbox label:before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 20px;
        height: 20px;
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
        left: 4px;
        top: 1px;
        color: white;
        font-size: 12px;
    }
    
    /* Style pour les sliders */
    .ui-slider {
        height: 5px;
        background-color: #eee;
        border: none;
        border-radius: 10px;
    }
    
    .ui-slider .ui-slider-range {
        background-color: #287dfa;
    }
    
    .ui-slider .ui-slider-handle {
        width: 16px;
        height: 16px;
        background-color: #fff;
        border: 2px solid #287dfa;
        border-radius: 50%;
        cursor: pointer;
        top: -6px;
    }
    
    .ui-slider .ui-slider-handle:focus {
        outline: none;
    }
</style> 