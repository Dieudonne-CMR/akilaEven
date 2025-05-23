@props(['agences' => []])

<div 
    x-data="agenceTableComponent({{ json_encode($agences) }})" 
    class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg"
>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs uppercase text-neutral-700 bg-gray-50">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <x-ui.chechbox  id="checkbox-all"  x-model="selectAll"
                            @click="toggleSelectAll"  />
                            
                            <label for="checkbox-all" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="py-3 cursor-pointer " @click="sortBy('nom_agence')">                     
                      <div class="flex items-center">
                        <i data-lucide="building-2" class="mr-1 size-4 text-muted-foreground"></i>
                        Agence                        
                      </div>                       
                    </th>
                    <th scope="col" class="py-3 cursor-pointer " @click="sortBy('telephone')">                     
                      <div class="flex items-center">
                        <i data-lucide="phone" class="mr-1 size-4 text-muted-foreground"></i>
                        Téléphone                        
                      </div>
                    </th>
                    <th scope="col" class="py-3 cursor-pointer " @click="sortBy('email')">                       
                      <div class="flex items-center">
                        <i data-lucide="mail" class="mr-1 size-4 text-muted-foreground"></i>
                        Email                        
                      </div>                         
                    </th>
                    <th scope="col" class="py-3 cursor-pointer " @click="sortBy('localisation')">                        
                      <div class="flex items-center">
                        <i data-lucide="map-pin" class="flex-shrink-0 mr-1 size-4 text-muted-foreground"></i>
                        Emplacement                        
                      </div>                       
                    </th>
                    <th scope="col" class="py-3 ">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(agence, index) in filteredAgences" :key="agence.id">
                    <tr class="border-b hover:bg-gray-100 ">
                        <td class="w-4 px-4 py-3">
                            <div class="flex items-center">                               
                                <input 
                                    :id="'checkbox-table-' + agence.id" 
                                    type="checkbox" 
                                    name="selected_agences[]"
                                    x-model="selectedAgences"
                                    :value="agence.id"
                                    class="default-checkbox"
                                >
                                <label :for="'checkbox-table-' + agence.id" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="flex items-center px-4 py-2 font-medium whitespace-nowrap">
                            
                            <div class="mr-3 avatar">
                                <div class="rounded-full size-10">
                                    <template x-if="agence.logo">
                                        <img :src="'/storage/' + agence.logo" class="object-cover w-full h-full" :alt="agence.nom_agence">
                                    </template>
                                    <template x-if="!agence.logo">
                                        <span class="font-bold text-blue-600" x-text="agence.initials"></span>
                                    </template>
                                </div>
                            </div>
                            
                            <div>
                                <span x-text="agence.nom_agence"></span>
                                <div class="flex mt-1 space-x-2">
                                    <a href="{{ route('admin.eventHalls') }}" class="badge px-2 py-0.5 bg-blue-100 text-blue-800 rounded-full ">
                                        <i data-lucide="party-popper" class="mr-1 size-4"></i>
                                        <span x-text="agence.event_halls_count"></span>
                                    </a>
                                    <a href="{{ route('admin.locations.index') }}" class="badge px-2 py-0.5 bg-green-100 text-green-800 rounded-full ">
                                        <i data-lucide="home" class="mr-1 size-4"></i>
                                        <span x-text="agence.locations_count"></span>
                                    </a>
                                </div>
                            </div>
                        </th>
                        <td class="">                                                        
                            <span x-text="agence.telephone"></span>
                        </td>
                        <td class="">
                            <span x-text="agence.email"></span>                            
                        </td>
                        <td class="">
                            <div class="flex items-center">
                                <span x-text="agence.ville + (agence.localisation ? ', ' + agence.localisation : '')">
                                    
                                </span>
                            </div>
                        </td>
                        <td class="">
                            <div class="relative inline-flex dropdown">
                                <button id="dropdown-menu-icon" type="button" class="btn-outline btn-dropdown-toggle btn btn-square" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                  <i data-lucide="ellipsis" class="size-4"></i>
                                </button>
                                <ul class="hidden dropdown-menu dropdown-open:opacity-100 min-w-60" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-menu-icon">
                                    <li>
                                        <a :href="'/admin/agences/' + agence.id" class="dropdown-item">
                                            <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                            Voir détails
                                        </a>
                                    </li>
                                    <li>
                                        <a :href="'/admin/event-halls/create/' + agence.id" class="dropdown-item">
                                            <i data-lucide="party-popper" class="w-4 h-4 mr-2 text-green-500"></i>
                                            Ajouter une salle
                                        </a>
                                    </li>
                                    <li>
                                        <a :href="'/admin/locations/create/' + agence.id" class=" dropdown-item">
                                            <i data-lucide="home" class="mr-2 text-blue-500 size-4"></i>
                                            Ajouter une location
                                        </a>
                                    </li>
                                    <li class="gap-2 p-2 dropdown-footer">
                                        <a 
                                            @click="deleteAgence(agence.id, agence.nom_agence)" 
                                            class="justify-start btn btn-error btn-soft btn-block"
                                        >
                                            <i data-lucide="trash-2" class="mr-2 size-4 "></i>
                                            Supprimer
                                        </a>
                                    </li>
                                    
                                </ul>
                              </div>
                          
                        </td>
                    </tr>
                </template>
                <tr x-show="filteredAgences.length === 0" class="border-b dark:border-gray-600">
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                        <x-ui.empty-state 
                            icon="search-x" 
                            title="Aucune agence trouvé" 
                            message="Essayez de modifier vos critères de recherche ou d'ajouter un nouvel agence."
                            bgClass="bg-blue-50"
                            iconClass="text-blue-500"
                        />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation" x-show="filteredAgences.length > 0">
        @include('components.ui.data-display')
        @include('components.ui.data-pagination')
    </nav>
