@props(['createRoute', 'createLabel', 'searchPlaceholder'])

<div 
    x-data="actionBarComponent()" 
    class="p-4 bg-white rounded-lg shadow-sm dark:bg-gray-800"
>
    <div class="flex flex-col gap-4 space-y-3 md:flex-row md:items-center md:justify-between md:space-y-0">
        <!-- SearchInput -->
        <div class="relative w-full max-w-sm">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i data-lucide="search" class="size-4 text-muted-foreground"></i>
            </div>            
            <x-ui.text-input               
                
                x-model="searchQuery" 
                @input.debounce.300ms="search" 
                type="text" 
                placeholder="Rechercher des agences..."
            />         
        </div>
        
        <!-- Action Buttons -->
        <div class="flex flex-col space-y-3 shrink-0 md:flex-row md:items-center md:space-y-0 md:space-x-3">
            <!-- AddButton -->
            <a
                href="{{ $createRoute }}"
                class="shadow-none default-btn focus:ring-4 focus:ring-primary/50"
            >
                <i data-lucide="plus" class="size-4"></i>
                {{ $createLabel }}
            </a>
           
            
            <!-- BulkActionsDropdown -->
            <div     
            class=" dropdown relative inline-flex rtl:[--placement:bottom-end]">
                <button :class="{ 'opacity-50 cursor-not-allowed pointer-events-none': !hasSelection }"id="bulkActionsDropdownButton" type="button" class="w-full dropdown-toggle btn-outline" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    <i data-lucide="more-horizontal" class="w-4 h-4 mr-2"></i>
                    Actions
                    <span class="icon-[tabler--chevron-down] dropdown-open:rotate-180 size-4"></span>
                    {{-- <i data-lucide="chevron-down" class="w-4 h-4 ml-2"></i> --}}
                </button>
                <ul class="z-50 hidden dropdown-menu dropdown-open:opacity-100 min-w-60" role="menu" aria-orientation="vertical" aria-labelledby="bulkActionsDropdownButton">
                    
                    <li>
                        <a @click="exportPDF" class="cursor-pointer dropdown-item">
                            <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                            Exporter en PDF
                        </a>
                    </li>
                    <li>
                        <a @click="exportCSV" class="cursor-pointer dropdown-item">
                            <i data-lucide="file-spreadsheet" class="w-4 h-4 mr-2"></i>
                            Exporter en CSV
                        </a>
                    </li>
                    <li class="gap-2 p-2 dropdown-footer">
                        <a @click="bulkDelete" class="justify-start btn btn-error btn-soft btn-block">
                            <i data-lucide="trash-2" class="size-4"></i>
                            Supprimer la sélection
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
                document.dispatchEvent(new CustomEvent('search-agences', { 
                    detail: { query: this.searchQuery },
                    bubbles: true,
                    cancelable: true
                }));
            },
            
            // Supprimer plusieurs agences à la fois.
            bulkDelete() {
                if(confirm('Êtes-vous sûr de vouloir supprimer les agences sélectionnés?')) {
                    const selectedIds = document.querySelectorAll('input[name="selected_agences[]"]:checked');
                    if(selectedIds.length === 0) return;
                    
                    const ids = Array.from(selectedIds).map(el => el.value);
                    
                    fetch('{{ route("admin.agences.bulk-delete") }}', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ ids })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if(data.success) {
                            const toastEvent = new CustomEvent('show-toast', {
                                detail: {
                                    type: 'success',
                                    message: 'Les agences ont été supprimées avec succès.'
                                }
                            });
                            window.dispatchEvent(toastEvent);
                            /* window.location.reload(); */
                            // Afficher un message de succès avec le composant toast
                            
                        }
                        else{
                            const toastEvent = new CustomEvent('show-toast', {
                                detail: {
                                    type: 'error',
                                    message: 'Une erreur est survenue lors de la suppression des agences.'
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        const toastEvent = new CustomEvent('show-toast', {
                            detail: {
                                type: 'error',
                                message: 'Une erreur est survenue lors de la suppression des agences.'
                            }
                        });
                        window.dispatchEvent(toastEvent);
                    });
                    ;
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