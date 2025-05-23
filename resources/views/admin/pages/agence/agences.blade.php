@extends('admin.layouts.layout-admin')
@section('content-admin')

<style>
  .dt-scroll-body thead {
    display: none !important;
  }
</style>
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
                <button class="rounded-md default-btn">Learn More</button>
              </div>
            </div>
          </div>
        <!-- Barre d'actions (recherche et boutons) -->
        <div class="dropdown relative inline-flex rtl:[--placement:bottom-end]">
          <button id="dropdown-default" type="button" class="dropdown-toggle default-btn" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
            Dropdown
            <span class="icon-[tabler--chevron-down] dropdown-open:rotate-180 size-4"></span>
          </button>
          <ul class="hidden dropdown-menu dropdown-open:opacity-100 min-w-60" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-default">
            <li><a class="dropdown-item" href="#">My Profile</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Billing</a></li>
            <li><a class="dropdown-item" href="#">FAQs</a></li>
          </ul>
        </div>
    

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
<script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="./assets/vendor/datatables.net/js/dataTables.min.js"></script>
<script src="./assets/vendor/preline/dist/preline.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<script>
  window.addEventListener('load', () => {
  

  const inputs = document.querySelectorAll('.dt-container thead input');

  inputs.forEach((input) => {
    input.addEventListener('keydown', function (evt) {
      if ((evt.metaKey || evt.ctrlKey) && evt.key === 'a') this.select();
    });
  });
});
</script>
{{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
<script src="../node_modules/flyonui/flyonui.js"></script>
<script src="../node_modules/flyonui/dist/datatable.js"></script>  --}}
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
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
     /*    document.querySelectorAll('[data-datatable]').forEach(el => {
        new FlyonUI.DataTable(el);
      }); */
    });
 
</script>

@endsection
