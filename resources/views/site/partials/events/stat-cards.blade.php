@php
    use App\Models\EventHall;
    use App\Models\Ville;
    use App\Models\Bookings;
    use Illuminate\Support\Facades\DB;
    
    // Nombre de salles disponibles
    $eventHallsCount = EventHall::count();
    
    // Nombre de villes avec des salles
    $villesCount = Ville::whereHas('eventHalls')->count();
    
    // Nombre de réservations
    $HallBookingCount = Bookings::where('type_booking', 'hall')->count();
    
    // Taux de réussite (réservations complétées / total des réservations)
    $completedHallBookings = Bookings::where('status', 'completed')->where('type_booking', 'hall')->count();
  /*   $successRate = $bookingsCount > 0 
        ? round(($completedBookings / $bookingsCount) * 5, 1) 
        : 0; */
@endphp

<div class="grid  gap-8 mt-6 text-muted-foreground grid-cols-[repeat(auto-fit,minmax(100px,1fr))]">
  <div class="p-6 bg-white shadow-md rounded-xl">
    <p class="text-3xl font-bold text-primary">{{ $eventHallsCount > 0 ? $eventHallsCount.'+' : '0' }}</p>
    <p class="">Salles disponibles</p>
  </div>
  <div class="p-6 bg-white shadow-md rounded-xl">
    <p class="text-3xl font-bold text-primary">{{ $villesCount > 0 ? $villesCount.'+' : '0' }}</p>
    <p class="">Villes au Cameroun</p>
  </div>
  <div class="p-6 bg-white shadow-md rounded-xl">
    <p class="text-3xl font-bold text-primary">{{ $HallBookingCount >= 1000 ? round($HallBookingCount/1000, 1).'K+' : ($HallBookingCount > 0 ? $HallBookingCount.'+' : '0') }}</p>
    <p class="">Réservations</p>
  </div>
  <div class="p-6 bg-white shadow-md rounded-xl">
    <p class="text-3xl font-bold text-primary">{{ $completedHallBookings >= 1000 ? round($completedHallBookings/1000, 1).'K+' : ($completedHallBookings > 0 ? $completedHallBookings.'+' : '0') }}</p>
    <p class="">Evènements réussis</p>
  </div>
</div>