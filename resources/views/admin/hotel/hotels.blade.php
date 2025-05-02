@extends('admin.layouts.layout-admin')
@section('content-admin')

<x-admin.dashboard-panel class="">
   <!-- Ici votre contenu -->
   
      <div class="">
          <!-- HeaderComponent -->
          <div 
            x-data="headerComponent()" 
            class="mb-6">
            <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Hotel Management System</h1>
                <p class="mt-1 text-gray-600 dark:text-gray-400">Manage your hotels, event halls, and rooms efficiently</p>
                <div class="inline-flex items-center px-3 py-1 mt-4 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                    <i data-lucide="building" class="w-4 h-4 mr-1"></i>
                    <span x-text="totalHotels + ' Hotels'"></span>
                </div>
            </div>
          </div>

          <!-- ActionBarComponent -->
          <div 
              x-data="actionBarComponent()" 
              class="mb-6"
          >
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
                              placeholder="Search hotels..."
                          >
                      </div>
                      
                      <!-- Action Buttons -->
                      <div class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center md:space-y-0 md:space-x-3">
                          <!-- AddButton -->
                          <a
                            href="{{ route('admin.hotels.create') }}"
                              
                            {{-- type="button"  --}}
                            class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300"
                          >
                              <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                              Créer un hôtel
                          </a>
                          
                          <!-- BulkActionsDropdown -->
                          <button 
                              id="bulkActionsDropdownButton" 
                              data-dropdown-toggle="bulkActionsDropdown" 
                              class="flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                              :class="{ 'opacity-50 cursor-not-allowed': !hasSelection }"
                              :disabled="!hasSelection"
                          >
                              <i data-lucide="more-horizontal" class="w-4 h-4 mr-2"></i>
                              Bulk Actions
                              <i data-lucide="chevron-down" class="w-4 h-4 ml-2"></i>
                          </button>
                          
                          <!-- Dropdown menu -->
                          <div id="bulkActionsDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                              <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="bulkActionsDropdownButton">
                                  <li>
                                      <a @click="bulkDelete" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                          <i data-lucide="trash-2" class="w-4 h-4 mr-2 text-red-500"></i>
                                          Delete Selected
                                      </a>
                                  </li>
                                  <li>
                                      <a @click="exportPDF" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                          <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                          Export as PDF
                                      </a>
                                  </li>
                                  <li>
                                      <a @click="exportCSV" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                          <i data-lucide="file-spreadsheet" class="w-4 h-4 mr-2"></i>
                                          Export as CSV
                                      </a>
                                  </li>
                                  <li>
                                      <a @click="exportText" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                          <i data-lucide="file" class="w-4 h-4 mr-2"></i>
                                          Export as Text
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- HotelTableComponent -->
          <div 
              x-data="hotelTableComponent()" 
              class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg"
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
                              <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('name')">
                                  <div class="flex items-center">
                                      Hotel
                                      <template x-if="sortField === 'name' && sortDirection === 'asc'">
                                          <i data-lucide="chevron-up" class="w-4 h-4 ml-1"></i>
                                      </template>
                                      <template x-if="sortField === 'name' && sortDirection === 'desc'">
                                          <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                                      </template>
                                  </div>
                              </th>
                              <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('phone')">
                                  <div class="flex items-center">
                                      Phone
                                      <template x-if="sortField === 'phone' && sortDirection === 'asc'">
                                          <i data-lucide="chevron-up" class="w-4 h-4 ml-1"></i>
                                      </template>
                                      <template x-if="sortField === 'phone' && sortDirection === 'desc'">
                                          <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                                      </template>
                                  </div>
                              </th>
                              <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('email')">
                                  <div class="flex items-center">
                                      Email
                                      <template x-if="sortField === 'email' && sortDirection === 'asc'">
                                          <i data-lucide="chevron-up" class="w-4 h-4 ml-1"></i>
                                      </template>
                                      <template x-if="sortField === 'email' && sortDirection === 'desc'">
                                          <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                                      </template>
                                  </div>
                              </th>
                              <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('location')">
                                  <div class="flex items-center">
                                      Location
                                      <template x-if="sortField === 'location' && sortDirection === 'asc'">
                                          <i data-lucide="chevron-up" class="w-4 h-4 ml-1"></i>
                                      </template>
                                      <template x-if="sortField === 'location' && sortDirection === 'desc'">
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
                          <template x-for="(hotel, index) in filteredHotels" :key="hotel.id">
                              <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                  <td class="w-4 px-4 py-3">
                                      <div class="flex items-center">
                                          <input 
                                              :id="'checkbox-table-' + hotel.id" 
                                              type="checkbox" 
                                              x-model="selectedHotels"
                                              :value="hotel.id"
                                              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                          >
                                          <label :for="'checkbox-table-' + hotel.id" class="sr-only">checkbox</label>
                                      </div>
                                  </td>
                                  <th scope="row" class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                      <div class="flex items-center justify-center w-10 h-10 mr-3 bg-blue-100 rounded-full">
                                          <span class="font-bold text-blue-600" x-text="getInitials(hotel.name)"></span>
                                      </div>
                                      <div>
                                          <span x-text="hotel.name"></span>
                                          <div class="flex mt-1">
                                              <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 flex items-center">
                                                  <i data-lucide="home" class="w-3 h-3 mr-1"></i>
                                                  <span x-text="hotel.eventHalls + ' Event Halls'"></span>
                                              </span>
                                          </div>
                                      </div>
                                  </th>
                                  <td class="px-4 py-2">
                                      <div class="flex items-center">
                                          <i data-lucide="phone" class="w-4 h-4 mr-1 text-gray-400"></i>
                                          <span x-text="hotel.phone"></span>
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
                                          <span x-text="hotel.location"></span>
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
                                                  <a href="#" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                      <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                                      View details
                                                  </a>
                                              </li>
                                              <li>
                                                  <a href="#" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                      <i data-lucide="trash-2" class="w-4 h-4 mr-2 text-red-500"></i>
                                                      Delete
                                                  </a>
                                              </li>
                                              <li>
                                                  <a href="#" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                      <i data-lucide="home" class="w-4 h-4 mr-2 text-green-500"></i>
                                                      Add event hall
                                                  </a>
                                              </li>
                                              <li>
                                                  <a href="" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                      <i data-lucide="bed" class="w-4 h-4 mr-2 text-blue-500"></i>
                                                      Add hotel room
                                                  </a>
                                              </li>
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
                      Showing
                      <span class="font-semibold text-gray-900 dark:text-white" x-text="paginationInfo.start + 1"></span>
                      -
                      <span class="font-semibold text-gray-900 dark:text-white" x-text="paginationInfo.end"></span>
                      of
                      <span class="font-semibold text-gray-900 dark:text-white" x-text="hotels.length"></span>
                  </span>
                  <ul class="inline-flex items-stretch -space-x-px">
                      <li>
                          <a 
                              @click="prevPage" 
                              :class="{ 'cursor-not-allowed opacity-50': currentPage === 1 }"
                              class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                          >
                              <span class="sr-only">Previous</span>
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
                              <span class="sr-only">Next</span>
                              <i data-lucide="chevron-right" class="w-5 h-5"></i>
                          </a>
                      </li>
                  </ul>
              </nav>
          </div>
      </div>
  
