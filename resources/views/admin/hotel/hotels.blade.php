@extends('admin.layouts.layout-admin')
@section('content-admin')

<x-admin.dashboard-panel class="">
    <!-- Conteneur de toasts pour les notifications -->
    <x-admin.toast-container />
    
    <div class="">
        <!-- En-tête de la page -->
        <div class="mb-6">
            <x-admin.page-header 
                title="Gestion des Hôtels" 
                description="Gérez vos hôtels, salles de réception et chambres efficacement"
                :count="$hotels->count()"
                countLabel="Hôtels"
                icon="building" 
            />
        </div>

        <!-- Barre d'actions (recherche et boutons) -->
        <div class="mb-6">
            <x-admin.action-bar 
                createRoute="{{ route('admin.hotels.create') }}"
                createLabel="Créer un hôtel"
                searchPlaceholder="Rechercher des hôtels..."
            />
        </div>

        <!-- Tableau des hôtels -->
        <x-admin.hotel-table :hotels="$hotels" />
    </div>  
</x-admin.dashboard-panel>

<!-- CSRF Token pour les requêtes AJAX -->
<meta name="csrf-token" content="{{ csrf_token() }}">

@if(session('toast'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.dispatchEvent(new CustomEvent('show-toast', {
                detail: {
                    type: "{{ session('toast.type') }}",
                    message: "{{ session('toast.message') }}"
                }
            }));
        });
    </script>
@endif

<!-- Initialiser les icônes Lucide -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide) {
            window.lucide.createIcons();
        }
    });
</script>
@endsection
