@props(['hotel'])

<div x-data="eventHallsTable({{ json_encode($hotel->eventHalls->load('ville')) }})" class="relative">
    <!-- Barre d'outils supérieure -->
    <div class="flex flex-col mb-4 space-y-3 md:flex-row md:items-center md:justify-between md:space-y-0">
        <!-- Barre de recherche -->
        <div class="relative w-full md:w-96">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i data-lucide="search" class="w-4 h-4 text-gray-500 dark:text-gray-400"></i>
            </div>
            <input type="text" x-model="searchTerm" @input="applyFilters()" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Rechercher une salle...">
        </div>
        
        <!-- Groupe de boutons -->
        <div class="flex flex-wrap items-center gap-2">
            <!-- Filtre par statut -->
            <div class="relative">
                <button @click="showStatusFilter = !showStatusFilter" type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                    <i data-lucide="filter" class="w-4 h-4 mr-2"></i>
                    Filtrer
                </button>
                <div x-show="showStatusFilter" @click.away="showStatusFilter = false" class="absolute right-0 z-10 w-48 mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-700 dark:divide-gray-600">
                    <div class="p-3">
                        <div class="flex items-center mb-2">
                            <input id="filter-all" type="checkbox" x-model="statusFilter.all" @change="toggleAllStatuses()" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="filter-all" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tous</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input id="filter-available" type="checkbox" x-model="statusFilter.available" @change="applyFilters()" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="filter-available" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Disponible</label>
                        </div>
                        <div class="flex items-center">
                            <input id="filter-unavailable" type="checkbox" x-model="statusFilter.unavailable" @change="applyFilters()" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="filter-unavailable" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Indisponible</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Actions groupées -->
            <div class="relative">
                <button :disabled="selectedHalls.length === 0" @click="showBulkActions = !showBulkActions" :class="{'opacity-50 cursor-not-allowed': selectedHalls.length === 0}" type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                    <i data-lucide="more-horizontal" class="w-4 h-4 mr-2"></i>
                    Actions
                    <span x-show="selectedHalls.length > 0" class="ml-1.5 inline-flex items-center justify-center w-5 h-5 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                        <span x-text="selectedHalls.length"></span>
                    </span>
                </button>
                <div x-show="showBulkActions" @click.away="showBulkActions = false" class="absolute right-0 z-10 w-48 mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                        <li>
                            <button @click="bulkDelete()" class="flex items-center w-full px-4 py-2 text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white dark:text-red-400">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                                Supprimer
                            </button>
                        </li>
                    </ul>
                    <div class="py-2">
                        <p class="px-4 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Exporter</p>
                        <ul class="mt-1.5">
                            <li>
                                <button @click="exportData('csv')" class="flex items-center w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                    CSV
                                </button>
                            </li>
                            <li>
                                <button @click="exportData('pdf')" class="flex items-center w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <i data-lucide="file" class="w-4 h-4 mr-2"></i>
                                    PDF
                                </button>
                            </li>
                            <li>
                                <button @click="exportData('txt')" class="flex items-center w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                    TXT
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Bouton Ajouter -->
            <a href="{{ route('admin.event-hall.create', $hotel) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:ring-4 focus:ring-purple-300">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                Ajouter une salle
            </a>
        </div>
    </div>
    
    <!-- Tableau des salles de fête -->
    @if($hotel->eventHalls->count() > 0)
        <div class="relative overflow-x-auto rounded-lg shadow-sm">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all" type="checkbox" 
                                    x-model="selectAll"
                                    @click="toggleSelectAll()"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">Salle</th>
                        <th scope="col" class="px-6 py-3">Prix</th>
                        <th scope="col" class="px-6 py-3">Capacité</th>
                      {{--   <th scope="col" class="px-6 py-3">Emplacement</th> --}}
                        <th scope="col" class="px-6 py-3">Statut</th>
                        <th scope="col" class="px-6 py-3">Réservations</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(hall, index) in paginatedHalls" :key="hall.id">
                        <tr :class="{'bg-white dark:bg-gray-800': index % 2 === 0, 'bg-gray-50 dark:bg-gray-700': index % 2 !== 0}" class="border-b dark:border-gray-700">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                        :id="'checkbox-' + hall.id" 
                                        :value="hall.id"
                                        x-model="selectedHalls"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label :for="'checkbox-' + hall.id" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td  class="flex flex-col items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="w-10 h-10 mr-3 overflow-hidden rounded">
                                    <img :src="hall.photo ? '/storage/' + hall.photo : '/img/default-hall.jpg'" alt="Photo de la salle" class="object-cover w-20 h-12 mr-3">
                                </div>
                                <span x-text="hall.nom_salle"></span>
                            </td>
                            <td class="px-6 py-4" x-text="formatPrice(hall.prix) + ' FCFA'"></td>
                            <td class="px-6 py-4" x-text="hall.capacite + ' pers.'"></td>
                         {{--    <td class="px-6 py-4" x-text="hall.ville.nom + ', ' + hall.localisation"></td> --}}
                            <td class="px-6 py-4">
                                <span :class="{'text-green-700 bg-green-100': hall.status === 'available', 'text-red-700 bg-red-100': hall.status === 'unavailable'}" class="px-2 py-1 text-xs font-medium rounded-full" x-text="hall.status === 'available' ? 'Disponible' : 'Indisponible'"></span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <i data-lucide="check-circle" class="w-4 h-4 mr-1 text-green-600"></i>
                                    <span x-text="hall.completed_bookings || 0"></span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="inline-flex items-center p-1 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                                        <i data-lucide="more-vertical" class="w-5 h-5"></i>
                                    </button>
                                    <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-lg shadow-lg w-44 dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                            <li>
                                                <a :href="'/admin/event-halls/' + hall.id" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                                    Voir les détails
                                                </a>
                                            </li>
                                            <li>
                                                <a :href="'/admin/event-halls/' + hall.id + '/edit'" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                                                    Modifier
                                                </a>
                                            </li>
                                            <li>
                                                <button @click="confirmDelete(hall.id)" class="flex items-center w-full px-4 py-2 text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-red-400 dark:hover:text-red-300">
                                                    <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                                                    Supprimer
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="flex items-center justify-between mt-4">
            <div class="text-sm text-gray-700 dark:text-gray-400">
                Affichage de <span x-text="(currentPage - 1) * perPage + 1"></span> à <span x-text="Math.min(currentPage * perPage, filteredHalls.length)"></span> sur <span x-text="filteredHalls.length"></span> salles
            </div>
            
            <div class="flex space-x-2">
                <button @click="prevPage" :disabled="currentPage === 1" :class="{'opacity-50 cursor-not-allowed': currentPage === 1}" class="px-3 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </button>
                <template x-for="page in totalPages" :key="page">
                    <button @click="goToPage(page)" :class="{'bg-blue-600 text-white': currentPage === page, 'bg-white text-gray-700 hover:bg-gray-50': currentPage !== page}" class="px-3 py-1 text-sm font-medium border border-gray-300 rounded-md">
                        <span x-text="page"></span>
                    </button>
                </template>
                <button @click="nextPage" :disabled="currentPage === totalPages" :class="{'opacity-50 cursor-not-allowed': currentPage === totalPages}" class="px-3 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    @else
        <div class="flex flex-col items-center justify-center p-8 text-gray-500 dark:text-gray-400">
            <i data-lucide="landmark" class="w-12 h-12 mb-4"></i>
            <p class="mb-2 text-lg font-medium">Aucune salle de fête disponible</p>
            <p class="mb-6 text-sm">Cet hôtel n'a pas encore de salles de fête enregistrées.</p>
            <a href="{{ route('admin.event-hall.create', $hotel) }}" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:ring-4 focus:ring-purple-300">
                <i data-lucide="plus" class="inline w-4 h-4 mr-1"></i>
                Ajouter une salle de fête
            </a>
        </div>
    @endif
    
    <!-- Modal de confirmation de suppression -->
    <div x-show="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black bg-opacity-50" x-cloak>
        <div class="relative w-full max-w-md p-4 mx-auto md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button @click="showDeleteModal = false" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                    <i data-lucide="x" class="w-5 h-5"></i>
                    <span class="sr-only">Fermer</span>
                </button>
                <div class="p-6 text-center">
                    <i data-lucide="alert-triangle" class="mx-auto mb-4 text-yellow-400 w-14 h-14"></i>
                    <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Confirmation de suppression</h3>
                    <p class="mb-5 text-gray-700 dark:text-gray-300">
                        Êtes-vous sûr de vouloir supprimer cette salle de fête ? Cette action est irréversible.
                    </p>
                    <form :action="'/admin/event-halls/' + hallToDelete" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Oui, supprimer
                        </button>
                    </form>
                    <button @click="showDeleteModal = false" type="button" class="px-5 py-2.5 mt-2 sm:mt-0 sm:ml-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal de confirmation de suppression en masse -->
    <div x-show="showBulkDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black bg-opacity-50" x-cloak>
        <div class="relative w-full max-w-md p-4 mx-auto md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button @click="showBulkDeleteModal = false" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                    <i data-lucide="x" class="w-5 h-5"></i>
                    <span class="sr-only">Fermer</span>
                </button>
                <div class="p-6 text-center">
                    <i data-lucide="alert-triangle" class="mx-auto mb-4 text-yellow-400 w-14 h-14"></i>
                    <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Confirmation de suppression en masse</h3>
                    <p class="mb-2 text-gray-700 dark:text-gray-300">
                        Êtes-vous sûr de vouloir supprimer <span x-text="selectedHalls.length"></span> salles de fête ? Cette action est irréversible.
                    </p>
                    <p class="mb-5 text-sm text-gray-500 dark:text-gray-400">
                        Les salles sélectionnées et toutes leurs données associées seront définitivement supprimées.
                    </p>
                    <form action="{{ route('admin.event-halls.bulk-delete') }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <template x-for="id in selectedHalls" :key="id">
                            <input type="hidden" name="ids[]" :value="id">
                        </template>
                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Oui, tout supprimer
                        </button>
                    </form>
                    <button @click="showBulkDeleteModal = false" type="button" class="px-5 py-2.5 mt-2 sm:mt-0 sm:ml-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@once
