@php
    use App\Models\EventHall;
    use App\Models\Ville;
    
    // Récupération des villes qui ont des salles de fêtes
    $villes = Ville::whereHas('eventHalls')->pluck('nom')->unique();
    
    // Récupération des localisations des salles de fêtes
    $localisations = EventHall::pluck('localisation')->unique()->filter();
    
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
    
    // Capacité maximale
    $maxCapacite = EventHall::max('capacite') ?: 300;
@endphp

<div class="contact-form-action">
    <form 
        action="{{ route('site.sallesfetes') }}" 
        method="GET" 
        class="row" 
        x-data="{ 
            ville: '', 
            eventType: '', 
            capacite: '', 
            showVilleList: false 
        }"
    >
        <div class="col-lg-3 pe-0">
            <div class="input-box">
                <label class="label-text">Ville / Localisation</label>
                <div class="form-group position-relative">
                    <span class="la la-map-marker form-icon"></span>
                    <input
                        class="form-control custom-datalist"
                        type="text"
                        name="ville"
                        placeholder="Entrez une ville ou localisation"
                        list="ville-list"
                        x-model="ville"
                        x-on:focus="showVilleList = true"
                        x-on:blur="showVilleList = false"
                    />
                    <datalist id="ville-list">
                        @foreach($villes as $ville)
                            <option value="{{ $ville }}">{{ $ville }}</option>
                        @endforeach
                        @foreach($localisations as $localisation)
                            <option value="{{ $localisation }}">{{ $localisation }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
        </div>
        <!-- end col-lg-3 -->
        
        <div class="col-lg-3 pe-0">
            <div class="input-box">
                <label class="label-text">Date de l'événement</label>
                <div class="form-group">
                    <span class="la la-calendar form-icon"></span>
                    <input
                        class="date-range form-control"
                        type="text"
                        name="daterange"
                        placeholder="Sélectionner une date"
                    />
                </div>
            </div>
        </div>
        <!-- end col-lg-3 -->
        
        <div class="col-lg-3 pe-0">
            <div class="input-box">
                <label class="label-text">Type d'événement</label>
                <div class="form-group">
                    <select class="form-select" name="event_type" x-model="eventType">
                        <option value="">Sélectionner</option>
                        @foreach($eventTypes as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!-- end col-lg-3 -->
        
        <div class="col-lg-3">
            <div class="input-box">
                <label class="label-text">Nombre d'invités</label>
                <div class="form-group">
                  <div style="position: relative;">
                  <span class="la la-users form-icon"></span>
                    <input
                        class="form-control"
                        type="text"
                        name="capacite"
                        placeholder="Nombre de personnes"
                        x-model="capacite"
                    />
                  </div>
                  
                    <small class="form-text text-muted">Capacité maximale disponible: {{ $maxCapacite }} places</small>
                </div>
            </div>
        </div>
        <!-- end col-lg-3 -->
        
        <div class="col-lg-12">
            <div class="pt-2 text-center btn-box">
                <button type="submit" class="theme-btn">
                    <i class="mr-1 la la-search"></i> Rechercher
                </button>
            </div>
        </div>
    </form>
</div>

<style>
    .custom-datalist {
        transition: all 0.3s;
    }
    
    .custom-datalist:focus {
        box-shadow: 0 0 0 3px rgba(40, 125, 250, 0.2) !important;
    }
    
    .form-icon {
        position: absolute;
        top: 50% !important;
        transform: translateY(-50%);
        left: 15px !important;
        font-size: 18px;
        color: #287dfa;
    }
    
    .form-group {
        margin-bottom: 0.5rem !important;
        position: relative !important;
    }
    
    .form-control, .form-select {
        padding-left: 40px;
        height: 50px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }
    
    .btn-box {
        margin-top: 10px;
    }
    
    input.form-control::placeholder {
        color: #9e9e9e;
    }
    
    .form-text {
        font-size: 12px;
        display: block;
        margin-top: 5px;
    }
</style> 