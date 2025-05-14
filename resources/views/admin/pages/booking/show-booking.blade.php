@extends('admin.layouts.layout-admin')
@section('content-admin')

<x-layout.dashboard-panel class="">
    <!-- En-tête -->
    <header class="mb-8">
        <a href="{{ route('admin.bookings') }}" class="inline-flex items-center mb-6 text-gray-600 transition-colors hover:text-blue-600 group">
            <i data-lucide="arrow-left" class="w-5 h-5 mr-2 transition-transform group-hover:-translate-x-1"></i>
            Retour aux Réservations
        </a>
        <h1 class="text-3xl font-bold text-gray-900">
            Détails Réservation - {{ $booking->eventHall->nom_salle ?? 'Salle non spécifiée' }}
        </h1>
    </header>
    
    <!-- Contenu Principal -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <!-- Section Détails de Réservation -->
        <div class="lg:col-span-1">
            <x-admin-booking-show.info-card :booking="$booking" />
        </div>
        
        <!-- Section Détails de la Salle -->
        <div class="lg:col-span-2">
            <x-admin-booking-show.event-hall-details :eventHall="$booking->eventHall" />
        </div>
    </div>

    <!-- Initialiser Lucide Icons -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>

    <!-- Script pour l'impression -->
    <script>
        function printReservation() {
            window.print();
        }
    </script>
</x-layout.dashboard-panel>
@endsection