@props(['eventHallsCount' => 0])

<div 
   x-data="{ eventHallsCount: {{ $eventHallsCount }} }" 
   class="mb-6"
   @event-halls-updated.window="eventHallsCount = $event.detail.count">
   <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
      <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Système de Gestion des Salles de Fête</h1>
      <p class="mt-1 text-gray-600 dark:text-gray-400">Gérez toutes vos salles de réception en un seul endroit</p>
      <div class="inline-flex items-center px-3 py-1 mt-4 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
         <i data-lucide="building" class="w-4 h-4 mr-1"></i>
         <span x-text="eventHallsCount + ' Salles de fête au total'"></span>
      </div>
   </div>
</div> 