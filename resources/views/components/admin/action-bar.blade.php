@props(['createRoute', 'createLabel', 'searchPlaceholder'])

<div 
    x-data="actionBarComponent()" 
    class="p-4 bg-white rounded-lg shadow-sm dark:bg-gray-800"
>
    <div class="flex flex-col space-y-3 md:flex-row md:items-center md:justify-between md:space-y-0">
        <!-- SearchInput -->
        <div class="relative w-full md:w-1/3">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i data-lucide="search" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
            </div>
            <input 
                type="text" 
                x-model="searchQuery" 
                @input.debounce.300ms="search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                placeholder="{{ $searchPlaceholder }}"
            >
        </div>
        
        <!-- Action Buttons -->
        <div class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center md:space-y-0 md:space-x-3">
            <!-- AddButton -->
            <a
                href="{{ $createRoute }}"
                class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300"
            >
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                {{ $createLabel }}
            </a>
            
            <!-- BulkActionsDropdown -->
            <button 
                id="bulkActionsDropdownButton" 
                data-dropdown-toggle="bulkActionsDropdown" 
                class="flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                :class="{ 'opacity-50 cursor-not-allowed': !hasSelection }"
                :disabled="!hasSelection"
            >
                <i data-lucide="more-horizontal" class="w-4 h-4 mr-2"></i>
                Actions groupées
                <i data-lucide="chevron-down" class="w-4 h-4 ml-2"></i>
            </button>
            
            <!-- Dropdown menu -->
            <div id="bulkActionsDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="bulkActionsDropdownButton">
                    <li>
                        <a @click="bulkDelete" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <i data-lucide="trash-2" class="w-4 h-4 mr-2 text-red-500"></i>
                            Supprimer la sélection
                        </a>
                    </li>
                    <li>
                        <a @click="exportPDF" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                            Exporter en PDF
                        </a>
                    </li>
                    <li>
                        <a @click="exportCSV" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <i data-lucide="file-spreadsheet" class="w-4 h-4 mr-2"></i>
                            Exporter en CSV
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function actionBarComponent() {
        return {
            searchQuery: '',
            hasSelection: false,
            
            search() {
                console.log('Recherche:', this.searchQuery);
                // Émettre un événement global pour informer le tableau
                document.dispatchEvent(new CustomEvent('search-hotels', { 
                    detail: { query: this.searchQuery },
                    bubbles: true,
                    cancelable: true
                }));
            },
            
            bulkDelete() {
                if(confirm('Êtes-vous sûr de vouloir supprimer les hôtels sélectionnés?')) {
                    const selectedIds = document.querySelectorAll('input[name="selected_hotels[]"]:checked');
                    if(selectedIds.length === 0) return;
                    
                    const ids = Array.from(selectedIds).map(el => el.value);
                    
                    fetch('{{ route("admin.hotels.bulk-delete") }}', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ ids })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            window.location.reload();
                        }
                    });
                }
            },
            
            exportPDF() {
                // Fonctionnalité à implémenter
            },
            
            exportCSV() {
                // Fonctionnalité à implémenter
            },
            
            init() {

              // Écouter les événements de sélection
              window.addEventListener('selection-change', (event) => {
                  this.hasSelection = event.detail.hasSelection;
              });
              
              if (window.lucide) {
                  window.lucide.createIcons();
              }
            }
        }
    }
</script> 