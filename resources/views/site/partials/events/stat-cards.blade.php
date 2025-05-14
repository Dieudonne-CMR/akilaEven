@php
    use App\Models\EventHall;
    use App\Models\Ville;
    use App\Models\Bookings;
    use Illuminate\Support\Facades\DB;
    
    // Nombre de salles disponibles
    $eventHallsCount = EventHall::count();
    
    // Nombre de villes
    $villesCount = Ville::count();
    
    // Nombre de réservations
    $bookingsCount = Bookings::count();
    
    // Taux de réussite (réservations complétées / total des réservations)
    $completedBookings = Bookings::where('status', 'completed')->count();
    $successRate = $bookingsCount > 0 
        ? round(($completedBookings / $bookingsCount) * 5, 1) 
        : 0;
@endphp

<div class="grid grid-cols-2 gap-4 mt-6 md:grid-cols-4 text-muted-foreground">
  <div class="p-6 bg-white shadow-md rounded-xl">
    <p class="text-3xl font-bold text-primary">{{ $eventHallsCount }}+</p>
    <p class="">Salles disponibles</p>
  </div>
  <div class="p-6 bg-white shadow-md rounded-xl">
    <p class="text-3xl font-bold text-primary">{{ $villesCount }}+</p>
    <p class="">Villes au Cameroun</p>
  </div>
  <div class="p-6 bg-white shadow-md rounded-xl">
    <p class="text-3xl font-bold text-primary">{{ $bookingsCount >= 1000 ? round($bookingsCount/1000, 1).'K+' : $bookingsCount.'+' }}</p>
    <p class="">Réservations</p>
  </div>
  <div class="p-6 bg-white shadow-md rounded-xl">
    <p class="text-3xl font-bold text-primary">{{ $successRate }}/5</p>
    <p class="">Evènements réussis</p>
  </div>
</div>