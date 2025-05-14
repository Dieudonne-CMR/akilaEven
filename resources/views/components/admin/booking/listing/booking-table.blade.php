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


<div 
    x-data="bookingTableComponent({{ json_encode($bookings) }})" 
    class="relative bg-white shadow-md sm:rounded-lg"
    @search-bookings.window="handleSearch($event)"
    @filter-bookings.window="handleFilter($event)"
    @bulk-delete-bookings.window="bulkDelete"
>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-4 py-3">
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                x-model="selectAll"
                                @change="toggleSelectAll"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                            >
                            <label class="sr-only">Checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3" @click="sortBy('full_name')">
                        <div class="flex items-center">
                            Nom complet
                            <span x-show="sortField === 'full_name'" class="inline-block ml-1">
                                <template x-if="sortDirection === 'asc'">&#8593;</template>
                                <template x-if="sortDirection === 'desc'">&#8595;</template>
                            </span>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3" @click="sortBy('email')">
                        <div class="flex items-center">
                            Contact
                            <span x-show="sortField === 'email'" class="inline-block ml-1">
                                <template x-if="sortDirection === 'asc'">&#8593;</template>
                                <template x-if="sortDirection === 'desc'">&#8595;</template>
                            </span>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3" @click="sortBy('address')">
                        <div class="flex items-center">
                            Adresse
                            <span x-show="sortField === 'address'" class="inline-block ml-1">
                                <template x-if="sortDirection === 'asc'">&#8593;</template>
                                <template x-if="sortDirection === 'desc'">&#8595;</template>
                            </span>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3" @click="sortBy('status')">
                        <div class="flex items-center">
                            Statut
                            <span x-show="sortField === 'status'" class="inline-block ml-1">
                                <template x-if="sortDirection === 'asc'">&#8593;</template>
                                <template x-if="sortDirection === 'desc'">&#8595;</template>
                            </span>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(booking, index) in paginatedBookings" :key="booking.id">
                    <tr class="border-b hover:bg-gray-100">
                        <td class="w-4 px-4 py-3">
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    :checked="isSelected(parseInt(booking.id))"
                                    @change="toggleSelection(parseInt(booking.id))"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                >
                                <label class="sr-only">Checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
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
                        <td class="px-4 py-3">
                            <span 
                                :class="statusClasses[booking.status]"
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                x-text="statusLabels[booking.status]"
                            ></span>
                        </td>
                        <td class="px-4 py-3">
                            <button 
                                type="button" 
                                :id="'dropdownMenuButton-' + booking.id" 
                                data-dropdown-toggle="'dropdown-' + booking.id" 
                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                @click="$refs['dropdown-' + booking.id].classList.toggle('hidden')"
                            >
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                            <div 
                                :id="'dropdown-' + booking.id" 
                                x-ref="'dropdown-' + booking.id"
                                class="absolute z-10 hidden divide-y divide-gray-100 rounded-lg shadow w-44"
                            >
                                <ul     x-data="{ status: booking.status }"  class="py-2 text-sm text-gray-700" :aria-labelledby="'dropdownMenuButton-' + booking.id">
                                    <li>
                                        <a :href="'/admin/bookings/' + booking.id" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                                            <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                            Voir détails
                                        </a>
                                    </li>
                                    <li>
                                        <a @click="deleteBooking(booking.id)" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                                            <i data-lucide="trash-2" class="w-4 h-4 mr-2 text-red-500"></i>
                                            Supprimer
                                        </a>
                                    </li>
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
                                            <a href="#" onclick="event.preventDefault(); if(confirm('Confirmer l'acceptation ?')) this.closest('form').submit();" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 ">
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
                <tr x-show="filteredBookings.length === 0" class="border-b">
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                        <x-ui.empty-state 
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
    <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500">
            Affichage
            <span class="font-semibold text-gray-900" x-text="paginationInfo.start + 1"></span>
            -
            <span class="font-semibold text-gray-900" x-text="paginationInfo.end"></span>
            sur
            <span class="font-semibold text-gray-900" x-text="filteredBookings.length"></span>
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
                        :class="{ 'text-blue-600 bg-blue-50 border-blue-300 hover:bg-blue-100 hover:text-blue-700': currentPage === page }"
                        class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 cursor-pointer hover:bg-gray-100 hover:text-gray-700"
                        x-text="page"
                    ></a>
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
        statusClasses: {
            'pending': 'bg-yellow-100 text-yellow-800',
            'accepted': 'bg-blue-100 text-blue-800',
            'booked': 'bg-indigo-100 text-indigo-800',
            'completed': 'bg-green-100 text-green-800',
            'cancelled': 'bg-red-100 text-red-800',
            'refunded': 'bg-purple-100 text-purple-800'
        },
        statusLabels: {
            'pending': 'En attente',
            'accepted': 'Acceptée',
            'booked': 'Réservée',
            'completed': 'Complétée',
            'cancelled': 'Annulée',
            'refunded': 'Remboursée'
        },
        sortColumn: null,
        selectedBookingIds: [],
        bookingToDelete: null,
        showConfirmModal: false,
        
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
                this.selectedBookings = this.paginatedBookings.map(booking => parseInt(booking.id));
                this.selectAll = true;
            } else {
                this.selectedBookings = [];
                this.selectAll = false;
            }
            this.notifySelectionChange();
        },
        
        updateSelectAll() {
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
            setTimeout(() => {
                if (window.lucide) {
                    window.lucide.createIcons();
                }
            }, 0);
        },
        
        applyFiltersAndSort() {
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
            
            if (this.currentFilter !== 'all') {
                result = result.filter(booking => booking.status === this.currentFilter);
            }
            
            result.sort((a, b) => {
                let aValue = a[this.sortField] || '';
                let bValue = b[this.sortField] || '';
                
                if (aValue < bValue) return this.sortDirection === 'asc' ? -1 : 1;
                if (aValue > bValue) return this.sortDirection === 'asc' ? 1 : -1;
                return 0;
            });
            
            this.filteredBookings = result;
            this.updatePaginatedBookings();
            
            window.dispatchEvent(new CustomEvent('bookings-updated', {
                detail: { count: this.filteredBookings.length }
            }));
            
            window.dispatchEvent(new CustomEvent('refreshComponents'));
            
            if (this.currentPage > this.totalPages && this.totalPages > 0) {
                this.currentPage = 1;
                this.updatePaginatedBookings();
            }
        },
        
        updatePaginatedBookings() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            this.paginatedBookings = this.filteredBookings.slice(start, end);
            
            this.$nextTick(() => {
                this.updateSelectAll();
                this.updateIcons();
                this.initializeDropdowns();
            });
        },
        
        initializeDropdowns() {
            setTimeout(() => {
                if (window.Flowbite && window.Flowbite.initDropdowns) {
                    window.Flowbite.initDropdowns();
                } else if (typeof initFlowbite === 'function') {
                    initFlowbite();
                } else if (document.querySelectorAll('[data-dropdown-toggle]').length > 0) {
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
        
        handleSearch(event) {
            this.searchQuery = event.detail.query;
            this.currentPage = 1;
            this.applyFiltersAndSort();
        },
        
        handleFilter(event) {
            this.currentFilter = event.detail.status;
            this.currentPage = 1;
            this.applyFiltersAndSort();
        },
        
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
                        this.bookings = this.bookings.filter(booking => booking.id !== id);
                        this.applyFiltersAndSort();
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
                        this.bookings = this.bookings.filter(booking => !this.selectedBookings.includes(parseInt(booking.id)));
                        this.selectedBookings = [];
                        this.applyFiltersAndSort();
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
                    window.dispatchEvent(new CustomEvent('refreshComponents'));
                    this.applyFiltersAndSort();
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
        
        showToast(type, message) {
            window.dispatchEvent(new CustomEvent('show-toast', {
                detail: { type, message }
            }));
        },
        
        init() {
            this.applyFiltersAndSort();
            
            this.$watch('selectedBookings', () => {
                this.updateSelectAll();
                this.notifySelectionChange();
            });
            
            this.$watch('currentPage', () => {
                this.updatePaginatedBookings();
            });
            
            this.updateIcons();
            this.initializeDropdowns();
        },
        
        isSelected(bookingId) {
            return this.selectedBookings.includes(parseInt(bookingId));
        },
        
        toggleSelection(bookingId) {
            const index = this.selectedBookings.indexOf(parseInt(bookingId));
            if (index === -1) {
                this.selectedBookings.push(parseInt(bookingId));
            } else {
                this.selectedBookings.splice(index, 1);
            }
            
            this.selectAll = this.paginatedBookings.every(booking => 
                this.selectedBookings.includes(parseInt(booking.id))
            );
        }
    }
}
</script> 