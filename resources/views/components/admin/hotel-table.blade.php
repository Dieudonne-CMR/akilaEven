@props(['hotels' => []])

<div 
    x-data="hotelTableComponent({{ json_encode($hotels) }})" 
    class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg"
>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
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
                    <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('nom_hotel')">                     
                      <div class="flex items-center">
                        Hôtel
                        
                      </div>                       
                    </th>
                    <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('telephone')">                     
                      <div class="flex items-center">
                        Téléphone
                        
                      </div>
                    </th>
                    <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('email')">                       
                      <div class="flex items-center">
                        Email
                        
                      </div>                         
                    </th>
                    <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('localisation')">                        
                      <div class="flex items-center">
                        Emplacement                        
                      </div>                       
                    </th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(hotel, index) in filteredHotels" :key="hotel.id">
                    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="w-4 px-4 py-3">
                            <div class="flex items-center">
                                <input 
                                    :id="'checkbox-table-' + hotel.id" 
                                    type="checkbox" 
                                    name="selected_hotels[]"
                                    x-model="selectedHotels"
                                    :value="hotel.id"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                >
                                <label :for="'checkbox-table-' + hotel.id" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="relative flex items-center justify-center w-10 h-10 mr-3 overflow-hidden bg-blue-100 rounded-full">
                                <template x-if="hotel.logo">
                                    <img :src="'/storage/' + hotel.logo" class="object-cover w-full h-full" :alt="hotel.nom_hotel">
                                </template>
                                <template x-if="!hotel.logo">
                                    <span class="font-bold text-blue-600" x-text="hotel.initials"></span>
                                </template>
                            </div>
                            <div>
                                <span x-text="hotel.nom_hotel"></span>
                                <div class="flex mt-1 space-x-2">
                                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                        <i data-lucide="home" class="w-3 h-3 mr-1"></i>
                                        <span x-text="hotel.event_halls_count"></span>
                                    </span>
                                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium bg-green-100 text-green-800 rounded-full dark:bg-green-900 dark:text-green-300">
                                        <i data-lucide="bed" class="w-3 h-3 mr-1"></i>
                                        <span x-text="hotel.rooms_count"></span>
                                    </span>
                                </div>
                            </div>
                        </th>
                        <td class="px-4 py-2">
                            <div class="flex items-center">
                                <i data-lucide="phone" class="w-4 h-4 mr-1 text-gray-400"></i>
                                <span x-text="hotel.telephone"></span>
                            </div>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex items-center">
                                <i data-lucide="mail" class="w-4 h-4 mr-1 text-gray-400"></i>
                                <span x-text="hotel.email"></span>
                            </div>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex items-center">
                                <i data-lucide="map-pin" class="w-4 h-4 mr-1 text-gray-400"></i>
                                <span x-text="hotel.localisation || hotel.ville"></span>
                            </div>
                        </td>
                        <td class="px-4 py-2">
                            <button 
                                :id="'dropdownMenuButton-' + hotel.id" 
                                :data-dropdown-toggle="'dropdownMenu-' + hotel.id" 
                                class="inline-flex items-center p-1 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" 
                                type="button"
                            >
                                <i data-lucide="more-vertical" class="w-5 h-5"></i>
                            </button>
                            
                            <!-- Dropdown menu -->
                            <div :id="'dropdownMenu-' + hotel.id" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" :aria-labelledby="'dropdownMenuButton-' + hotel.id">
                                    <li>
                                        <a :href="'/admin/hotels/' + hotel.id" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                            Voir détails
                                        </a>
                                    </li>
                                    <li>
                                        <a 
                                            @click="deleteHotel(hotel.id, hotel.nom_hotel)" 
                                            class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100"
                                        >
                                            <i data-lucide="trash-2" class="w-4 h-4 mr-2 text-red-500"></i>
                                            Supprimer
                                        </a>
                                    </li>
                                    <li>
                                        <a :href="'/admin/event-halls/create/' + hotel.id" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                                            <i data-lucide="home" class="w-4 h-4 mr-2 text-green-500"></i>
                                            Ajouter une salle
                                        </a>
                                    </li>
                                    <li>
                                        <a :href="'/admin/rooms/create/' + hotel.id" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            <i data-lucide="bed" class="w-4 h-4 mr-2 text-blue-500"></i>
                                            Ajouter une chambre
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </template>
                <tr x-show="filteredHotels.length === 0" class="border-b dark:border-gray-600">
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                        <x-admin.empty-state 
                            icon="search-x" 
                            title="Aucun hôtel trouvé" 
                            message="Essayez de modifier vos critères de recherche ou d'ajouter un nouvel hôtel."
                            bgClass="bg-blue-50"
                            iconClass="text-blue-500"
                        />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation" x-show="filteredHotels.length > 0">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
            Affichage
            <span class="font-semibold text-gray-900 dark:text-white" x-text="paginationInfo.start + 1"></span>
            -
            <span class="font-semibold text-gray-900 dark:text-white" x-text="paginationInfo.end"></span>
            sur
            <span class="font-semibold text-gray-900 dark:text-white" x-text="filteredCount"></span>
        </span>
        <ul class="inline-flex items-stretch -space-x-px" x-show="totalPages > 1">
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
                        :class="{ 'text-blue-600 bg-blue-50 border-blue-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white': currentPage === page }"
                        class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 cursor-pointer hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        x-text="page"
                    ></a>
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
</div>

