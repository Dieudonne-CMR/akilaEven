@props(['bookings' => []])
@if(session('success'))
<x-ui.toast type="success" message="{{ session('success')}}" position="bottom-right" />
@endif
@if(session('error'))
<x-ui.toast type="error" message="{{ session('error')}}" position="bottom-right" />
     
@endif

@if(session()->has('errors') && session("error")->has("status"))
        <div class="alert alert-danger">
            {{ session("error")->first("status") }}
        </div>
@endif
{{-- @error('title')

    <div class="alert alert-danger">{{ $message }}</div>

@enderror --}}

<div 
    x-data="bookingTableComponent({{ json_encode($bookings) }})" 
    class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg"
    @search-bookings.window="handleSearch($event)"
    @filter-bookings.window="handleFilter($event)"
    @bulk-delete-bookings.window="bulkDelete"
>
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
                    <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('full_name')">
                        <div class="flex items-center">
                            Nom complet
                            <template x-if="sortField === 'full_name' && sortDirection === 'asc'">
                                <i data-lucide="chevron-up" class="w-4 h-4 ml-1"></i>
                            </template>
                            <template x-if="sortField === 'full_name' && sortDirection === 'desc'">
                                <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                            </template>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('email')">
                        <div class="flex items-center">
                            Contact
                            <template x-if="sortField === 'email' && sortDirection === 'asc'">
                                <i data-lucide="chevron-up" class="w-4 h-4 ml-1"></i>
                            </template>
                            <template x-if="sortField === 'email' && sortDirection === 'desc'">
                                <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                            </template>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('address')">
                        <div class="flex items-center">
                            Adresse
                            <template x-if="sortField === 'address' && sortDirection === 'asc'">
                                <i data-lucide="chevron-up" class="w-4 h-4 ml-1"></i>
                            </template>
                            <template x-if="sortField === 'address' && sortDirection === 'desc'">
                                <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                            </template>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('status')">
                        <div class="flex items-center">
                            Statut
                            <template x-if="sortField === 'status' && sortDirection === 'asc'">
                                <i data-lucide="chevron-up" class="w-4 h-4 ml-1"></i>
                            </template>
                            <template x-if="sortField === 'status' && sortDirection === 'desc'">
                                <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                            </template>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(booking, index) in paginatedBookings" :key="booking.id">
                    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="w-4 px-4 py-3">
                            <div class="flex items-center">
                                <input 
                                    :id="'checkbox-table-' + booking.id" 
                                    type="checkbox" 
                                    x-model="selectedBookings"
                                    :value="parseInt(booking.id)"
                                    @change="updateSelectAll"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                >
                                <label :for="'checkbox-table-' + booking.id" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <span x-text="booking.full_name"></span>
                        </th>
                        <td class="px-4 py-3">
                            <div class="flex flex-col">
                                <div class="flex items-center">
                                    <i data-lucide="mail" class="w-4 h-4 mr-1 text-gray-400"></i>
                                    <span x-text="booking.email"></span>
                                </div>
                                <div class="flex items-center mt-1">
                                    <i data-lucide="phone" class="w-4 h-4 mr-1 text-gray-400"></i>
                                    <span x-text="booking.phone"></span>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <i data-lucide="map-pin" class="w-4 h-4 mr-1 text-gray-400"></i>
                                <span x-text="booking.address"></span>
                            </div>
                        </td>
                        <td class="px-4 py-3" x-html="booking.status_badge"></td>
                        <td class="px-4 py-3">
                            <button 
                                :id="'dropdownMenuButton-' + booking.id" 
                                :data-dropdown-toggle="'dropdownMenu-' + booking.id" 
                                class="inline-flex items-center p-1 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" 
                                type="button"
                            >
                                <i data-lucide="more-vertical" class="w-5 h-5"></i>
                            </button>
                            
                            <!-- Menu déroulant -->
                            <div :id="'dropdownMenu-' + booking.id" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <ul     x-data="{ status: booking.status }"  class="py-2 text-sm text-gray-700 dark:text-gray-200" :aria-labelledby="'dropdownMenuButton-' + booking.id">
                                    <li>
                                        <a :href="'/admin/bookings/' + booking.id" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                            Voir détails
                                        </a>
                                    </li>
                                    <li>
                                        <a @click="deleteBooking(booking.id)" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            <i data-lucide="trash-2" class="w-4 h-4 mr-2 text-red-500"></i>
                                            Supprimer
                                        </a>
                                    </li>
                                    
                                    <!-- Actions spécifiques selon le statut -->
                                    <template x-if="booking.status === 'pending'">
                                        <li>
                                            <form
                                                x-bind:action="`/admin/bookings/${booking.id}/status`"
                                                method="POST"
                                                class="inline"
                                            >
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="accepted">
                                                <a href="#" onclick="event.preventDefault(); if(confirm('Confirmer l\'acceptation ?')) this.closest('form').submit();" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                                                    <i data-lucide="check" class="w-4 h-4 mr-2 text-blue-500"></i>
                                                    Accepter
                                                </a>
                                            </form>
                                        </li>
                                    </template>
                                    
                                    <template x-if="booking.status === 'pending'">
                                        <li>
                                            <form
                                                x-bind:action="`/admin/bookings/${booking.id}/status`"
                                                method="POST"
                                                class="inline"
                                            >
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="cancelled">
                                                <a href="#" onclick="event.preventDefault(); if(confirm('Confirmer l\'annulation ?')) this.closest('form').submit();" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                                                    <i data-lucide="x-circle" class="w-4 h-4 mr-2 text-red-500"></i>
                                                    Annuler
                                                </a>
                                            </form>
                                        </li>
                                    </template>
                                    
                                    <template x-if="booking.status === 'accepted'">
                                        <li>
                                            <form
                                                x-bind:action="`/admin/bookings/${booking.id}/status`"
                                                method="POST"
                                                class="inline"
                                            >
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="cancelled">
                                                <a href="#" onclick="event.preventDefault(); if(confirm('Confirmer l\'annulation ?')) this.closest('form').submit();" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                                                    <i data-lucide="x-circle" class="w-4 h-4 mr-2 text-red-500"></i>
                                                    Annuler
                                                </a>
                                            </form>
                                        </li>
                                    </template>
                                    
                                    <template x-if="booking.status === 'booked'">
                                        <li>
                                            <form
                                                x-bind:action="`/admin/bookings/${booking.id}/status`"
                                                method="POST"
                                                class="inline"
                                            >
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="completed">
                                                <a href="#" onclick="event.preventDefault(); if(confirm('Confirmer la complétion ?')) this.closest('form').submit();" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                                                    <i data-lucide="check-circle" class="w-4 h-4 mr-2 text-green-500"></i>
                                                    Compléter
                                                </a>
                                            </form>
                                        </li>
                                    </template>
                                    
                                    <template x-if="booking.status === 'booked'">
                                        <li>
                                            <form
                                                x-bind:action="`/admin/bookings/${booking.id}/status`"
                                                method="POST"
                                                class="inline"
                                            >
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="cancelled">
                                                <a href="#" onclick="event.preventDefault(); if(confirm('Confirmer l\'annulation ?')) this.closest('form').submit();" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                                                    <i data-lucide="x-circle" class="w-4 h-4 mr-2 text-red-500"></i>
                                                    Annuler
                                                </a>
                                            </form>
                                        </li>
                                    </template>
                                    
                                    <template x-if="booking.status === 'completed'">
                                        <li>
                                         
                                            <form
                                            x-bind:action="`/admin/bookings/${booking.id}/status`"  {{-- récupère booking.id --}}
                                            method="POST"
                                            class="inline"
                                            
                                          >
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="refunded">
                                            <a href="#" onclick="event.preventDefault(); if(confirm('Confirmer l’acceptation ?')) this.closest('form').submit();" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 ">
                                                <i data-lucide="refresh-cw" class="w-4 h-4 mr-2 text-yellow-500"></i>
                                                Rembourser
                                            </a>
                                       
                                          </form>
                                            
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </template>
                
                <!-- Message si aucun résultat -->
                <tr x-show="filteredBookings.length === 0" class="border-b dark:border-gray-600">
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                        <x-dashboard.empty-state 
                            icon="search-x" 
                            title="Aucune réservation trouvée" 
                            message="Essayez de modifier vos critères de recherche ou de consulter ultérieurement."
                        />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation" x-show="filteredBookings.length > 0">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
            Affichage
            <span class="font-semibold text-gray-900 dark:text-white" x-text="paginationInfo.start + 1"></span>
            -
            <span class="font-semibold text-gray-900 dark:text-white" x-text="paginationInfo.end"></span>
            sur
            <span class="font-semibold text-gray-900 dark:text-white" x-text="filteredBookings.length"></span>
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
function bookingTableComponent(bookings) {
    return {
        bookings: bookings,
        filteredBookings: [],
        paginatedBookings: [],
        selectedBookings: [],
        selectAll: false,
        sortField: 'full_name',
        sortDirection: 'asc',
        currentPage: 1,
        itemsPerPage: 5,
        searchQuery: '',
        currentFilter: 'all',
        
        get hasSelection() {
            return this.selectedBookings.length > 0;
        },
        
        get totalPages() {
            return Math.ceil(this.filteredBookings.length / this.itemsPerPage);
        },
        
        get paginationInfo() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = Math.min(start + this.itemsPerPage, this.filteredBookings.length);
            return { start, end };
        },
       
        toggleSelectAll() {
            if (!this.selectAll) {
                // Si on coche la case, sélectionner tous les éléments de la page actuelle
                this.selectedBookings = this.paginatedBookings.map(booking => parseInt(booking.id));
                this.selectAll = true;
            } else {
                // Si on décoche la case, désélectionner tous les éléments
                this.selectedBookings = [];
                this.selectAll = false;
            }
            this.notifySelectionChange();
        },
        
        updateSelectAll() {
            // Vérifie si tous les éléments de la page actuelle sont sélectionnés
            this.selectAll = this.paginatedBookings.every(booking => 
                this.selectedBookings.includes(parseInt(booking.id))
            ) && this.paginatedBookings.length > 0;
            
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
            let result = [...this.bookings];
            
            if (this.searchQuery) {
                const query = this.searchQuery.toLowerCase();
                result = result.filter(booking => 
                    (booking.full_name && booking.full_name.toLowerCase().includes(query)) ||
                    (booking.email && booking.email.toLowerCase().includes(query)) ||
                    (booking.address && booking.address.toLowerCase().includes(query)) ||
                    (booking.phone && booking.phone.includes(query))
                );
            }
            
            // Filtrage par statut
            if (this.currentFilter !== 'all') {
                result = result.filter(booking => booking.status === this.currentFilter);
            }
            
            // Tri
            result.sort((a, b) => {
                let aValue = a[this.sortField] || '';
                let bValue = b[this.sortField] || '';
                
                if (aValue < bValue) return this.sortDirection === 'asc' ? -1 : 1;
                if (aValue > bValue) return this.sortDirection === 'asc' ? 1 : -1;
                return 0;
            });
            
            this.filteredBookings = result;
            this.updatePaginatedBookings();
            
            // Notifier le header du nombre de réservations
            window.dispatchEvent(new CustomEvent('bookings-updated', {
                detail: { count: this.filteredBookings.length }
            }));
            
            // Notifier que les composants doivent être rafraîchis
            window.dispatchEvent(new CustomEvent('refreshComponents'));
            
            // Réinitialiser la pagination si nécessaire
            if (this.currentPage > this.totalPages && this.totalPages > 0) {
                this.currentPage = 1;
                this.updatePaginatedBookings();
            }
        },
        
        updatePaginatedBookings() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            this.paginatedBookings = this.filteredBookings.slice(start, end);
            
            // Mettre à jour l'état de selectAll après mise à jour des éléments paginés
            this.$nextTick(() => {
                this.updateSelectAll();
                this.updateIcons();
                this.initializeDropdowns();
            });
        },
        
        // Réinitialiser les dropdowns
        initializeDropdowns() {
            setTimeout(() => {
                // Réinitialisation des dropdowns de Flowbite si disponible
                if (window.Flowbite && window.Flowbite.initDropdowns) {
                    window.Flowbite.initDropdowns();
                } else if (typeof initFlowbite === 'function') {
                    initFlowbite();
                } else if (document.querySelectorAll('[data-dropdown-toggle]').length > 0) {
                    // Fallback: parcourir tous les éléments dropdown et les réinitialiser manuellement
                    document.querySelectorAll('[data-dropdown-toggle]').forEach(trigger => {
                        const targetId = trigger.getAttribute('data-dropdown-toggle');
                        const target = document.getElementById(targetId);
                        
                        if (target) {
                            trigger.addEventListener('click', () => {
                                target.classList.toggle('hidden');
                            });
                        }
                    });
                }
            }, 100);
        },
        
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
                this.updatePaginatedBookings();
            }
        },
        
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
                this.updatePaginatedBookings();
            }
        },
        
        goToPage(page) {
            this.currentPage = page;
            this.updatePaginatedBookings();
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
        
        // Gérer le filtrage
        handleFilter(event) {
            this.currentFilter = event.detail.status;
            this.currentPage = 1;
            this.applyFiltersAndSort();
        },
        
        // Supprimer une réservation
        deleteBooking(id) {
            console.log(id)
            if (confirm(`Êtes-vous sûr de vouloir supprimer la réservation avec l'ID ${id} ?`)) {
                fetch(`/admin/bookings/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Supprimer la réservation du tableau
                        this.bookings = this.bookings.filter(booking => booking.id !== id);
                        // Rafraîchir l'affichage
                        this.applyFiltersAndSort();
                        // Afficher un message de succès
                        this.showToast('success', 'La réservation a été supprimée avec succès.');
                    } else {
                        this.showToast('error', data.message || 'Une erreur est survenue lors de la suppression.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.showToast('error', 'Une erreur est survenue lors de la suppression.');
                });
            }
        },
        
        // Supprimer plusieurs réservations
        bulkDelete() {
            if (this.selectedBookings.length === 0) return;
            
            if (confirm(`Êtes-vous sûr de vouloir supprimer ${this.selectedBookings.length} réservation(s) ?`)) {
                fetch('/admin/bookings/bulk-delete', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ ids: this.selectedBookings })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Supprimer les réservations du tableau
                        this.bookings = this.bookings.filter(booking => !this.selectedBookings.includes(parseInt(booking.id)));
                        this.selectedBookings = [];
                        // Rafraîchir l'affichage
                        this.applyFiltersAndSort();
                        // Afficher un message de succès
                        this.showToast('success', `${data.count} réservation(s) ont été supprimée(s) avec succès.`);
                    } else {
                        this.showToast('error', data.message || 'Une erreur est survenue lors de la suppression.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.showToast('error', 'Une erreur est survenue lors de la suppression des réservations.');
                });
            }
        },
        
        // Mettre à jour le statut d'une réservation
        updateStatus(id, newStatus) {
            const statusLabels = {
                'accepted': 'acceptée',
                'cancelled': 'annulée',
                'completed': 'complétée',
                'refunded': 'remboursée'
            };
            
            fetch(`/admin/bookings/${id}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mettre à jour le statut dans le tableau
                   /*  this.bookings = this.bookings.map(booking => {
                        if (booking.id === id) {
                            // Mettre à jour le statut
                            booking.status = newStatus;
                            
                            // Mettre à jour le badge de statut avec les classes appropriées
                            const statusClass = {
                                'pending': 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                'accepted': 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                'booked': 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300',
                                'completed': 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                'cancelled': 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                'refunded': 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300'
                            };
                            
                            const statusText = {
                                'pending': 'En attente',
                                'accepted': 'Acceptée',
                                'booked': 'Réservée',
                                'completed': 'Complétée',
                                'cancelled': 'Annulée',
                                'refunded': 'Remboursée'
                            };
                            
                            booking.status_badge = `<span class="px-2 py-1 text-xs font-medium rounded-full ${statusClass[newStatus]}">${statusText[newStatus]}</span>`;
                        }
                        return booking;
                    });
                     */
                     window.dispatchEvent(new CustomEvent('refreshComponents'));
                     // Rafraîchir l'affichage
                    this.applyFiltersAndSort();
                    
                    // Notifier que les composants doivent être rafraîchis
                    window.dispatchEvent(new CustomEvent('refreshComponents'));
                    
                    // Afficher un message de succès
                    this.showToast('success', `La réservation a été ${statusLabels[newStatus] || 'mise à jour'} avec succès.`);
                
                } else {
                    this.showToast('error', data.message || 'Une erreur est survenue lors de la mise à jour.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.showToast('error', 'Une erreur est survenue lors de la mise à jour du statut.');
            });
        },
        
        // Afficher un message toast
        showToast(type, message) {
            window.dispatchEvent(new CustomEvent('show-toast', {
                detail: { type, message }
            }));
        },
        
        init() {
            // Initialiser l'affichage avec toutes les réservations
            this.applyFiltersAndSort();
            
            // Observer les changements
            this.$watch('selectedBookings', () => {
                this.updateSelectAll();
                this.notifySelectionChange();
            });
            
            this.$watch('currentPage', () => {
                this.updatePaginatedBookings();
            });
            
            // Initialisation des icônes Lucide et des dropdowns
            this.updateIcons();
            this.initializeDropdowns();
        }
    }
}
</script> 