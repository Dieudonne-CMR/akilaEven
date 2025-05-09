@extends('admin.layouts.layout-admin')
@section('content-admin')

<x-admin.dashboard-panel class="">
   <!-- Contenu Principal -->
   
   <div class="">
      <!-- En-tête de la page -->
      <x-admin.location-header-listing :locationsCount="count($locations)" />

      <!-- Barre d'actions et filtres -->
      <x-admin.location-filters :filters="$filters" />

      <!-- Tableau des locations -->
      <x-admin.location-table :locations="$locations" />
   </div>

</x-admin.dashboard-panel>
<!-- CSRF Token pour les requêtes AJAX -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@push('scripts')

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

<!-- Initialiser les icônes Lucide et Flowbite -->
<script>
   document.addEventListener('DOMContentLoaded', function() {
      // Initialiser les icônes Lucide
      if (window.lucide) {
            window.lucide.createIcons();
      }
      
      // Initialiser Flowbite (pour les dropdowns)
      if (typeof initFlowbite === 'function') {
            initFlowbite();
      }
      
      // Réinitialiser les dropdowns après chaque mise à jour AJAX
      window.addEventListener('refreshComponents', function() {
            if (typeof initFlowbite === 'function') {
               initFlowbite();
            }
      });
   });
</script>

@endpush
@endsection