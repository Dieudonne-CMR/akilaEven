@props(['filters' => [], 'hasSelection' => false])

<div 
   x-data="{ 
      searchQuery: '',
      currentFilter: 'all',
      currentTypeLogement: 'all',
      currentTypeLocation: 'all',
      hasSelection: false
   }" 
   x-init="
      window.addEventListener('selection-change', function(event) {
         hasSelection = event.detail.hasSelection;
      });
   "
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
               @input="$dispatch('search-locations', { query: searchQuery })"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
               placeholder="Rechercher des locations..."
            >
         </div>
         
         <!-- Filter Dropdowns -->
         <div class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center md:space-y-0 md:space-x-3">
            <!-- Type de Logement Filter -->
            <button 
               id="typeLogementFilterButton" 
               data-dropdown-toggle="typeLogementFilterDropdown" 
               class="flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200"
               type="button"
            >
               <i data-lucide="home" class="w-4 h-4 mr-2"></i>
               Type de Logement
               <i data-lucide="chevron-down" class="w-3 h-3 ml-2"></i>
            </button>
            
            <div id="typeLogementFilterDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
               <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="typeLogementFilterButton">
                  <li>
                     <a 
                        @click="currentTypeLogement = 'all'; $dispatch('filter-locations-logement', { type: 'all' })"
                        class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        :class="{'bg-gray-100 dark:bg-gray-600': currentTypeLogement === 'all'}"
                     >
                        <span>Tous</span>
                     </a>
                  </li>
                  @foreach(\App\Models\Location::TYPE_LOGEMENT as $type)
                  <li>
                     <a 
                        @click="currentTypeLogement = '{{ $type }}'; $dispatch('filter-locations-logement', { type: '{{ $type }}' })"
                        class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        :class="{'bg-gray-100 dark:bg-gray-600': currentTypeLogement === '{{ $type }}'}"
                     >
                        <span>{{ ucfirst($type) }}</span>
                     </a>
                  </li>
                  @endforeach
               </ul>
            </div>
            
            <!-- Type de Location Filter -->
            <button 
               id="typeLocationFilterButton" 
               data-dropdown-toggle="typeLocationFilterDropdown" 
               class="flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
               type="button"
            >
               <i data-lucide="home" class="w-4 h-4 mr-2"></i>
               Type de Location
               <i data-lucide="chevron-down" class="w-3 h-3 ml-2"></i>
            </button>
            
            <div id="typeLocationFilterDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
               <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="typeLocationFilterButton">
                  <li>
                     <a 
                        @click="currentTypeLocation = 'all'; $dispatch('filter-locations-type', { type: 'all' })"
                        class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        :class="{'bg-gray-100 dark:bg-gray-600': currentTypeLocation === 'all'}"
                     >
                        <span>Tous</span>
                     </a>
                  </li>
                  @foreach(\App\Models\Location::TYPE_LOCATION as $type)
                  <li>
                     <a 
                        @click="currentTypeLocation = '{{ $type }}'; $dispatch('filter-locations-type', { type: '{{ $type }}' })"
                        class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        :class="{'bg-gray-100 dark:bg-gray-600': currentTypeLocation === '{{ $type }}'}"
                     >
                        <span>{{ ucfirst($type) }}</span>
                     </a>
                  </li>
                  @endforeach
               </ul>
            </div>
            
            <!-- BulkActionsDropdown -->
            <button 
               id="bulkActionsDropdownButton" 
               data-dropdown-toggle="bulkActionsDropdown" 
               class="flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200"
               :class="{ 'opacity-50 cursor-not-allowed': !hasSelection }"
               :disabled="!hasSelection"
            >
               <i data-lucide="list-filter" class="w-4 h-4 mr-2"></i>
               Actions
               <i data-lucide="chevron-down" class="w-3 h-3 ml-2"></i>
            </button>
            
            <div id="bulkActionsDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
               <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="bulkActionsDropdownButton">
                  <li>
                     <a 
                        @click="$dispatch('bulk-delete-locations')"
                        class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer text-red-500 hover:text-red-700"
                     >
                        <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                        Supprimer
                     </a>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div> 