</div>

<script>
    function agenceTableComponent(agences) {
        return {
            // Initialiser les variables
            agences: agences,
            // Afficher les agences filtrés
            filteredAgences: [],
            allFilteredAgences: [], // Pour stocker tous les résultats filtrés avant pagination
            selectedAgences: [],
            // Sélectionner tous les agences
            selectAll: false,
            // Trier par nom, téléphone, email, localisation au niveau des en-têtes des colonnes
            sortField: 'nom_agence',
            sortDirection: 'asc',
            // Afficher les informations de pagination
            currentPage: 1,
            itemsPerPage: 5,
            searchQuery: '',
            // Afficher si des agences sont sélectionnés
            get hasSelection() {
                return this.selectedAgences.length > 0;
            },
            // Afficher le nombre total de pages
            get totalPages() {
                return Math.ceil(this.allFilteredAgences.length / this.itemsPerPage);
            },
            // Afficher le nombre total de résultats filtrés
            get filteredCount() {
                return this.allFilteredAgences.length;
            },
            // Afficher les informations de pagination
            get paginationInfo() {
                const start = (this.currentPage - 1) * this.itemsPerPage;
                const end = Math.min(start + this.itemsPerPage, this.allFilteredAgences.length);
                return { start, end };
            },
    
            // Selectionner tous les agences
            toggleSelectAll() {
            
              if (!this.selectAll) {

                const visibleAgenceIds = this.filteredAgences.map(agence => agence.id);
                this.selectedAgences = [...new Set([...this.selectedAgences, ...visibleAgenceIds])];
              } else {
                  this.selectedAgences = [];
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
                let result = [...this.agences];
                
                if (this.searchQuery && this.searchQuery.trim() !== '') {
                    const query = this.searchQuery.toLowerCase().trim();
                    result = result.filter(agence => 
                        (agence.nom_agence && agence.nom_agence.toLowerCase().includes(query)) ||
                        (agence.email && agence.email.toLowerCase().includes(query)) ||
                        (agence.localisation && agence.localisation.toLowerCase().includes(query)) ||
                        (agence.ville && agence.ville.toLowerCase().includes(query)) ||
                        (agence.telephone && agence.telephone.includes(query))
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
                this.allFilteredAgences = [...result];
                
                // Appliquer la pagination
                const start = (this.currentPage - 1) * this.itemsPerPage;
                const end = Math.min(start + this.itemsPerPage, result.length);
                this.filteredAgences = result.slice(start, end);
                
                console.log('Résultats filtrés:', this.filteredAgences.length);
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
            // Supprimer un agence
            deleteAgence(id, name) {
                if (confirm(`Êtes-vous sûr de vouloir supprimer l'agence "${name}" ?`)) {

                    fetch(`/admin/agences/${id}`, {
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
                            // Afficher un message de succès avec le composant toast
                            // Je cree l'évènement
                            const toastEvent = new CustomEvent('show-toast', {
                                detail: {
                                    type: 'success',
                                    message: `L'agence "${name}" a été supprimé avec succès.`
                                }
                            });
                            // Je déclenche l'évènement
                            window.dispatchEvent(toastEvent);
                            window.location.reload();
                            // Supprimer l'agence de la liste et rafraîchir l'affichage
                            /* this.agences = this.agences.filter(agence => agence.id !== id);
                            this.applyFiltersAndSort(); */
                            
                            
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
              console.log('selectedAgences', this.selectedAgences);
                // Initialiser l'affichage avec tous les agences
                this.applyFiltersAndSort();
                
                // Écouter les événements de recherche à plusieurs niveaux
                document.addEventListener('search-agences', this.handleSearch.bind(this));
                // Écouter les événements de recherche au niveau de la page
                window.addEventListener('search-agences', this.handleSearch.bind(this));

                // Écouter les événements de sélection
                this.$watch('filteredAgences', () => {
                  console.log('filteredAgences', this.filteredAgences);
                  this.selectAll = this.filteredAgences.length > 0 && 
                  this.filteredAgences.every(agence => this.selectedAgences.includes(agence.id));
                  // Initialiser les icônes Lucide
                  setTimeout(() => {
                    if (window.lucide) {
                      window.lucide.createIcons();
                    }
                  },0);
                     // **Ré-initialiser les dropdowns FlyonUI / Preline**
                if (window.HSStaticMethods) {
                window.HSStaticMethods.autoInit(['dropdown']);
                }
                  // Notifier le changement de sélection
                this.notifySelectionChange();
                console.log('selectAll', this.selectAll);
                });
                
                this.$watch('selectedAgences', () => {
                  console.log('selectedAgences', this.selectedAgences);
                 
                  // Vérifier si tous les agences sont sélectionnés
                  this.selectAll = this.filteredAgences.length > 0 && 
                    this.filteredAgences.every(agence => this.selectedAgences.includes(agence.id));
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