<script>
    function hotelTableComponent(hotels) {
        return {
            // Initialiser les variables
            hotels: hotels,
            // Afficher les hôtels filtrés
            filteredHotels: [],
            allFilteredHotels: [], // Pour stocker tous les résultats filtrés avant pagination
            selectedHotels: [],
            // Sélectionner tous les hôtels
            selectAll: false,
            // Trier par nom, téléphone, email, localisation au niveau des en-têtes des colonnes
            sortField: 'nom_hotel',
            sortDirection: 'asc',
            // Afficher les informations de pagination
            currentPage: 1,
            itemsPerPage: 5,
            searchQuery: '',
            // Afficher si des hôtels sont sélectionnés
            get hasSelection() {
                return this.selectedHotels.length > 0;
            },
            // Afficher le nombre total de pages
            get totalPages() {
                return Math.ceil(this.allFilteredHotels.length / this.itemsPerPage);
            },
            // Afficher le nombre total de résultats filtrés
            get filteredCount() {
                return this.allFilteredHotels.length;
            },
            // Afficher les informations de pagination
            get paginationInfo() {
                const start = (this.currentPage - 1) * this.itemsPerPage;
                const end = Math.min(start + this.itemsPerPage, this.allFilteredHotels.length);
                return { start, end };
            },
            // Afficher les initiales du nom de l'hôtel
        /*     getInitials(name) {
                if (!name) return '';
                return name.split(' ').map(word => word[0]).join('').toUpperCase();
            }, */

            // Selectionner tous les hôtels
            toggleSelectAll() {
            
              if (!this.selectAll) {
                  const visibleHotelIds = this.filteredHotels.map(hotel => hotel.id);
                  this.selectedHotels = [...new Set([...this.selectedHotels, ...visibleHotelIds])];
              } else {
                  this.selectedHotels = [];
              }              
              this.notifySelectionChange();
            },
            // Trier par nom, téléphone, email, localisation au niveau des en-têtes des colonnes
            
            sortBy(field) {
                if (this.sortField === field) {
                    this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    this.sortField = field;
                    this.sortDirection = 'asc';
                }
                this.applyFiltersAndSort();
            },
            // Appliquer les filtres et trier les résultats
            applyFiltersAndSort() {
                console.log('Filtrage avec query:', this.searchQuery);
                let result = [...this.hotels];
                
                if (this.searchQuery && this.searchQuery.trim() !== '') {
                    const query = this.searchQuery.toLowerCase().trim();
                    result = result.filter(hotel => 
                        (hotel.nom_hotel && hotel.nom_hotel.toLowerCase().includes(query)) ||
                        (hotel.email && hotel.email.toLowerCase().includes(query)) ||
                        (hotel.localisation && hotel.localisation.toLowerCase().includes(query)) ||
                        (hotel.ville && hotel.ville.toLowerCase().includes(query)) ||
                        (hotel.telephone && hotel.telephone.includes(query))
                    );
                }
                // Trier les résultats par le champ sélectionné
                result.sort((a, b) => {
                    const aValue = a[this.sortField] || '';
                    const bValue = b[this.sortField] || '';
                    // Trier les résultats par ordre ascendant ou descendant
                    if (aValue < bValue) return this.sortDirection === 'asc' ? -1 : 1;
                    // Trier les résultats par ordre descendant ou ascendant
                    if (aValue > bValue) return this.sortDirection === 'asc' ? 1 : -1;
                    return 0;
                });
                
                // Stocker tous les résultats filtrés
                this.allFilteredHotels = [...result];
                
                // Appliquer la pagination
                const start = (this.currentPage - 1) * this.itemsPerPage;
                const end = Math.min(start + this.itemsPerPage, result.length);
                this.filteredHotels = result.slice(start, end);
                
                console.log('Résultats filtrés:', this.filteredHotels.length);
            },
            // Revenir à la page précédente
            prevPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                    this.applyFiltersAndSort();
                }
            },
            // Passer à la page suivante
            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.currentPage++;
                    this.applyFiltersAndSort();
                }
            },
            // Passer à la page spécifiée
            goToPage(page) {
                this.currentPage = page;
                this.applyFiltersAndSort();
            },
            // Notifier le changement de sélection
            notifySelectionChange() {

                window.dispatchEvent(new CustomEvent('selection-change', { 
                    detail: { hasSelection: this.hasSelection } 
                }));
            },
            // Gérer la recherche
            handleSearch(event) {
                console.log('Événement de recherche reçu:', event.detail.query);
                this.searchQuery = event.detail.query;
                this.currentPage = 1; // Réinitialiser à la première page
                this.applyFiltersAndSort();
            },
            // Supprimer un hôtel
            deleteHotel(id, name) {
                if (confirm(`Êtes-vous sûr de vouloir supprimer l'hôtel "${name}" ?`)) {

                    fetch(`/admin/hotels/${id}`, {
                        method: 'DELETE',
                        
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                      console.log(data)
                        if (data.success) {
                            // Supprimer l'hôtel de la liste et rafraîchir l'affichage
                            this.hotels = this.hotels.filter(hotel => hotel.id !== id);
                            this.applyFiltersAndSort();
                            
                            // Afficher un message de succès avec le composant toast
                            const toastEvent = new CustomEvent('show-toast', {
                                detail: {
                                    type: 'success',
                                    message: `L'hôtel "${name}" a été supprimé avec succès.`
                                }
                            });
                            window.dispatchEvent(toastEvent);
                        } else {
                            // Afficher un message d'erreur
                            const toastEvent = new CustomEvent('show-toast', {
                                detail: {
                                    type: 'error',
                                    message: data.message || 'Une erreur est survenue lors de la suppression.'
                                }
                            });
                            window.dispatchEvent(toastEvent);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        const toastEvent = new CustomEvent('show-toast', {
                            detail: {
                                type: 'error',
                                message: 'Une erreur est survenue lors de la suppression.'
                            }
                        });
                        window.dispatchEvent(toastEvent);
                    });
                }
            },
            
            init() {
              console.log('selectedHotels', this.selectedHotels);
                // Initialiser l'affichage avec tous les hôtels
                this.applyFiltersAndSort();
                
                // Écouter les événements de recherche à plusieurs niveaux
                document.addEventListener('search-hotels', this.handleSearch.bind(this));
                // Écouter les événements de recherche au niveau de la page
                window.addEventListener('search-hotels', this.handleSearch.bind(this));

                // Écouter les événements de sélection
                this.$watch('filteredHotels', () => {
                  console.log('filteredHotels', this.filteredHotels);
                  this.selectAll = this.filteredHotels.length > 0 && 
                  this.filteredHotels.every(hotel => this.selectedHotels.includes(hotel.id));
                  // Initialiser les icônes Lucide
                  setTimeout(() => {
                    if (window.lucide) {
                      window.lucide.createIcons();
                    }
                  },0);
                  // Notifier le changement de sélection
                  this.notifySelectionChange();
                  console.log('selectAll', this.selectAll);
                });
                
                this.$watch('selectedHotels', () => {
                  console.log('selectedHotels', this.selectedHotels);
                 
                  // Vérifier si tous les hôtels sont sélectionnés
                  this.selectAll = this.filteredHotels.length > 0 && 
                    this.filteredHotels.every(hotel => this.selectedHotels.includes(hotel.id));
                  // Notifier le changement de sélection
                  this.notifySelectionChange();
                  /* console.log('selectAll', this.selectAll); */
                });
                
                // Initialisation des icônes Lucide
                if (window.lucide) {
                    window.lucide.createIcons();
                }
            }
        }
    }
</script> 