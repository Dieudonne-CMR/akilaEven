@props(['locations' => []])
@if(session('success'))
<x-ui.toast type="success" message="{{ session('success')}}" position="bottom-right" />
@endif
@if(session('error'))
<x-ui.toast type="error" message="{{ session('error')}}" position="bottom-right" />
     
@endif



<div 
    x-data="locationTableComponent({{ json_encode($locations) }})" 
    class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg"
    @search-locations.window="handleSearch($event)"
    @filter-locations-logement.window="handleFilterLogement($event)"
    @filter-locations-type.window="handleFilterType($event)"
    @bulk-delete-locations.window="bulkDelete">
    <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
        <div class="flex items-center flex-1 space-x-4">
            <h5>
                <span class="font-bold text-gray-900 dark:text-white" x-text="filteredLocations.length + ' Locations'"></span>
            </h5>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input 
                                id="checkbox-all" 
                                type="checkbox" 
                                x-model="selectAll"
                                @click="toggleSelectAll"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            >
                            <label for="checkbox-all" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('nom_location')">
                        <div class="flex items-center">
                            <i data-lucide="home" class="w-4 h-4 mr-1"></i>
                            Location
                        
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
                    <th scope="col" class="px-4 py-3">
                        Type de logement
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Type de location
                    </th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(location, index) in paginatedLocations" :key="location.id">
                    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="w-4 px-4 py-3">
                            <div class="flex items-center">
                                <input 
                                    :id="'checkbox-table-' + location.id" 
                                    type="checkbox" 
                                    x-model="selectedLocations"
                                    :value="parseInt(location.id)"
                                    @change="updateSelectAll"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600"
                                >
                                <label :for="'checkbox-table-' + location.id" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img :src="'/storage/' + location.photo" class="object-cover w-10 h-10 mr-3 rounded-full" :alt="location.nom_location">
                            <span x-text="location.nom_location"></span>
                        </th>
                        <td class="px-4 py-3" x-text="location.ville.nom + ', ' + location.localisation"></td>
                        <td class="px-4 py-3">
                            <div x-text="formatPrix(location.prix, location.type_logement)"></div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300" x-text="ucfirst(location.type_logement)"></span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300" x-text="ucfirst(location.type_location)"></span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <button 
                                :id="'dropdownMenuButton-' + location.id" 
                                :data-dropdown-toggle="'dropdownMenu-' + location.id" 
                                class="inline-flex items-center p-1 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" 
                                type="button"
                            >
                                <i data-lucide="ellipsis" class="w-5 h-5"></i>
                            </button>
                            
                            <!-- Menu déroulant -->
                            <div :id="'dropdownMenu-' + location.id" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" :aria-labelledby="'dropdownMenuButton-' + location.id">
                                    <li>
                                        <a :href="'/admin/locations/' + location.id" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                            Voir détails
                                        </a>
                                    </li>
                                    <li>
                                        <a :href="'/admin/locations/' + location.id + '/edit'" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            <i data-lucide="edit" class="w-4 h-4 mr-2 text-green-500"></i>
                                            Modifier
                                        </a>
                                    </li>
                                    <li>
                                        <a @click="deleteLocation(location.id)" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            <i data-lucide="trash-2" class="w-4 h-4 mr-2 text-red-500"></i>
                                            Supprimer
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </template>
                <template x-if="filteredLocations.length === 0">
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <i data-lucide="file-question" class="w-10 h-10 mb-2 text-gray-400"></i>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Aucune location trouvée</h3>
                                <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Essayez de modifier vos critères de recherche ou de créer une nouvelle location</p>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
    <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
            Affichage de <span class="font-semibold text-gray-900 dark:text-white" x-text="paginationInfo.start + 1"></span> à <span class="font-semibold text-gray-900 dark:text-white" x-text="paginationInfo.end"></span> sur <span class="font-semibold text-gray-900 dark:text-white" x-text="filteredLocations.length"></span> Locations
        </span>
        <ul class="inline-flex items-stretch -space-x-px">
            <li>
                <a 
                    @click="prevPage" 
                    :class="{ 'cursor-not-allowed opacity-50': currentPage === 1 }"
                    class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
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
                        :class="{'bg-blue-50 border-blue-300 text-blue-600 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white': currentPage === page, 'bg-white border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white': currentPage !== page}"
                    >
                        <span x-text="page"></span>
                    </a>
                </li>
            </template>
            <li>
                <a 
                    @click="nextPage" 
                    :class="{ 'cursor-not-allowed opacity-50': currentPage === totalPages }"
                    class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                >
                    <span class="sr-only">Suivant</span>
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- Confirmation modal -->
  {{--   <div 
    x-data="{ showConfirmModal: false, locationId: null }"
    @show-confirm-modal.window="showConfirmModal = true; locationId = $event.detail.locationId"
    class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50"
    x-show="showConfirmModal"
    x-cloak>
        <div class="relative w-full max-w-md p-4">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" @click="showConfirmModal = false">
                    <i data-lucide="x" class="w-5 h-5"></i>
                    <span class="sr-only">Fermer</span>
                </button>
                <div class="p-6 text-center">
                    <i data-lucide="alert-triangle" class="w-12 h-12 mx-auto mb-4 text-yellow-400"></i>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Êtes-vous sûr de vouloir supprimer cette location ?</h3>
                    <div class="flex justify-center space-x-4">
                        <form :action="'/admin/locations/' + locationId" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Oui, supprimer
                            </button>
                        </form>
                        <button @click="showConfirmModal = false" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ">
                            Non, annuler
                        </button>
                    </div>
                </div>
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
        sortField: 'nom_location',
        sortDirection: 'asc',
        currentPage: 1,
        itemsPerPage: 5,
        searchQuery: '',
        currentTypeLogement: 'all',
        currentTypeLocation: 'all',

        init() {
            this.applyFiltersAndSort();
        },
        
        get hasSelection() {
            return this.selectedLocations.length > 0;
        },
        
        get totalPages() {
            return Math.ceil(this.filteredLocations.length / this.itemsPerPage);
        },
        
        get paginationInfo() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = Math.min(start + this.itemsPerPage, this.filteredLocations.length);
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
        
        ucfirst(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
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
        
        sortBy(field) {
            if (this.sortField === field) {
                this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortField = field;
                this.sortDirection = 'asc';
            }
            this.applyFiltersAndSort();
        },
        
        updateIcons() {
            // Utiliser setTimeout pour s'assurer que le DOM est mis à jour avant de recréer les icônes
            setTimeout(() => {
                if (window.lucide) {
                    window.lucide.createIcons();
                }
            }, 0);
        },
        
        applyFiltersAndSort() {
            // Filtrage par recherche
            let result = [...this.locations];
            
            if (this.searchQuery) {
                const query = this.searchQuery.toLowerCase();
                result = result.filter(location => 
                    (location.nom_location && location.nom_location.toLowerCase().includes(query)) ||
                    (location.localisation && location.localisation.toLowerCase().includes(query)) ||
                    (location.type_location && location.type_location.toLowerCase().includes(query))
                );
            }
            
            // Filtrage par type de logement
            if (this.currentTypeLogement !== 'all') {
                result = result.filter(location => location.type_logement === this.currentTypeLogement);
            }
            
            // Filtrage par type de location
            if (this.currentTypeLocation !== 'all') {
                result = result.filter(location => location.type_location === this.currentTypeLocation);
            }
            
            // Tri
            result.sort((a, b) => {
                let aValue = a[this.sortField] || '';
                let bValue = b[this.sortField] || '';
                
                // Conversion pour le tri numérique des prix
                if (this.sortField === 'prix') {
                    aValue = parseFloat(aValue);
                    bValue = parseFloat(bValue);
                }
                
                if (aValue < bValue) return this.sortDirection === 'asc' ? -1 : 1;
                if (aValue > bValue) return this.sortDirection === 'asc' ? 1 : -1;
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
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
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
                this.updatePaginatedLocations();
            }
        },
        
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
                this.updatePaginatedLocations();
            }
        },
        
        goToPage(page) {
            this.currentPage = page;
            this.updatePaginatedLocations();
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
            this.applyFiltersAndSort();
        },
        
        // Gérer le filtrage par type de logement
        handleFilterLogement(event) {
            this.currentTypeLogement = event.detail.type;
            this.currentPage = 1;
            this.applyFiltersAndSort();
        },
        
        // Gérer le filtrage par type de location
        handleFilterType(event) {
            this.currentTypeLocation = event.detail.type;
            this.currentPage = 1;
            this.applyFiltersAndSort();
        },
        
        // Supprimer une location
        deleteLocation(id) {
            window.dispatchEvent(new CustomEvent('show-confirm-modal', { 
                detail: { locationId: id } 
            }));
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
                        this.applyFiltersAndSort();
                        
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
        }
    };
}
</script> 