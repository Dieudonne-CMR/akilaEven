@extends('admin.layouts.layout-admin')
@section('content-admin')

<x-admin.dashboard-panel class="">
   <!-- Contenu Principal -->
   
   <div class="">
      <!-- HeaderComponent -->
      <div 
         x-data="headerComponent()" 
         class="mb-6">
         <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Système de Gestion des Réservations</h1>
            <p class="mt-1 text-gray-600 dark:text-gray-400">Gérez toutes vos réservations d'hôtel et de salles de fête en un seul endroit</p>
            <div class="inline-flex items-center px-3 py-1 mt-4 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                  <i data-lucide="calendar-check" class="w-4 h-4 mr-1"></i>
                  <span x-text="bookingsCount + ' Réservations au total'"></span>
            </div>
         </div>
      </div>

      <!-- ActionBarComponent -->
      <div 
         x-data="actionBarComponent()" 
         class="mb-6">
         <div class="p-4 bg-white rounded-lg shadow-sm dark:bg-gray-800">
            <div class="flex flex-col space-y-3 md:flex-row md:items-center md:justify-between md:space-y-0">
                  <!-- SearchInput -->
                  <div class="relative w-full md:w-1/3">
                     <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i data-lucide="search" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                     </div>
                     <input 
                        type="text" 
                        x-model="searchQuery" 
                        @input="search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        placeholder="Rechercher des réservations..."
                     >
                  </div>
                  
                  <!-- Filter Dropdown -->
                  <div class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center md:space-y-0 md:space-x-3">
                     <button 
                        id="filterDropdownButton" 
                        data-dropdown-toggle="filterDropdown" 
                        class="flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                        type="button"
                     >
                        <i data-lucide="filter" class="w-4 h-4 mr-2"></i>
                        Filtrer
                        <i data-lucide="chevron-down" class="w-3 h-3 ml-2"></i>
                     </button>
                     
                     <!-- Filter Dropdown menu -->
                     <div id="filterDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="filterDropdownButton">
                              <li>
                                 <a @click="filterByStatus('all')" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" :class="{'bg-gray-100 dark:bg-gray-600': currentFilter === 'all'}">
                                    <span>Toutes les réservations</span>
                                 </a>
                              </li>
                              <li>
                                 <a @click="filterByStatus('pending')" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" :class="{'bg-gray-100 dark:bg-gray-600': currentFilter === 'pending'}">
                                    <span class="w-3 h-3 mr-2 bg-gray-300 rounded-full"></span>
                                    <span>En attente</span>
                                 </a>
                              </li>
                              <li>
                                 <a @click="filterByStatus('accepted')" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" :class="{'bg-gray-100 dark:bg-gray-600': currentFilter === 'accepted'}">
                                    <span class="w-3 h-3 mr-2 bg-purple-500 rounded-full"></span>
                                    <span>Acceptées</span>
                                 </a>
                              </li>
                              <li>
                                 <a @click="filterByStatus('booked')" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" :class="{'bg-gray-100 dark:bg-gray-600': currentFilter === 'booked'}">
                                    <span class="w-3 h-3 mr-2 bg-blue-500 rounded-full"></span>
                                    <span>Réservées</span>
                                 </a>
                              </li>
                              <li>
                                 <a @click="filterByStatus('completed')" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" :class="{'bg-gray-100 dark:bg-gray-600': currentFilter === 'completed'}">
                                    <span class="w-3 h-3 mr-2 bg-green-500 rounded-full"></span>
                                    <span>Complétées</span>
                                 </a>
                              </li>
                              <li>
                                 <a @click="filterByStatus('cancelled')" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" :class="{'bg-gray-100 dark:bg-gray-600': currentFilter === 'cancelled'}">
                                    <span class="w-3 h-3 mr-2 bg-red-500 rounded-full"></span>
                                    <span>Annulées</span>
                                 </a>
                              </li>
                              <li>
                                 <a @click="filterByStatus('refunded')" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" :class="{'bg-gray-100 dark:bg-gray-600': currentFilter === 'refunded'}">
                                    <span class="w-3 h-3 mr-2 bg-yellow-500 rounded-full"></span>
                                    <span>Remboursées</span>
                                 </a>
                              </li>
                        </ul>
                     </div>
                     
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
                        <i data-lucide="chevron-down" class="w-3 h-3 ml-2"></i>
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
                              <li>
                                 <a @click="exportText" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <i data-lucide="file" class="w-4 h-4 mr-2"></i>
                                    Exporter en texte
                                 </a>
                              </li>
                        </ul>
                     </div>
                  </div>
            </div>
         </div>
      </div>

      <!-- BookingTableComponent -->
      <div 
         x-data="bookingTableComponent()" 
         class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
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
                        <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('fullname')">
                              <div class="flex items-center">
                                 Nom complet
                                 <template x-if="sortField === 'fullname' && sortDirection === 'asc'">
                                    <i data-lucide="chevron-up" class="w-4 h-4 ml-1"></i>
                                 </template>
                                 <template x-if="sortField === 'fullname' && sortDirection === 'desc'">
                                    <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                                 </template>
                              </div>
                        </th>
                        <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('contact')">
                              <div class="flex items-center">
                                 Contact
                                 <template x-if="sortField === 'contact' && sortDirection === 'asc'">
                                    <i data-lucide="chevron-up" class="w-4 h-4 ml-1"></i>
                                 </template>
                                 <template x-if="sortField === 'contact' && sortDirection === 'desc'">
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
                                 <span x-text="booking.fullname"></span>
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
                                 <!-- Badge de statut -->
                                 <template x-if="booking.status === 'pending'">
                                    <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center w-fit">
                                          <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                                          En attente
                                    </span>
                                 </template>
                                 <template x-if="booking.status === 'accepted'">
                                    <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center w-fit">
                                          <i data-lucide="check" class="w-3 h-3 mr-1"></i>
                                          Acceptée
                                    </span>
                                 </template>
                                 <template x-if="booking.status === 'completed'">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center w-fit">
                                          <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                          Completée
                                    </span>
                                 </template>
                                 <template x-if="booking.status === 'cancelled'">
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center w-fit">
                                          <i data-lucide="x-circle" class="w-3 h-3 mr-1"></i>
                                          Annulée
                                    </span>
                                 </template>
                                 <template x-if="booking.status === 'refunded'">
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center w-fit">
                                          <i data-lucide="refresh-cw" class="w-3 h-3 mr-1"></i>
                                          Remboursée
                                    </span>
                                 </template>
                                 <template x-if="booking.status === 'booked'">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center w-fit">
                                          <i data-lucide="lock" class="w-3 h-3 mr-1"></i>
                                          Réservée
                                    </span>
                                 </template>
                              </td>
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
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" :aria-labelledby="'dropdownMenuButton-' + booking.id">
                                          <li>
                                             <a href="#" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                                Voir détails
                                             </a>
                                          </li>
                                          <li>
                                             <a href="#" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                <i data-lucide="trash-2" class="w-4 h-4 mr-2 text-red-500"></i>
                                                Supprimer
                                             </a>
                                          </li>
                                          <template x-if="booking.status === 'pending'">
                                             <li>
                                                <a href="#" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                      <i data-lucide="check" class="w-4 h-4 mr-2 text-blue-500"></i>
                                                      Accepter
                                                </a>
                                             </li>
                                          </template>
                                          <template x-if="booking.status === 'accepted'">
                                             <li>
                                                <a href="#" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                      <i data-lucide="check-circle" class="w-4 h-4 mr-2 text-green-500"></i>
                                                      Compléter
                                                </a>
                                             </li>
                                          </template>
                                          <template x-if="booking.status !== 'cancelled' && booking.status !== 'refunded'">
                                             <li>
                                                <a href="#" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                      <i data-lucide="x-circle" class="w-4 h-4 mr-2 text-red-500"></i>
                                                      Annuler
                                                </a>
                                             </li>
                                          </template>
                                    </ul>
                                 </div>
                              </td>
                        </tr>
                     </template>
                  </tbody>
            </table>
         </div>
         
         <!-- Pagination -->
         <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                  Affichage
                  <span class="font-semibold text-gray-900 dark:text-white" x-text="paginationInfo.start + 1"></span>
                  -
                  <span class="font-semibold text-gray-900 dark:text-white" x-text="paginationInfo.end"></span>
                  sur
                  <span class="font-semibold text-gray-900 dark:text-white" x-text="filteredBookings.length"></span>
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
   </div>
  
  <!-- Alpine.js Component Logic -->
  <script>
      // HeaderComponent
      function headerComponent() {
          return {
              bookingsCount: 0,
              
              init() {
                  // Écouter les mises à jour du nombre de réservations
                  window.addEventListener('bookings-updated', (event) => {
                      this.bookingsCount = event.detail.count;
                  });
              }
          }
      }

      // ActionBarComponent
      function actionBarComponent() {
          return {
              searchQuery: '',
              currentFilter: 'all',
              hasSelection: false,
              
              search() {
                  window.dispatchEvent(new CustomEvent('search-bookings', { 
                      detail: { query: this.searchQuery } 
                  }));
              },
              
              filterByStatus(status) {
                  this.currentFilter = status;
                  window.dispatchEvent(new CustomEvent('filter-bookings', { 
                      detail: { status: status } 
                  }));
              },
              
              bulkDelete() {
                  console.log('Suppression groupée des réservations sélectionnées');
              },
              
              exportPDF() {
                  console.log('Export en PDF');
              },
              
              exportCSV() {
                  console.log('Export en CSV');
              },
              
              exportText() {
                  console.log('Export en texte');
              },
              
              init() {
                  window.addEventListener('selection-change', (event) => {
                      this.hasSelection = event.detail.hasSelection;
                  });
              }
          }
      }

      // BookingTableComponent
      function bookingTableComponent() {
          return {
              bookings: [
                  { id: 1, fullname: 'Jean Dupont', email: 'jean.dupont@example.com', phone: '+33 6 12 34 56 78', address: 'Hôtel de Luxe, Paris', status: 'completed' },
                  { id: 2, fullname: 'Marie Martin', email: 'marie.martin@example.com', phone: '+33 6 23 45 67 89', address: 'Suites Royales, Lyon', status: 'pending' },
                  { id: 3, fullname: 'Pierre Durand', email: 'pierre.d@example.com', phone: '+33 6 34 56 78 90', address: 'Grand Hôtel, Marseille', status: 'accepted' },
                  { id: 4, fullname: 'Sophie Lambert', email: 'sophie.l@example.com', phone: '+33 6 45 67 89 01', address: 'Hôtel du Port, Nice', status: 'cancelled' },
                  { id: 5, fullname: 'Thomas Moreau', email: 'thomas.m@example.com', phone: '+33 6 56 78 90 12', address: 'Résidence Les Alpes, Chamonix', status: 'refunded' },
                  { id: 6, fullname: 'Julie Petit', email: 'julie.p@example.com', phone: '+33 6 67 89 01 23', address: 'Hôtel Central, Bordeaux', status: 'completed' },
                  { id: 7, fullname: 'David Leroy', email: 'david.l@example.com', phone: '+33 6 78 90 12 34', address: 'Résidence Plage, Biarritz', status: 'pending' },
                  { id: 8, fullname: 'Laura Roux', email: 'laura.r@example.com', phone: '+33 6 89 01 23 45', address: 'Hôtel Vue Mer, Saint-Malo', status: 'accepted' },
                  { id: 9, fullname: 'Marc Simon', email: 'marc.s@example.com', phone: '+33 6 90 12 34 56', address: 'Suites du Centre, Lille', status: 'cancelled' },
                  { id: 10, fullname: 'Sarah Michel', email: 'sarah.m@example.com', phone: '+33 6 01 23 45 67', address: 'Résidence Lac, Annecy', status: 'refunded' },
                  { id: 11, fullname: 'Boris Daryl', email: 'sarah.m@example.com', phone: '+33 6 01 23 45 67', address: 'Résidence Lac, Annecy', status: 'booked' },
              ],
              filteredBookings: [],
              paginatedBookings: [],
              selectedBookings: [],
              selectAll: false,
              sortField: 'fullname',
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
                      this.selectedBookings = this.paginatedBookings.map(booking => booking.id);
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
                  const allSelected = this.paginatedBookings.every(booking => 
                      this.selectedBookings.includes(parseInt(booking.id))
                  );
                  this.selectAll = allSelected && this.paginatedBookings.length > 0;
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
                      lucide.createIcons();
                  },0);
              },
              
              applyFiltersAndSort() {
                  // Filtrage par recherche
                  let result = [...this.bookings];
                  
                  if (this.searchQuery) {
                      const query = this.searchQuery.toLowerCase();
                      result = result.filter(booking => 
                          booking.fullname.toLowerCase().includes(query) ||
                          booking.email.toLowerCase().includes(query) ||
                          booking.address.toLowerCase().includes(query) ||
                          booking.phone.includes(query)
                      );
                  }
                  
                  // Filtrage par statut
                  if (this.currentFilter !== 'all') {
                      result = result.filter(booking => booking.status === this.currentFilter);
                  }
                  
                  // Tri
                  result.sort((a, b) => {
                      let aValue = a[this.sortField];
                      let bValue = b[this.sortField];
                      
                      if (this.sortField === 'contact') {
                          aValue = a.email;
                          bValue = b.email;
                      }
                      
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
                  
                  // Réinitialiser la pagination si nécessaire
                  if (this.currentPage > this.totalPages) {
                      this.currentPage = 1;
                  }
                  
                  // Mettre à jour l'état de selectAll après le filtrage
                  this.$nextTick(() => {
                      this.updateSelectAll();
                      this.updateIcons();
                  });
              },
              
              updatePaginatedBookings() {
                  const start = (this.currentPage - 1) * this.itemsPerPage;
                  const end = start + this.itemsPerPage;
                  this.paginatedBookings = this.filteredBookings.slice(start, end);
                  
                  // Mettre à jour l'état de selectAll après mise à jour des éléments paginés
                  this.$nextTick(() => {
                      this.updateSelectAll();
                      this.updateIcons();
                  });
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
              
              init() {
                  this.applyFiltersAndSort();
                  
                  window.addEventListener('search-bookings', (event) => {
                      this.searchQuery = event.detail.query;
                      this.currentPage = 1;
                      this.applyFiltersAndSort();
                  });
                  
                  window.addEventListener('filter-bookings', (event) => {
                      this.currentFilter = event.detail.status;
                      this.currentPage = 1;
                      this.applyFiltersAndSort();
                  });
                  
                  this.$watch('selectedBookings', () => {
                     console.log('selectedBookings changed:', this.selectedBookings);
                      this.updateSelectAll();
                      this.notifySelectionChange();
                  });
                  
                  this.$watch('currentPage', () => {
                      this.updatePaginatedBookings();
                  });

                  // Ajouter un watcher sur filteredBookings pour recréer les icônes
                  this.$watch('filteredBookings', () => {
                      this.updateIcons();
                  });

                  // Ajouter un watcher sur paginatedBookings pour recréer les icônes également
                  this.$watch('paginatedBookings', () => {
                      this.updateIcons();
                  });
              }
          }
      }
  </script>

  <!-- Initialize Lucide Icons -->
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          lucide.createIcons();
      });
  </script>
</x-admin.dashboard-panel>
