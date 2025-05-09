@props(['bookingsCount' => 0])

<div 
   x-data="{ bookingsCount: {{ $bookingsCount }} }" 
   class="mb-6"
   @bookings-updated.window="bookingsCount = $event.detail.count">
   <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
      <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Système de Gestion des Réservations</h1>
      <p class="mt-1 text-gray-600 dark:text-gray-400">Gérez toutes vos réservations d'agence et de salles de fête en un seul endroit</p>
      <div class="inline-flex items-center px-3 py-1 mt-4 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
         <i data-lucide="calendar-check" class="w-4 h-4 mr-1"></i>
         <span x-text="bookingsCount + ' Réservations au total'"></span>
      </div>
   </div>
</div> 