@push('scripts')
<script>
    function eventHallsTable(initialHalls) {
        return {
            halls: initialHalls,
            filteredHalls: initialHalls,
            paginatedHalls: [],
            searchTerm: '',
            currentPage: 1,
            perPage: 5,
            selectAll: false,
            selectedHalls: [],
            showStatusFilter: false,
            showBulkActions: false,
            showDeleteModal: false,
            showBulkDeleteModal: false,
            hallToDelete: null,
            statusFilter: {
                all: true,
                available: true,
                unavailable: true
            },
            
            // Initialisation
            init() {
                this.applyFilters();
            },
            
            // Méthodes de pagination
            get totalPages() {
                return Math.ceil(this.filteredHalls.length / this.perPage);
            },
            
            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.currentPage++;
                    this.updatePaginatedHalls();
                }
            },
            
            prevPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                    this.updatePaginatedHalls();
                }
            },
            
            goToPage(page) {
                this.currentPage = page;
                this.updatePaginatedHalls();
            },
            
            updatePaginatedHalls() {
                const start = (this.currentPage - 1) * this.perPage;
                const end = start + this.perPage;
                this.paginatedHalls = this.filteredHalls.slice(start, end);
            },
            
            // Méthodes de filtrage et de recherche
            applyFilters() {
                this.filteredHalls = this.halls.filter(hall => {
                    // Filtre de recherche
                    const searchMatch = !this.searchTerm || 
                        hall.name.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                        hall.localisation.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                        hall.ville.toLowerCase().includes(this.searchTerm.toLowerCase());
                    
                    // Filtre de statut
                    const statusMatch = (this.statusFilter.available && hall.status === 'available') ||
                                        (this.statusFilter.unavailable && hall.status === 'unavailable');
                    
                    return searchMatch && statusMatch;
                });
                
                this.currentPage = 1;
                this.updatePaginatedHalls();
                this.selectAll = false;
                this.selectedHalls = [];
            },
            
            toggleAllStatuses() {
                if (this.statusFilter.all) {
                    this.statusFilter.available = true;
                    this.statusFilter.unavailable = true;
                } else {
                    this.statusFilter.available = false;
                    this.statusFilter.unavailable = false;
                }
                this.applyFilters();
            },
            
            // Méthodes de sélection
            toggleSelectAll() {
                if (this.selectAll) {
                    this.selectedHalls = this.paginatedHalls.map(hall => hall.id);
                } else {
                    this.selectedHalls = [];
                }
            },
            
            // Formatage des données
            formatPrice(price) {
                return new Intl.NumberFormat('fr-FR').format(price);
            },
            
            // Actions sur les salles
            confirmDelete(id) {
                this.hallToDelete = id;
                this.showDeleteModal = true;
            },
            
            bulkDelete() {
                if (this.selectedHalls.length > 0) {
                    this.showBulkActions = false;
                    this.showBulkDeleteModal = true;
                }
            },
            
            exportData(format) {
                // On récupère les salles sélectionnées
                const selectedData = this.halls.filter(hall => this.selectedHalls.includes(hall.id));
                
                let content = '';
                const filename = `export-salles-${new Date().toISOString().slice(0, 10)}.${format}`;
                
                if (format === 'csv') {
                    // En-tête CSV
                    content = 'ID,Nom,Prix,Capacité,Ville,Localisation,Statut,Réservations\n';
                    // Lignes de données
                    selectedData.forEach(hall => {
                        content += `${hall.id},"${hall.name}",${hall.price},${hall.capacity},"${hall.ville}","${hall.localisation}","${hall.status === 'available' ? 'Disponible' : 'Indisponible'}",${hall.completed_bookings || 0}\n`;
                    });
                } else if (format === 'txt') {
                    // Format texte simple
                    content = 'Liste des salles de fête exportées\n';
                    content += '================================\n\n';
                    selectedData.forEach(hall => {
                        content += `ID: ${hall.id}\n`;
                        content += `Nom: ${hall.name}\n`;
                        content += `Prix: ${this.formatPrice(hall.price)} FCFA\n`;
                        content += `Capacité: ${hall.capacity} personnes\n`;
                        content += `Emplacement: ${hall.ville}, ${hall.localisation}\n`;
                        content += `Statut: ${hall.status === 'available' ? 'Disponible' : 'Indisponible'}\n`;
                        content += `Réservations complétées: ${hall.completed_bookings || 0}\n`;
                        content += '--------------------------------\n\n';
                    });
                }
                
                // Créer et télécharger le fichier
                if (format !== 'pdf') {
                    const blob = new Blob([content], { type: format === 'csv' ? 'text/csv;charset=utf-8;' : 'text/plain;charset=utf-8;' });
                    const link = document.createElement('a');
                    const url = URL.createObjectURL(blob);
                    
                    link.setAttribute('href', url);
                    link.setAttribute('download', filename);
                    link.style.visibility = 'hidden';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                } else {
                    // Pour PDF, on simulerait un appel au serveur pour générer le PDF
                    alert('Export PDF en cours de développement');
                    // Dans un environnement réel, on ferait une requête vers une route côté serveur
                    // qui utiliserait une bibliothèque comme DOMPDF pour générer le PDF.
                }
                
                this.showBulkActions = false;
            }
        };
    }
</script>
@endpush
@endonce 