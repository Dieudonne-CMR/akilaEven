@props(['locations' => []])
@if(session('success'))
<x-ui.toast type="success" message="{{ session('success')}}" position="bottom-right" />
@endif
@if(session('error'))
<x-ui.toast type="error" message="{{ session('error')}}" position="bottom-right" />
     
@endif



<div 
    x-data="locationTableComponent({{ json_encode($locations) }})" 
    class="relative bg-white shadow-md sm:rounded-lg"
    @search-locations.window="handleSearch($event)"
    @filter-locations-logement.window="handleFilterLogement($event)"
    @filter-locations-type.window="handleFilterType($event)"
    @bulk-delete-locations.window="bulkDelete">
    <div class="flex items-center justify-between p-4 bg-white">
        <span class="font-bold text-gray-900" x-text="filteredLocations.length + ' Locations'"></span>
       {{--  <a href="{{ route('admin.location.create') }}" class="px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
            <i class="mr-1 fas fa-plus"></i> Ajouter une location
        </a> --}}
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-4 py-3">
                        <div class="flex items-center">
                            <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                            <label for="checkbox-all" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3" @click="sortBy('name')">
                        <div class="flex items-center">
                            Nom
                            <template x-if="sortColumn === 'name'">
                                <span class="ml-1">
                                    <i x-show="sortDirection === 'asc'" class="fas fa-sort-up"></i>
                                    <i x-show="sortDirection === 'desc'" class="fas fa-sort-down"></i>
                                </span>
                            </template>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3" @click="sortBy('city')">
                        <div class="flex items-center">
                            Ville
                            <template x-if="sortColumn === 'city'">
                                <span class="ml-1">
                                    <i x-show="sortDirection === 'asc'" class="fas fa-sort-up"></i>
                                    <i x-show="sortDirection === 'desc'" class="fas fa-sort-down"></i>
                                </span>
                            </template>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3" @click="sortBy('type_logement')">
                        <div class="flex items-center">
                            Type
                            <template x-if="sortColumn === 'type_logement'">
                                <span class="ml-1">
                                    <i x-show="sortDirection === 'asc'" class="fas fa-sort-up"></i>
                                    <i x-show="sortDirection === 'desc'" class="fas fa-sort-down"></i>
                                </span>
                            </template>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3" @click="sortBy('prix')">
                        <div class="flex items-center">
                            Prix
                            <template x-if="sortColumn === 'prix'">
                                <span class="ml-1">
                                    <i x-show="sortDirection === 'asc'" class="fas fa-sort-up"></i>
                                    <i x-show="sortDirection === 'desc'" class="fas fa-sort-down"></i>
                                </span>
                            </template>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <template x-for="location in paginatedLocations" :key="location.id">
                    <tr class="border-b hover:bg-gray-100">
                        <td class="w-4 px-4 py-2">
                            <div class="flex items-center">
                                <input :id="'checkbox-' + location.id" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label :for="'checkbox-' + location.id" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                            <img :src="location.thumbnail || '/images/placeholder.jpg'" class="object-cover w-10 h-10 mr-3 rounded-full" :alt="location.name">
                            <div class="text-sm">
                                <div x-text="location.name" class="font-medium"></div>
                                <div class="font-normal text-gray-500" x-text="location.agence_name"></div>
                            </div>
                        </th>
                        <td class="px-4 py-2" x-text="location.city"></td>
                        <td class="px-4 py-2">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full" x-text="ucfirst(location.type_logement)"></span>
                        </td>
                        <td class="px-4 py-2">
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full" x-text="ucfirst(location.type_location)"></span>
                            <div x-text="new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'XAF' }).format(location.prix)"></div>
                        </td>
                        <td class="px-4 py-2">
                            <button type="button" :id="'dropdownMenuButton-' + location.id" data-dropdown-toggle="dropdown" class="inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-800 focus:outline-none" @click="$refs['dropdown-' + location.id].classList.toggle('hidden')">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div :id="'dropdown-' + location.id" x-ref="'dropdown-' + location.id" class="absolute z-10 hidden divide-y divide-gray-100 rounded-lg shadow w-44">
                                <ul class="py-2 text-sm text-gray-700" :aria-labelledby="'dropdownMenuButton-' + location.id">
                                    <li>
                                        <a :href="'/admin/locations/' + location.id" class="block px-4 py-2 cursor-pointer hover:bg-gray-100">
                                            <i class="mr-2 fas fa-eye"></i> Voir
                                        </a>
                                    </li>
                                    <li>
                                        <a :href="'/admin/locations/' + location.id + '/edit'" class="block px-4 py-2 cursor-pointer hover:bg-gray-100">
                                            <i class="mr-2 fas fa-edit"></i> Modifier
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" @click.prevent="confirmDelete(location.id)" class="block px-4 py-2 cursor-pointer hover:bg-gray-100">
                                            <i class="mr-2 text-red-500 fas fa-trash"></i> Supprimer
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </template>
                
                <!-- Empty state -->
                <tr x-show="filteredLocations.length === 0">
                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900">Aucune location trouvée</h3>
                            <p class="mb-4 text-sm text-gray-500">Essayez de modifier vos critères de recherche ou de créer une nouvelle location</p>
                           {{--  <a href="{{ route('admin.locations.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                <i class="mr-1 fas fa-plus"></i> Créer une location
                            </a> --}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500">
            Affichage de <span class="font-semibold text-gray-900" x-text="paginationInfo.start + 1"></span> à <span class="font-semibold text-gray-900" x-text="paginationInfo.end"></span> sur <span class="font-semibold text-gray-900" x-text="filteredLocations.length"></span>
        </span>
        <ul class="inline-flex items-stretch -space-x-px">
            <li>
                <a href="#" @click.prevent="prevPage()" :class="{ 'cursor-not-allowed opacity-50': currentPage === 1 }" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    <span class="sr-only">Previous</span>
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
            <template x-for="page in totalPages" :key="page">
                <li>
                    <a href="#" @click.prevent="goToPage(page)" 
                    :class="{'bg-blue-50 border-blue-300 text-blue-600 hover:bg-blue-100 hover:text-blue-700': currentPage === page, 'bg-white border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700': currentPage !== page}"
                    class="flex items-center justify-center px-3 py-2 text-sm leading-tight" x-text="page"></a>
                </li>
            </template>
            <li>
                <a href="#" @click.prevent="nextPage()" :class="{ 'cursor-not-allowed opacity-50': currentPage === totalPages || totalPages === 0 }" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    <span class="sr-only">Next</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        </ul>
    </nav>
    
    <!-- Delete Confirmation Modal -->
   {{--  <div x-show="showConfirmModal" class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50">
        <div class="relative max-w-md p-4 mx-auto bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-xl font-bold text-gray-900">Confirmer la suppression</h3>
                <button @click="showConfirmModal = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-4">
                <p class="text-base text-gray-500">Êtes-vous sûr de vouloir supprimer cette location ? Cette action est irréversible.</p>
            </div>
            <div class="flex items-center justify-end p-4 space-x-2 border-t">
                <button @click="showConfirmModal = false" type="button" class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                    Annuler
                </button>
                <button @click="deleteLocation()" type="button" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700">
                    Supprimer
                </button>
            </div>
        </div>
    </div> --}}
</div>



<script>
function locationTableComponent(locations) {
    return {
        locations: locations,
        filteredLocations: [],
        paginatedLocations: [],
        selectedLocations: [],
        selectAll: false,
        sortColumn: 'name',
        sortDirection: 'asc',
        currentPage: 1,
        perPage: 10,
        searchQuery: '',
        selectedType: '',
        selectedCity: '',
        minPrice: '',
        maxPrice: '',
        locationToDelete: null,
        showConfirmModal: false,

        init() {
            this.filteredLocations = [...this.locations];
            this.filterLocations();
        },
        
        get hasSelection() {
            return this.selectedLocations.length > 0;
        },
        
        get totalPages() {
            return Math.ceil(this.filteredLocations.length / this.perPage);
        },
        
        get paginationInfo() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = Math.min(start + this.perPage, this.filteredLocations.length);
            return { start, end };
        },
        
        formatPrix(prix, typeLogement) {
            const formattedPrix = new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'XAF' }).format(prix);
            if (typeLogement === 'meublé') {
                return `${formattedPrix}/jour`;
            } else {
                return `${formattedPrix}/mois`;
            }
        },
        
        ucfirst(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        },
        
        toggleSelectAll() {
            if (!this.selectAll) {
                const visibleLocationIds = this.paginatedLocations.map(location => location.id);
                this.selectedLocations = [...new Set([...this.selectedLocations, ...visibleLocationIds])];
            } else {
                this.selectedLocations = [];
            }
            this.notifySelectionChange();
        },
        
        updateSelectAll() {
            const visibleLocationIds = this.paginatedLocations.map(location => location.id);
            this.selectAll = visibleLocationIds.every(id => this.selectedLocations.includes(id));
            this.notifySelectionChange();
        },
        
        sortBy(column) {
            if (this.sortColumn === column) {
                this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortColumn = column;
                this.sortDirection = 'asc';
            }
            this.filterLocations();
        },
        
        updateIcons() {
            // Utiliser setTimeout pour s'assurer que le DOM est mis à jour avant de recréer les icônes
            setTimeout(() => {
                if (window.lucide) {
                    window.lucide.createIcons();
                }
            }, 0);
        },
        
        filterLocations() {
            let result = [...this.locations];
            
            // Filtre de recherche
            if (this.searchQuery) {
                const query = this.searchQuery.toLowerCase();
                result = result.filter(location => 
                    location.name.toLowerCase().includes(query) || 
                    location.description.toLowerCase().includes(query) ||
                    location.city.toLowerCase().includes(query)
                );
            }
            
            // Filtre par type de logement
            if (this.selectedType) {
                result = result.filter(location => 
                    location.type_logement.toLowerCase() === this.selectedType.toLowerCase()
                );
            }
            
            // Filtre par ville
            if (this.selectedCity) {
                result = result.filter(location => 
                    location.city.toLowerCase() === this.selectedCity.toLowerCase()
                );
            }
            
            // Filtre par prix minimum
            if (this.minPrice) {
                const min = parseFloat(this.minPrice);
                result = result.filter(location => location.prix >= min);
            }
            
            // Filtre par prix maximum
            if (this.maxPrice) {
                const max = parseFloat(this.maxPrice);
                result = result.filter(location => location.prix <= max);
            }
            
            // Tri
            result.sort((a, b) => {
                let valA = a[this.sortColumn];
                let valB = b[this.sortColumn];
                
                if (typeof valA === 'string') {
                    valA = valA.toLowerCase();
                    valB = valB.toLowerCase();
                }
                
                if (valA < valB) return this.sortDirection === 'asc' ? -1 : 1;
                if (valA > valB) return this.sortDirection === 'asc' ? 1 : -1;
                return 0;
            });
            
            this.filteredLocations = result;
            this.updatePaginatedLocations();
            
            // Notifier le header du nombre de locations
            window.dispatchEvent(new CustomEvent('locations-updated', {
                detail: { count: this.filteredLocations.length }
            }));
            
            // Notifier que les composants doivent être rafraîchis
            window.dispatchEvent(new CustomEvent('refreshComponents'));
        },
        
        updatePaginatedLocations() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = start + this.perPage;
            this.paginatedLocations = this.filteredLocations.slice(start, end);
            
            // Si la page actuelle est vide et qu'il y a des données
            if (this.paginatedLocations.length === 0 && this.filteredLocations.length > 0) {
                this.currentPage = 1;
                this.updatePaginatedLocations();
            }
            // Mettre à jour l'état de selectAll après mise à jour des éléments paginés
            this.$nextTick(() => {
                this.updateSelectAll();
                this.updateIcons();
                this.initializeDropdowns();
            });
        },
        
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },
        
        goToPage(page) {
            this.currentPage = page;
        },
        
        notifySelectionChange() {
            window.dispatchEvent(new CustomEvent('selection-change', { 
                detail: { hasSelection: this.hasSelection } 
            }));
        },
        
        // Gérer la recherche
        handleSearch(event) {
            this.searchQuery = event.detail.query;
            this.currentPage = 1;
            this.filterLocations();
        },
        
        // Gérer le filtrage par type de logement
        handleFilterLogement(event) {
            this.selectedType = event.detail.type || '';
            this.currentPage = 1;
            this.filterLocations();
        },
        
        // Gérer le filtrage par type de location
        handleFilterType(event) {
            this.selectedCity = event.detail.city || '';
            this.minPrice = event.detail.minPrice || '';
            this.maxPrice = event.detail.maxPrice || '';
            this.currentPage = 1;
            this.filterLocations();
        },
        
        // Supprimer une location
        confirmDelete(id) {
            this.locationToDelete = id;
            this.showConfirmModal = true;
        },
        
        // Suppression groupée
        bulkDelete() {
            if (this.selectedLocations.length === 0) return;
            
            if (confirm(`Êtes-vous sûr de vouloir supprimer ${this.selectedLocations.length} locations ?`)) {
                fetch('/admin/locations/bulk-delete', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        ids: this.selectedLocations
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Retirer les locations supprimées de la liste
                        this.locations = this.locations.filter(location => !this.selectedLocations.includes(location.id));
                        this.selectedLocations = [];
                        this.selectAll = false;
                        this.filterLocations();
                        
                        // Afficher un message de succès
                        window.dispatchEvent(new CustomEvent('show-toast', {
                            detail: {
                                type: 'success',
                                message: data.message
                            }
                        }));
                    } else {
                        // Afficher un message d'erreur
                        window.dispatchEvent(new CustomEvent('show-toast', {
                            detail: {
                                type: 'error',
                                message: data.message
                            }
                        }));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    window.dispatchEvent(new CustomEvent('show-toast', {
                        detail: {
                            type: 'error',
                            message: 'Une erreur est survenue lors de la suppression des locations'
                        }
                    }));
                });
            }
        },
        
        deleteLocation() {
            if (!this.locationToDelete) return;
            
            fetch(`/admin/locations/${this.locationToDelete}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Supprimer de la liste locale
                    this.locations = this.locations.filter(location => location.id !== this.locationToDelete);
                    this.filterLocations();
                    
                    // Afficher un message de succès
                    window.dispatchEvent(new CustomEvent('show-toast', {
                        detail: {
                            message: 'Location supprimée avec succès',
                            type: 'success'
                        }
                    }));
                } else {
                    // Afficher un message d'erreur
                    window.dispatchEvent(new CustomEvent('show-toast', {
                        detail: {
                            message: data.message || 'Erreur lors de la suppression',
                            type: 'error'
                        }
                    }));
                }
                
                this.showConfirmModal = false;
                this.locationToDelete = null;
            })
            .catch(error => {
                window.dispatchEvent(new CustomEvent('show-toast', {
                    detail: {
                        message: 'Erreur lors de la suppression',
                        type: 'error'
                    }
                }));
                
                this.showConfirmModal = false;
                this.locationToDelete = null;
            });
        },
        
        initializeDropdowns() {
            // Initialisation des dropdowns
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                new Dropdown(dropdown);
            });
        }
    };
}
</script> 