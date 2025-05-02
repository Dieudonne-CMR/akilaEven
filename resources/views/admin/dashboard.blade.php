@extends('admin.layouts.layout-admin')
@section('content-admin')

<x-admin.dashboard-panel class="">
  
    <!-- Contenu principal -->
    <div x-data="{ activeTab: 'hotels' }" class="">
      <!-- Section d'en-tête -->
      <div class="p-4 mb-6 bg-white rounded-lg shadow-sm">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between">
              <div>
                  <h1 class="text-2xl font-bold text-gray-800">Tableau de bord de réservation</h1>
                  <p class="mt-1 text-gray-600">Surveillez et gérez toutes vos réservations d'hôtels et de salles de fêtes en un seul endroit</p>
              </div>
              <div class="flex items-center mt-4 space-x-2 md:mt-0">
                  <button type="button" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center">
                      <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                      Nouvelle réservation
                  </button>
                  <div class="relative">
                      <button type="button" class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm p-2.5">
                          <i data-lucide="bell" class="w-5 h-5"></i>
                          <span class="sr-only">Notifications</span>
                          <div class="absolute inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full -top-1 -right-1">8</div>
                      </button>
                  </div>
              </div>
          </div>
      </div>

      <!-- Carrousel de statistiques -->
      <x-dashboard.stats-carousel :stats="$stats" />

      <!-- Section Onglets avec tables de données -->
      <div class="p-4 mb-6 bg-white rounded-lg shadow-sm">
          <div class="mb-4 border-b border-gray-200">
              <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
                  <li class="mr-2" role="presentation">
                      <button 
                          class="inline-block p-4 border-b-2 rounded-t-lg" 
                          :class="activeTab === 'hotels' ? 'text-primary-600 border-primary-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300'"
                          @click="activeTab = 'hotels'" 
                          type="button" 
                          role="tab"
                      >
                          <div class="flex items-center">
                              <i data-lucide="hotel" class="w-4 h-4 mr-2"></i>
                              Hôtels
                          </div>
                      </button>
                  </li>
                  <li class="mr-2" role="presentation">
                      <button 
                          class="inline-block p-4 border-b-2 rounded-t-lg" 
                          :class="activeTab === 'partyRooms' ? 'text-primary-600 border-primary-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300'"
                          @click="activeTab = 'partyRooms'" 
                          type="button" 
                          role="tab"
                      >
                          <div class="flex items-center">
                              <i data-lucide="party-popper" class="w-4 h-4 mr-2"></i>
                              Salles de fêtes
                          </div>
                      </button>
                  </li>
                  <li role="presentation">
                      <button 
                          class="inline-block p-4 border-b-2 rounded-t-lg" 
                          :class="activeTab === 'bookings' ? 'text-primary-600 border-primary-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300'"
                          @click="activeTab = 'bookings'" 
                          type="button" 
                          role="tab"
                      >
                          <div class="flex items-center">
                              <i data-lucide="calendar-check" class="w-4 h-4 mr-2"></i>
                              Réservations
                          </div>
                      </button>
                  </li>
              </ul>
          </div>
          
          <!-- Table des hôtels -->
          <x-dashboard.tab-content :active="true" x-show="activeTab === 'hotels'" 
              title="Liste des hôtels" 
              description="Gérez tous les hôtels partenaires de la plateforme">
              
              @if($hotels->isEmpty())
                  <x-dashboard.empty-state 
                      icon="building" 
                      title="Aucun hôtel disponible" 
                      message="Il n'y a pas encore d'hôtels enregistrés dans le système. Commencez par en ajouter un !" 
                  />
              @else
                  <table class="w-full text-sm text-left text-gray-500">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                          <tr>
                              <th scope="col" class="px-6 py-3">Hôtel</th>
                              <th scope="col" class="px-6 py-3">Localisation</th>
                              <th scope="col" class="px-6 py-3">Manager</th>
                              <th scope="col" class="px-6 py-3">Téléphone</th>
                              <th scope="col" class="px-6 py-3">Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($hotels as $hotel)
                              <tr class="bg-white border-b hover:bg-gray-50">
                                  <td class="flex items-center px-6 py-4">
                                      @if($hotel->logo)
                                          <img src="{{ asset('storage/' . $hotel->logo) }}" alt="{{ $hotel->nom_hotel }}" class="object-cover w-10 h-10 mr-3 rounded-full">
                                      @else
                                          <div class="flex items-center justify-center w-10 h-10 mr-3 rounded-full bg-primary-100">
                                              <span class="font-bold text-primary-600">{{ substr($hotel->nom_hotel, 0, 2) }}</span>
                                          </div>
                                      @endif
                                      <span class="font-bold text-gray-900">{{ $hotel->nom_hotel }}</span>
                                  </td>
                                  <td class="px-6 py-4">
                                      <div class="flex items-center">
                                          <i data-lucide="map-pin" class="w-4 h-4 mr-1 text-gray-400"></i>
                                          {{ $hotel->ville }}
                                      </div>
                                  </td>
                                  <td class="px-6 py-4">{{ $hotel->user ? $hotel->user->email : 'Non assigné' }}</td>
                                  <td class="px-6 py-4">{{ $hotel->telephone ?? 'Non disponible' }}</td>
                                  <td class="px-6 py-4">
                                      <div class="relative" x-data="{ open: false }">
                                          <button @click="open = !open" class="inline-flex items-center p-1 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50" type="button">
                                              <i data-lucide="more-vertical" class="w-5 h-5"></i>
                                          </button>
                                          <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                              <ul class="py-2 text-sm text-gray-700">
                                                  <li>
                                                      <a href="{{ route('admin.hotels.show', $hotel->id) }}" class="block px-4 py-2 hover:bg-gray-100">Voir les détails</a>
                                                  </li>
                                                  <li>
                                                      <form action="">
                                                      {{-- <form action="{{ route('admin.hotels.destroy', $hotel->id) }}" method="POST" class="block"> --}}
                                                          @csrf
                                                          @method('DELETE')
                                                          <button type="submit" class="w-full px-4 py-2 text-left text-red-600 hover:bg-gray-100" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet hôtel ?')">Supprimer</button>
                                                      </form>
                                                  </li>
                                              </ul>
                                          </div>
                                      </div>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              @endif
          </x-dashboard.tab-content>
          
          <!-- Table des salles de fêtes -->
          <x-dashboard.tab-content :active="false" x-show="activeTab === 'partyRooms'" 
              title="Liste des salles de fêtes" 
              description="Gérez toutes les salles de fêtes disponibles pour la réservation">
              
              @if($eventHalls->isEmpty())
                  <x-dashboard.empty-state 
                      icon="party-popper" 
                      title="Aucune salle de fêtes disponible" 
                      message="Il n'y a pas encore de salles de fêtes enregistrées dans le système." 
                  />
              @else
                  <table class="w-full text-sm text-left text-gray-500">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                          <tr>
                              <th scope="col" class="px-6 py-3">Salle</th>
                              <th scope="col" class="px-6 py-3">Localisation</th>
                              <th scope="col" class="px-6 py-3">Prix</th>
                              <th scope="col" class="px-6 py-3">Surface</th>
                              <th scope="col" class="px-6 py-3">Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($eventHalls as $eventHall)
                              <tr class="bg-white border-b hover:bg-gray-50">
                                  <td class="flex items-center px-6 py-4">
                                      @if($eventHall->photo)
                                          <img class="object-cover w-20 h-12 mr-3 rounded" src="{{ asset('storage/' . $eventHall->photo) }}" alt="{{ $eventHall->nom_salle }}">
                                      @else
                                          <div class="flex items-center justify-center w-20 h-12 mr-3 bg-gray-200 rounded">
                                              <i data-lucide="image" class="w-6 h-6 text-gray-400"></i>
                                          </div>
                                      @endif
                                      <span class="font-medium text-gray-900">{{ $eventHall->nom_salle }}</span>
                                  </td>
                                  <td class="px-6 py-4">
                                      <div class="flex items-center">
                                          <i data-lucide="map-pin" class="w-4 h-4 mr-1 text-gray-400"></i>
                                          {{ $eventHall->ville ? $eventHall->ville->nom : $eventHall->localisation }}
                                      </div>
                                  </td>
                                  <td class="px-6 py-4">{{ number_format($eventHall->prix, 0, ',', ' ') }} FCFA / jour</td>
                                  <td class="px-6 py-4">{{ $eventHall->area ?? 'N/A' }} m²</td>
                                  <td class="px-6 py-4">
                                      <div class="relative" x-data="{ open: false }">
                                          <button @click="open = !open" class="inline-flex items-center p-1 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50" type="button">
                                              <i data-lucide="more-vertical" class="w-5 h-5"></i>
                                          </button>
                                          <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                              <ul class="py-2 text-sm text-gray-700">
                                                  <li>
                                                      <a href="{{ route('admin.event-hall.show', $eventHall->id) }}" class="block px-4 py-2 hover:bg-gray-100">Voir les détails</a>
                                                  </li>
                                                  <li>
                                                      <form action="">
                                                     {{--  <form action="{{ route('admin.event-hall.destroy', $eventHall->id) }}" method="POST" class="block"> --}}
                                                          @csrf
                                                          @method('DELETE')
                                                          <button type="submit" class="w-full px-4 py-2 text-left text-red-600 hover:bg-gray-100" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette salle ?')">Supprimer</button>
                                                      </form>
                                                  </li>
                                              </ul>
                                          </div>
                                      </div>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              @endif
          </x-dashboard.tab-content>
          
          <!-- Table des réservations -->
          <x-dashboard.tab-content :active="false" x-show="activeTab === 'bookings'" 
              title="Liste des réservations" 
              description="Suivez et gérez toutes les réservations effectuées sur la plateforme">
              
              @if($bookings->isEmpty())
                  <x-dashboard.empty-state 
                      icon="calendar" 
                      title="Aucune réservation disponible" 
                      message="Il n'y a pas encore de réservations enregistrées dans le système." 
                  />
              @else
                  <table class="w-full text-sm text-left text-gray-500">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                          <tr>
                              <th scope="col" class="px-6 py-3">Client</th>
                              <th scope="col" class="px-6 py-3">Contact</th>
                              <th scope="col" class="px-6 py-3">Dates</th>
                              <th scope="col" class="px-6 py-3">Prix</th>
                              <th scope="col" class="px-6 py-3">Statut</th>
                              <th scope="col" class="px-6 py-3">Adresse</th>
                              <th scope="col" class="px-6 py-3">Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($bookings as $booking)
                              <tr class="bg-white border-b hover:bg-gray-50">
                                  <td class="px-6 py-4 font-medium text-gray-900">{{ $booking->full_name }}</td>
                                  <td class="px-6 py-4">
                                      <div class="flex flex-col">
                                          <div class="flex items-center">
                                              <i data-lucide="mail" class="w-4 h-4 mr-1 text-gray-400"></i>
                                              {{ $booking->email }}
                                          </div>
                                          <div class="flex items-center mt-1">
                                              <i data-lucide="phone" class="w-4 h-4 mr-1 text-gray-400"></i>
                                              {{ $booking->phone }}
                                          </div>
                                      </div>
                                  </td>
                                  <td class="px-6 py-4">
                                      <div class="flex flex-col">
                                          <div>Arrivée: {{ $booking->arrival_time ? $booking->arrival_time->format('d-m-Y') : 'N/A' }}</div>
                                          <div>Départ: {{ $booking->departure_time ? $booking->departure_time->format('d-m-Y') : 'N/A' }}</div>
                                      </div>
                                  </td>
                                  <td class="px-6 py-4">{{ number_format($booking->total_price, 0, ',', ' ') }} FCFA</td>
                                  <td class="px-6 py-4">
                                      {!! App\Helpers\BookingStatusHelper::getStatusBadge($booking->status) !!}
                                  </td>
                                  <td class="px-6 py-4">
                                      <div class="flex items-center">
                                          <i data-lucide="map-pin" class="w-4 h-4 mr-1 text-gray-400"></i>
                                          {{ $booking->address ?? 'N/A' }}
                                      </div>
                                  </td>
                                  <td class="px-6 py-4">
                                      <div class="relative" x-data="{ open: false }">
                                          <button @click="open = !open" class="inline-flex items-center p-1 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50" type="button">
                                              <i data-lucide="more-vertical" class="w-5 h-5"></i>
                                          </button>
                                          <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                              <ul class="py-2 text-sm text-gray-700">
                                                  <li>
                                                      <a href="{{ route('admin.booking.show', $booking->id) }}" class="block px-4 py-2 hover:bg-gray-100">Voir les détails</a>
                                                  </li>
                                                  <li>
                                                      <form action="" method="POST" class="block">
                                                     {{--  <form action="{{ route('admin.booking.destroy', $booking->id) }}" method="POST" class="block"> --}}
                                                          @csrf
                                                          @method('DELETE')
                                                          <button type="submit" class="w-full px-4 py-2 text-left text-red-600 hover:bg-gray-100" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">Supprimer</button>
                                                      </form>
                                                  </li>
                                              </ul>
                                          </div>
                                      </div>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              @endif
          </x-dashboard.tab-content>
      </div>

      <!-- Section des réservations récentes -->
      <div class="p-4 bg-white rounded-lg shadow-sm">
          <div class="flex items-center justify-between mb-4">
              <h2 class="text-lg font-semibold text-gray-800">Réservations récentes complétées</h2>
              <a href="{{ route('admin.bookings')}}" class="text-sm font-medium text-primary-600 hover:underline">Voir tout</a>
          </div>
          
          @if($completedBookings->isEmpty())
              <x-dashboard.empty-state 
                  icon="check-circle" 
                  title="Aucune réservation complétée" 
                  message="Il n'y a pas encore de réservations complétées dans le système." 
              />
          @else
              <div class="relative overflow-x-auto">
                  <table class="w-full text-sm text-left text-gray-500">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                          <tr>
                              <th scope="col" class="px-6 py-3">Client</th>
                              <th scope="col" class="px-6 py-3">Contact</th>
                              <th scope="col" class="px-6 py-3">Dates</th>
                              <th scope="col" class="px-6 py-3">Prix</th>
                              <th scope="col" class="px-6 py-3">Adresse</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($completedBookings as $booking)
                              <tr class="bg-white border-b hover:bg-gray-50">
                                  <td class="px-6 py-4 font-medium text-gray-900">{{ $booking->full_name }}</td>
                                  <td class="px-6 py-4">
                                      <div class="flex flex-col">
                                          <div class="flex items-center">
                                              <i data-lucide="mail" class="w-4 h-4 mr-1 text-gray-400"></i>
                                              {{ $booking->email }}
                                          </div>
                                      </div>
                                  </td>
                                  <td class="px-6 py-4">
                                      <div class="flex flex-col">
                                          <div>Arrivée: {{ $booking->arrival_time ? $booking->arrival_time->format('d-m-Y') : 'N/A' }}</div>
                                          <div>Départ: {{ $booking->departure_time ? $booking->departure_time->format('d-m-Y') : 'N/A' }}</div>
                                      </div>
                                  </td>
                                  <td class="px-6 py-4">{{ number_format($booking->total_price, 0, ',', ' ') }} FCFA</td>
                                  <td class="px-6 py-4">
                                      <div class="flex items-center">
                                          <i data-lucide="map-pin" class="w-4 h-4 mr-1 text-gray-400"></i>
                                          {{ $booking->address ?? 'N/A' }}
                                      </div>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          @endif
      </div>
  </div>
</x-admin.dashboard-panel>