@php
use App\Models\Location;
use App\Models\Bookings;
use Illuminate\Support\Facades\DB;

// Récupérer les types de locations
$locationTypes = Location::TYPE_LOCATION;

// Statistiques
$totalLocations = Location::count();
$totalVilles = DB::table('locations')
    ->join('villes', 'locations.ville_id', '=', 'villes.id')
    ->select('villes.id')
    ->distinct()
    ->count();
$LocationBookingsCount = Bookings::where('type_booking', 'location')->count();

// Réservations réussies
$completedLocationBookings = Bookings::where('type_booking', 'location')->where('status', 'completed')->count();
@endphp
<div class="relative w-full overflow-hidden bg-center bg-no-repeat bg-cover h-[500px]" style="background-image: url('{{ asset('assets_site/images_site/site-events-listing-banner.jpeg') }}');">
    <div class="absolute inset-0 bg-gradient-to-r from-primary/80 to-primary/40"></div>
    <div class="container relative flex flex-col items-center justify-center h-full px-4 mx-auto text-center text-white">
        <h1 class="mb-4 text-3xl font-bold md:text-4xl lg:text-5xl">Trouvez la location idéale</h1>
        <p class="max-w-2xl mb-8 text-lg">Découvrez notre sélection de propriétés à louer - appartements, studios, villas et bien plus encore.</p>
        
        <!-- Types de locations -->
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            @foreach(array_slice($locationTypes, 0, 6) as $index => $type)
                <a href="{{ route('site.locations', ['type_location' => $type]) }}" class="px-4 py-2 text-sm font-medium transition-colors rounded-full bg-white/20 hover:bg-white hover:text-primary">
                    {{ ucfirst($type) }}
                </a>
            @endforeach
            
            @if(count($locationTypes) > 6)
                <span class="px-4 py-2 text-sm font-medium transition-colors rounded-full bg-white/10">
                    + {{ count($locationTypes) - 6 }} autres
                </span>
            @endif
        </div>
        
        <!-- Statistiques -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
            <div class="px-6 py-3 bg-white/10 backdrop-blur rounded-xl">
                <h3 class="text-2xl font-bold">{{ $totalLocations }}</h3>
                <p class="text-sm">Locations</p>
            </div>
            <div class="px-6 py-3 bg-white/10 backdrop-blur rounded-xl">
                <h3 class="text-2xl font-bold">{{ $totalVilles }}</h3>
                <p class="text-sm">Villes</p>
            </div>
            <div class="px-6 py-3 bg-white/10 backdrop-blur rounded-xl">
                <h3 class="text-2xl font-bold">{{ $LocationBookingsCount >= 1000 ? round($LocationBookingsCount/1000, 1).'K+' : ($LocationBookingsCount > 0 ? $LocationBookingsCount.'+' : '0') }}</h3>
                <p class="text-sm">Réservations</p>
            </div>
            <div class="px-6 py-3 bg-white/10 backdrop-blur rounded-xl">
                <h3 class="text-2xl font-bold">{{ $completedLocationBookings >= 1000 ? round($completedLocationBookings/1000, 1).'K+' : ($completedLocationBookings > 0 ? $completedLocationBookings.'+' : '0') }}</h3>
                <p class="text-sm">Réservations réussies</p>
            </div>
        </div>
    </div>
</div>
