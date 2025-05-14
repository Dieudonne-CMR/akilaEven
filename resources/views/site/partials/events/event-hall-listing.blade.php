@php
    use App\Models\EventHall;
    
    // Calculer le nombre total de salles
    $totalEventHalls = $eventHalls->total();
@endphp

<div class="event-hall-listing">
    <!-- En-tête de la liste -->
    <div class="p-3 mb-4 bg-white rounded listing-header d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0 results-count">{{ $totalEventHalls > 9 ? $totalEventHalls : '0' . $totalEventHalls }} résultat(s) trouvé(s)</h4>
        </div>
        
        <div class="d-none d-lg-flex align-items-center">
            <!-- Tri - masqué selon la demande -->
        </div>
    </div>
    
    <!-- Liste des salles de fêtes -->
    @if($eventHalls->count() > 0)
        <div class="row" id="event-halls-container">
            @foreach($eventHalls as $eventHall)
                <div class="mb-4 col-md-6 col-lg-6 col-xl-6">
                    <x-event-hall.card :eventHall="$eventHall" />
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-4 pagination-wrap">
            {{ $eventHalls->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="py-5 text-center bg-white rounded no-results">
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
    .listing-header {
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    }
    
    .results-count {
        font-size: 1.1rem;
        font-weight: 500;
        color: #9ca3af;
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
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    }
    
    .no-results i {
        color: #ddd;
    }
    
    /* Style pour les cartes */
    #event-halls-container {
        margin-left: -10px;
        margin-right: -10px;
    }
    
    #event-halls-container > div {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    /* Styles pour les contrôles de carousel */
    .owl-nav {
        position: absolute;
        top: 50%;
        width: 100%;
        transform: translateY(-50%);
        display: flex;
        justify-content: space-between;
        padding: 0 10px;
    }
    
    .owl-nav button {
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.9) !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }
    
    .owl-nav button i {
        font-size: 1.2rem;
        color: #333;
    }
    
    .owl-dots {
        position: absolute;
        bottom: 10px;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: center;
    }
    
    .owl-dots .owl-dot {
        width: 8px;
        height: 8px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        margin: 0 3px;
    }
    
    .owl-dots .owl-dot.active {
        background: #287dfa;
    }
</style> 