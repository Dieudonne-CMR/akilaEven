@props(['eventHalls' => []])
@if(session('success'))
<x-ui.toast type="success" message="{{ session('success')}}" position="bottom-right" />
@endif
@if(session('error'))
<x-ui.toast type="error" message="{{ session('error')}}" position="bottom-right" />
@endif

<div 
    x-data="eventHallTableComponent({{ json_encode($eventHalls) }})" 
    class="relative bg-white shadow-md sm:rounded-lg"
    @search-event-halls.window="handleSearch($event)"
    @filter-event-halls-type.window="handleFilterEventType($event)"
    @bulk-delete-event-halls.window="bulkDelete">
    <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
        <div class="flex items-center flex-1 space-x-4">
            <h5>
                <span class="font-bold text-gray-900" x-text="filteredEventHalls.length + ' Salles de fête'"></span>
            </h5>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input 
                                id="checkbox-all" 
                                type="checkbox" 
                                x-model="selectAll"
                                @click="toggleSelectAll"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                            >
                            <label for="checkbox-all" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('nom_salle')">
                        <div class="flex items-center">
                            <i data-lucide="building" class="w-4 h-4 mr-1"></i>
                            Salle
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('localisation')">
                        <div class="flex items-center">
                            <i data-lucide="map-pin" class="w-4 h-4 mr-1"></i>
                            Emplacement
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('prix')">
                        <div class="flex items-center">
                            <i data-lucide="tag" class="w-4 h-4 mr-1"></i>
                            Prix
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('capacite')">
                        <div class="flex items-center">
                            <i data-lucide="users" class="w-4 h-4 mr-1"></i>
                            Capacité
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('area')">
                        <div class="flex items-center">
                            <i data-lucide="square" class="w-4 h-4 mr-1"></i>
                            Surface
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(eventHall, index) in paginatedEventHalls" :key="eventHall.id">
                    <tr class="border-b hover:bg-gray-100">
                        <td class="w-4 px-4 py-3">
                            <div class="flex items-center">
                                <input 
                                    :id="'checkbox-table-' + eventHall.id" 
                                    type="checkbox" 
                                    x-model="selectedEventHalls"
                                    :value="parseInt(eventHall.id)"
                                    @change="updateSelectAll"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                >
                                <label :for="'checkbox-table-' + eventHall.id" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                            <img :src="'/storage/' + eventHall.photo" class="object-cover w-10 h-10 mr-3 rounded-full" :alt="eventHall.nom_salle">
                            <span x-text="eventHall.nom_salle"></span>
                        </th>
                        <td class="px-4 py-3" x-text="eventHall.ville.nom + ', ' + eventHall.localisation"></td>
                        <td class="px-4 py-3">
                            <div x-text="formatPrix(eventHall.prix)"></div>
                        </td>
                        <td class="px-4 py-3">
                            <div x-text="eventHall.capacite + ' personnes'"></div>
                        </td>
                        <td class="px-4 py-3">
                            <div x-text="eventHall.area + ' m²'"></div>
                        </td>
                        <td class="px-4 py-3">
                            <button 
                                :id="'dropdownMenuButton-' + eventHall.id" 
                                :data-dropdown-toggle="'dropdownMenu-' + eventHall.id" 
                                class="inline-flex items-center p-1 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50" 
                                type="button"
                            >
                                <i data-lucide="ellipsis" class="w-5 h-5"></i>
                            </button>
                            
                            <!-- Menu déroulant -->
                            <div :id="'dropdownMenu-' + eventHall.id" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                <ul class="py-2 text-sm text-gray-700" :aria-labelledby="'dropdownMenuButton-' + eventHall.id">
                                    <li>
                                        <a :href="'/admin/event-halls/' + eventHall.id" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                                            <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                            Voir détails
                                        </a>
                                    </li>
                                    <li>
                                        <a :href="'/admin/event-halls/' + eventHall.id + '/edit'" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                                            <i data-lucide="edit" class="w-4 h-4 mr-2 text-green-500"></i>
                                            Modifier
                                        </a>
                                    </li>
                                    <li>
                                        <a @click="deleteEventHall(eventHall.id)" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                                            <i data-lucide="trash-2" class="w-4 h-4 mr-2 text-red-500"></i>
                                            Supprimer
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </template>
                <template x-if="filteredEventHalls.length === 0">
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i data-lucide="file-question" class="w-10 h-10 mb-2 text-gray-400"></i>
                                <h3 class="text-lg font-medium text-gray-900">Aucune salle de fête trouvée</h3>
                                <p class="mb-4 text-sm text-gray-500">Essayez de modifier vos critères de recherche ou de créer une nouvelle salle</p>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
    <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0">
        <span class="text-sm font-normal text-gray-500">
            Affichage de <span class="font-semibold text-gray-900" x-text="paginationInfo.start + 1"></span> à <span class="font-semibold text-gray-900" x-text="paginationInfo.end"></span> sur <span class="font-semibold text-gray-900" x-text="filteredEventHalls.length"></span> Salles de fête
        </span>
        <ul class="inline-flex items-stretch -space-x-px">
            <li>
                <a 
                    @click="prevPage" 
                    :class="{ 'cursor-not-allowed opacity-50': currentPage === 1 }"
                    class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                >
                    <span class="sr-only">Précédent</span>
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </a>
            </li>
            <template x-for="page in totalPages" :key="page">
                <li>
                    <a 
                        @click="goToPage(page)" 
                        class="flex items-center justify-center px-3 py-2 text-sm leading-tight border"
                        :class="{'bg-blue-50 border-blue-300 text-blue-600 hover:bg-blue-100 hover:text-blue-700': currentPage === page, 'bg-white border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700': currentPage !== page}"
                    >
                        <span x-text="page"></span>
                    </a>
                </li>
            </template>
            <li>
                <a 
                    @click="nextPage" 
                    :class="{ 'cursor-not-allowed opacity-50': currentPage === totalPages }"
                    class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                >
                    <span class="sr-only">Suivant</span>
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </a>
            </li>
        </ul>
    </nav>
    
    <!-- Confirmation modal -->
   {{--  <div 
    x-data="{ showConfirmModal: false, eventHallId: null }"
    @show-confirm-modal.window="showConfirmModal = true; eventHallId = $event.detail.eventHallId"
    class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50"
    x-show="showConfirmModal"
    x-cloak>
        <div class="relative w-full max-w-md p-4">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-center justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Confirmation de suppression
                    </h3>
                    <button @click="showConfirmModal = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
                <div class="p-4">
                    <p class="text-base text-gray-500">
                        Êtes-vous sûr de vouloir supprimer cette salle de fête ? Cette action est irréversible.
                    </p>
                </div>
                <div class="flex justify-end p-4 border-t">
                    <button @click="showConfirmModal = false" type="button" class="bg-white text-gray-500 hover:text-gray-700 border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2">
                        Annuler
                    </button>
                    <button @click="deleteEventHall(eventHallId)" type="button" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div> --}}
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('eventHallTableComponent', (initialEventHalls) => ({
            eventHalls: initialEventHalls,
            filteredEventHalls: [],
            paginatedEventHalls: [],
            sortField: 'nom_salle',
            sortDirection: 'asc',
            currentPage: 1,
            perPage: 10,
            searchQuery: '',
            eventTypeFilter: [],
            selectedEventHalls: [],
            selectAll: false,
            
            get hasSelection() {
                return this.selectedEventHalls.length > 0;
            },
            
            get totalPages() {
                return Math.ceil(this.filteredEventHalls.length / this.perPage);
            },
            
            get paginationInfo() {
                const start = (this.currentPage - 1) * this.perPage;
                const end = Math.min(start + this.perPage, this.filteredEventHalls.length);
                return { start, end };
            },
            
            init() {
                this.applyFiltersAndSort();
                
                this.$watch('selectedEventHalls', () => {
                    this.updateSelectAll();
                });
                
                this.updateIcons();
            },
            
            updateIcons() {
                setTimeout(() => {
                    if (window.lucide) {
                        window.lucide.createIcons();
                    }
                }, 100);
            },
            
            toggleSelectAll() {
                if (!this.selectAll) {
                    this.selectedEventHalls = this.paginatedEventHalls.map(hall => parseInt(hall.id));
                    this.selectAll = true;
                } else {
                    this.selectedEventHalls = [];
                    this.selectAll = false;
                }
            },
            
            updateSelectAll() {
                this.selectAll = this.paginatedEventHalls.every(hall => 
                    this.selectedEventHalls.includes(parseInt(hall.id))
                );
            },
            
            handleSearch(event) {
                this.searchQuery = event.detail.query;
                this.applyFiltersAndSort();
            },
            
            handleFilterEventType(event) {
                this.eventTypeFilter = event.detail.types || [];
                this.applyFiltersAndSort();
            },
            
            applyFiltersAndSort() {
                // Filtrage
                let result = [...this.eventHalls];
                
                // Filtre de recherche
                if (this.searchQuery) {
                    const query = this.searchQuery.toLowerCase();
                    result = result.filter(hall => 
                        hall.nom_salle.toLowerCase().includes(query) || 
                        hall.description.toLowerCase().includes(query) || 
                        hall.localisation.toLowerCase().includes(query) ||
                        (hall.ville && hall.ville.nom.toLowerCase().includes(query))
                    );
                }
                
                // Filtre par type d'événement
                if (this.eventTypeFilter.length > 0) {
                    result = result.filter(hall => {
                        // Vérifier si la salle a des types d'événements
                        if (!hall.event_types || !Array.isArray(hall.event_types)) {
                            return false;
                        }
                        
                        // Vérifier si au moins un des types filtrés est présent
                        return this.eventTypeFilter.some(type => 
                            hall.event_types.includes(type)
                        );
                    });
                }
                
                // Tri
                result.sort((a, b) => {
                    let aValue, bValue;
                    
                    // Gestion spéciale pour les propriétés imbriquées comme ville.nom
                    if (this.sortField === 'ville.nom') {
                        aValue = a.ville ? a.ville.nom : '';
                        bValue = b.ville ? b.ville.nom : '';
                    } else {
                        aValue = a[this.sortField];
                        bValue = b[this.sortField];
                    }
                    
                    // Conversion en minuscules pour les chaînes
                    if (typeof aValue === 'string' && typeof bValue === 'string') {
                        aValue = aValue.toLowerCase();
                        bValue = bValue.toLowerCase();
                    }
                    
                    // Comparaison selon la direction
                    if (this.sortDirection === 'asc') {
                        return aValue < bValue ? -1 : aValue > bValue ? 1 : 0;
                    } else {
                        return aValue > bValue ? -1 : aValue < bValue ? 1 : 0;
                    }
                });
                
                this.filteredEventHalls = result;
                this.updatePaginatedEventHalls();
            },
            
            updatePaginatedEventHalls() {
                const start = (this.currentPage - 1) * this.perPage;
                const end = start + this.perPage;
                this.paginatedEventHalls = this.filteredEventHalls.slice(start, end);
                
                if (this.currentPage > this.totalPages && this.totalPages > 0) {
                    this.currentPage = 1;
                    this.updatePaginatedEventHalls();
                }
            },
            
            sortBy(field) {
                // Si on clique sur le même champ, on inverse la direction
                if (this.sortField === field) {
                    this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    // Sinon, on trie par le nouveau champ en ascendant
                    this.sortField = field;
                    this.sortDirection = 'asc';
                }
                
                this.applyFiltersAndSort();
            },
            
            prevPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                    this.updatePaginatedEventHalls();
                }
            },
            
            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.currentPage++;
                    this.updatePaginatedEventHalls();
                }
            },
            
            goToPage(page) {
                this.currentPage = page;
                this.updatePaginatedEventHalls();
            },
            
            deleteEventHall(id) {
                fetch(`/admin/event-halls/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Supprimer l'élément du tableau
                        this.eventHalls = this.eventHalls.filter(hall => hall.id !== id);
                        this.applyFiltersAndSort();
                        
                        window.dispatchEvent(new CustomEvent('toast', {
                            detail: {
                                message: 'Salle de fête supprimée avec succès',
                                type: 'success'
                            }
                        }));
                    } else {
                        window.dispatchEvent(new CustomEvent('toast', {
                            detail: {
                                message: data.message || 'Une erreur est survenue',
                                type: 'error'
                            }
                        }));
                    }
                    document.dispatchEvent(new CustomEvent('close-confirm-modal'));
                })
                .catch(error => {
                    console.error(error);
                    window.dispatchEvent(new CustomEvent('toast', {
                        detail: {
                            message: 'Une erreur est survenue',
                            type: 'error'
                        }
                    }));
                    document.dispatchEvent(new CustomEvent('close-confirm-modal'));
                });
            },
            
            bulkDelete() {
                if (this.selectedEventHalls.length === 0) return;
                
                fetch('/admin/event-halls/bulk-delete', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        ids: this.selectedEventHalls
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Supprimer les éléments du tableau
                        this.eventHalls = this.eventHalls.filter(hall => !this.selectedEventHalls.includes(parseInt(hall.id)));
                        this.selectedEventHalls = [];
                        this.applyFiltersAndSort();
                        
                        window.dispatchEvent(new CustomEvent('toast', {
                            detail: {
                                message: `${data.count} salles de fête supprimées avec succès`,
                                type: 'success'
                            }
                        }));
                    } else {
                        window.dispatchEvent(new CustomEvent('toast', {
                            detail: {
                                message: data.message || 'Une erreur est survenue',
                                type: 'error'
                            }
                        }));
                    }
                })
                .catch(error => {
                    console.error(error);
                    window.dispatchEvent(new CustomEvent('toast', {
                        detail: {
                            message: 'Une erreur est survenue',
                            type: 'error'
                        }
                    }));
                });
            },
            
            formatPrix(prix) {
                return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'XAF' }).format(prix);
            }
        }));
    });
</script>
@endpush 