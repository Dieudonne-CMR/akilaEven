@extends('admin.layouts.layout-admin')
@section('content-admin')

<x-layout.dashboard-panel class="">
    <!-- Conteneur de toasts pour les notifications -->
    <x-ui.toast-container />
    
    <div class="">
        <!-- En-tête de la page -->
        <div class="mb-6">
            <x-ui.page-header 
                title="Gestion des Agences" 
                description="Gérez les agences de la plateforme"
                :count="$agences->count()"
                countLabel="Agences"
                icon="home" 
            />
        </div>
        <div class="avatar">
            <div class="rounded-full size-6">
              <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-1.png" alt="avatar" />
            </div>
          </div>
          
          <div class="avatar">
            <div class="rounded-full size-10">
              <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-1.png" alt="avatar" />
            </div>
          </div>
          
          <div class="avatar">
            <div class="rounded-full size-14">
              <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-1.png" alt="avatar" />
            </div>
          </div>
          
          <div class="avatar">
            <div class="rounded-full size-16">
              <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-1.png" alt="avatar" />
            </div>
          </div>
        <div class="card sm:max-w-sm">
            <div class="card-body">
              <h5 class="card-title mb-2.5">Welcome to Our Service</h5>
              <p class="mb-4">Discover the features and benefits that our service offers. Enhance your experience with our user-friendly platform designed to meet all your needs.</p>
              <div class="card-actions">
                <button class="btn btn-primary">Learn More</button>
              </div>
            </div>
          </div>
        <!-- Barre d'actions (recherche et boutons) -->
        <div class="mb-6">
            <x-admin.agence.listing.agence-filters 
                createRoute="{{ route('admin.agences.create') }}"
                createLabel="Créer une agence"
                searchPlaceholder="Rechercher des agences..."
            />
        </div>

        <!-- Tableau des agences -->
        <x-admin.agence.listing.agence-table :agences="$agences" />
    </div>  
</x-layout.dashboard-panel>

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
