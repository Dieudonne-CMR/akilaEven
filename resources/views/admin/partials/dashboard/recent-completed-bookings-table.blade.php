   @php
      // Récupérer les réservations complétées(5)
      $completedBookings = Bookings::where('status', 'completed')
            ->with('eventHall')
            ->latest()
            ->take(5)
            ->get();
        
   @endphp
   <!-- Section des réservations complétées -->
   <div class="p-4 bg-white rounded-lg shadow-sm">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-gray-800">Réservations récentes complétées</h2>
        <a href="{{ route('admin.bookings')}}" class="text-sm font-medium text-primary-600 hover:underline">Voir tout</a>
    </div>
    
    @if($completedBookings->isEmpty())
        <x-ui.empty-state 
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