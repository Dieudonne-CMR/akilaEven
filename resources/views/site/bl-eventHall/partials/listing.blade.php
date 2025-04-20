@php
    use App\Models\EventHall;
    
    // Calculer le nombre total de salles
    $totalEventHalls = $eventHalls->total();
@endphp

<div class="event-hall-listing">
    <!-- En-tête de la liste -->
    <div class="p-3 mb-4 bg-white rounded shadow-sm listing-header d-flex justify-content-between align-items-center">
        <div>
            <h4 style="color:#9ca3af" class="mb-0">{{ $totalEventHalls > 10 ? $totalEventHalls : '0' . $totalEventHalls }} résultat(s) trouvé(s)</h4>
          
        </div>
        
        <div class="d-flex align-items-center">
            <!-- Tri -->
            <div class="me-3">
                <select class="form-select" id="sort-select" onchange="window.location.href=this.value">
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'default']) }}" {{ request()->input('sort', 'default') == 'default' ? 'selected' : '' }}>
                        Tri par défaut
                    </option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" {{ request()->input('sort') == 'price_asc' ? 'selected' : '' }}>
                        Prix (croissant)
                    </option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" {{ request()->input('sort') == 'price_desc' ? 'selected' : '' }}>
                        Prix (décroissant)
                    </option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'capacity_asc']) }}" {{ request()->input('sort') == 'capacity_asc' ? 'selected' : '' }}>
                        Capacité (croissante)
                    </option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'capacity_desc']) }}" {{ request()->input('sort') == 'capacity_desc' ? 'selected' : '' }}>
                        Capacité (décroissante)
                    </option>
                </select>
            </div>
        
        </div>
    </div>
    
    <!-- Liste des salles de fêtes -->
    @if($eventHalls->count() > 0)
        <div class="row" id="event-halls-container">
            @foreach($eventHalls as $eventHall)
                <div class="mb-4 col-lg-6">
                    <x-event-hall.card :eventHall="$eventHall" />
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-4 pagination-wrap">
            {{ $eventHalls->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="py-5 text-center bg-white rounded shadow-sm no-results">
            <i class="la la-search fa-3x text-muted"></i>
            <h3 class="mt-3">Aucune salle de fête trouvée</h3>
            <p class="text-muted">Veuillez modifier vos critères de recherche et réessayer.</p>
            <a href="{{ route('site.sallesfetes') }}" class="mt-3 btn btn-primary">
                <i class="la la-redo"></i> Réinitialiser les filtres
            </a>
        </div>
    @endif
</div>


<style>
    /* Styles pour la liste des salles de fêtes */
    .listing-header h4 {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
    }
    
   
    
    /* Personnalisation de la pagination */
    .pagination {
        justify-content: center;
    }
    
    .page-item.active .page-link {
        background-color: #287dfa;
        border-color: #287dfa;
    }
    
    .page-link {
        color: #287dfa;
    }
    
    .page-link:hover {
        color: #0056b3;
    }
   
    
    /* Style pour les résultats vides */
    .no-results {
        padding: 50px 0;
    }
    
    .no-results i {
        color: #ddd;
    }
</style> 