</x-admin.dashboard-panel>
 <!-- Alpine.js Component Logic -->
 <script>
   // HeaderComponent
   function headerComponent() {
       return {
           totalHotels: 12, // This would typically come from an API
       }
   }

   // ActionBarComponent
   function actionBarComponent() {
       return {
           searchQuery: '',
           hasSelection: false,
           
           // This would be connected to the hotel table component in a real app
           // For demo purposes, we're just showing the structure
           search() {
               // This would trigger a search in the table component
               console.log('Searching for:', this.searchQuery);
               // In a real app, you'd emit an event or use a shared state
               window.dispatchEvent(new CustomEvent('search-hotels', { 
                   detail: { query: this.searchQuery } 
               }));
           },
           
           openAddModal() {
               console.log('Opening add hotel modal');
               // This would open a modal to add a new hotel
           },
           
           bulkDelete() {
               console.log('Bulk delete selected hotels');
               // This would delete all selected hotels
           },
           
           exportPDF() {
               console.log('Export as PDF');
               // This would export the selected hotels as PDF
           },
           
           exportCSV() {
               console.log('Export as CSV');
               // This would export the selected hotels as CSV
           },
           
           exportText() {
               console.log('Export as Text');
               // This would export the selected hotels as Text
           },
           
           // Initialize component
           init() {
               // Listen for selection changes from the table component
               window.addEventListener('selection-change', (event) => {
                   this.hasSelection = event.detail.hasSelection;
               });
           }
       }
   }

   // HotelTableComponent
   function hotelTableComponent() {
       return {
           hotels: [
               { id: 1, name: 'Grand Hotel', phone: '+1 (555) 123-4567', email: 'info@grandhotel.com', location: 'New York, NY', eventHalls: 3 },
               { id: 2, name: 'Seaside Resort', phone: '+1 (555) 234-5678', email: 'contact@seasideresort.com', location: 'Miami, FL', eventHalls: 5 },
               { id: 3, name: 'Mountain Lodge', phone: '+1 (555) 345-6789', email: 'info@mountainlodge.com', location: 'Denver, CO', eventHalls: 2 },
               { id: 4, name: 'City Center Hotel', phone: '+1 (555) 456-7890', email: 'reservations@citycenter.com', location: 'Chicago, IL', eventHalls: 4 },
               { id: 5, name: 'Palm Beach Resort', phone: '+1 (555) 567-8901', email: 'info@palmbeach.com', location: 'Palm Beach, FL', eventHalls: 6 },
               { id: 6, name: 'Sunset Hotel', phone: '+1 (555) 678-9012', email: 'bookings@sunsethotel.com', location: 'San Francisco, CA', eventHalls: 3 },
               { id: 7, name: 'Royal Palace', phone: '+1 (555) 789-0123', email: 'info@royalpalace.com', location: 'Las Vegas, NV', eventHalls: 8 },
               { id: 8, name: 'Harbor View Inn', phone: '+1 (555) 890-1234', email: 'stay@harborview.com', location: 'Seattle, WA', eventHalls: 2 },
               { id: 9, name: 'Downtown Suites', phone: '+1 (555) 901-2345', email: 'info@downtownsuites.com', location: 'Boston, MA', eventHalls: 1 },
               { id: 10, name: 'Lakeside Resort', phone: '+1 (555) 012-3456', email: 'contact@lakesideresort.com', location: 'Austin, TX', eventHalls: 4 },
           ],
           filteredHotels: [],
           selectedHotels: [],
           selectAll: false,
           sortField: 'name',
           sortDirection: 'asc',
           currentPage: 1,
           itemsPerPage: 5,
           searchQuery: '',
           
           // Computed properties
           get hasSelection() {
               return this.selectedHotels.length > 0;
           },
           
           get totalPages() {
               return Math.ceil(this.hotels.length / this.itemsPerPage);
           },
           
           get paginationInfo() {
               const start = (this.currentPage - 1) * this.itemsPerPage;
               const end = Math.min(start + this.itemsPerPage, this.hotels.length);
               return { start, end };
           },
           
           // Methods
           getInitials(name) {
               return name.split(' ').map(word => word[0]).join('').toUpperCase();
           },
           
           toggleSelectAll() {
               if (this.selectAll) {
                   // Select all hotels on the current page
                   this.selectedHotels = this.filteredHotels.map(hotel => hotel.id);
               } else {
                   // Deselect all
                   this.selectedHotels = [];
               }
               this.notifySelectionChange();
           },
           
           sortBy(field) {
               if (this.sortField === field) {
                   // Toggle direction if already sorting by this field
                   this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
               } else {
                   // New field, default to ascending
                   this.sortField = field;
                   this.sortDirection = 'asc';
               }
               this.applyFiltersAndSort();
           },
           
           applyFiltersAndSort() {
               // First filter by search query if any
               let result = [...this.hotels];
               
               if (this.searchQuery) {
                   const query = this.searchQuery.toLowerCase();
                   result = result.filter(hotel => 
                       hotel.name.toLowerCase().includes(query) ||
                       hotel.email.toLowerCase().includes(query) ||
                       hotel.location.toLowerCase().includes(query) ||
                       hotel.phone.includes(query)
                   );
               }
               
               // Then sort
               result.sort((a, b) => {
                   const aValue = a[this.sortField];
                   const bValue = b[this.sortField];
                   
                   if (aValue < bValue) return this.sortDirection === 'asc' ? -1 : 1;
                   if (aValue > bValue) return this.sortDirection === 'asc' ? 1 : -1;
                   return 0;
               });
               
               // Apply pagination
               const start = (this.currentPage - 1) * this.itemsPerPage;
               const end = Math.min(start + this.itemsPerPage, result.length);
               this.filteredHotels = result.slice(start, end);
           },
           
           prevPage() {
               if (this.currentPage > 1) {
                   this.currentPage--;
                   this.applyFiltersAndSort();
               }
           },
           
           nextPage() {
               if (this.currentPage < this.totalPages) {
                   this.currentPage++;
                   this.applyFiltersAndSort();
               }
           },
           
           goToPage(page) {
               this.currentPage = page;
               this.applyFiltersAndSort();
           },
           
           notifySelectionChange() {
               // Notify other components about selection changes
               window.dispatchEvent(new CustomEvent('selection-change', { 
                   detail: { hasSelection: this.hasSelection } 
               }));
           },
           
           // Initialize component
           init() {
               // Apply initial filters and sort
               this.applyFiltersAndSort();
               
               // Listen for search events from the action bar
               window.addEventListener('search-hotels', (event) => {
                   this.searchQuery = event.detail.query;
                   this.currentPage = 1; // Reset to first page when searching
                   this.applyFiltersAndSort();
               });
               
               // Watch for selection changes
               this.$watch('selectedHotels', () => {
                   this.notifySelectionChange();
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
