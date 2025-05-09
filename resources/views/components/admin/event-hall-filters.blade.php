@props(['filters' => [], 'hasSelection' => false])

<div 
   x-data="{ 
      searchQuery: '',
      currentFilter: 'all',
      currentEventType: 'all',
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
               @input="$dispatch('search-event-halls', { query: searchQuery })"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
               placeholder="Rechercher des salles de fête..."
            >
         </div>
         
         <!-- Filter Dropdowns -->
         <div class="flex flex-col space-y-3 sm:flex-row sm:space-y-0 sm:space-x-3">
            <!-- Type d'événement Filter -->
            <div>
               <button 
                  id="eventTypeFilterButton" 
                  data-dropdown-toggle="eventTypeFilter" 
                  class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-2.5"
                  type="button"
               >
                  <i data-lucide="calendar" class="w-4 h-4 mr-2 text-gray-400"></i>
                  Type d'événement
                  <i data-lucide="chevron-down" class="w-4 h-4 ml-2"></i>
               </button>
               
               <div id="eventTypeFilter" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                  <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="eventTypeFilterButton">
                     <li>
                        <a 
                           @click="currentEventType = 'all'; $dispatch('filter-event-halls-type', { type: 'all' })"
                           class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                           :class="{'bg-gray-100 dark:bg-gray-600': currentEventType === 'all'}"
                        >
                           <span>Tous</span>
                        </a>
                     </li>
                     @foreach(\App\Helpers\EventTypeHelper::getEventTypes() as $type => $label)
                     <li>
                        <a 
                           @click="currentEventType = '{{ $type }}'; $dispatch('filter-event-halls-type', { type: '{{ $type }}' })"
                           class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                           :class="{'bg-gray-100 dark:bg-gray-600': currentEventType === '{{ $type }}'}"
                        >
                           <span>{{ $label }}</span>
                        </a>
                     </li>
                     @endforeach
                  </ul>
               </div>
            </div>
            
            <!-- BulkActionsDropdown -->
            <div x-show="hasSelection">
               <button 
                  id="bulkActionsButton" 
                  data-dropdown-toggle="bulkActionsDropdown" 
                  class="inline-flex items-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5"
                  type="button"
               >
                  <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                  Actions groupées
                  <i data-lucide="chevron-down" class="w-4 h-4 ml-2"></i>
               </button>
               
               <div id="bulkActionsDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                  <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="bulkActionsButton">
                     <li>
                        <a 
                           @click="$dispatch('bulk-delete-event-halls')"
                           class="flex items-center px-4 py-2 text-red-500 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        >
                           <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                           Supprimer sélection
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
            
            <!-- New Event Hall Button -->
            <a href="{{ route('admin.agences') }}" class="inline-flex items-center text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5">
               <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
               Nouvelle Salle
            </a>
         </div>
      </div>
   </div>
</div> 