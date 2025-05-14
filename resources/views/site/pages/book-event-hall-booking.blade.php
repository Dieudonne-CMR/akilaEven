@extends('site.layouts.layout-site')

@section('content-site')
<div class="max-w-4xl px-4 py-12 mx-auto">
    <div class="p-6 bg-white rounded-lg shadow-md">
        @if(session('success'))
            <div class="p-4 mb-6 text-green-700 bg-green-100 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 mb-6 text-red-700 bg-red-100 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <div class="text-center">
            @if(session('success'))
                <svg class="w-16 h-16 mx-auto mb-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <h1 class="mb-4 text-2xl font-bold text-gray-900">Réservation confirmée</h1>
                <p class="mb-6 text-lg text-gray-600">Merci d'avoir confirmé votre réservation. Nous sommes impatients de vous accueillir !</p>
            @elseif(session('error'))
                <svg class="w-16 h-16 mx-auto mb-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <h1 class="mb-4 text-2xl font-bold text-gray-900">Problème de confirmation</h1>
                <p class="mb-6 text-lg text-gray-600">Il semble qu'il y ait eu un problème avec votre confirmation. Veuillez nous contacter directement.</p>
            @else
                <svg class="w-16 h-16 mx-auto mb-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h1 class="mb-4 text-2xl font-bold text-gray-900">État de la réservation</h1>
                <p class="mb-6 text-lg text-gray-600">Vérifiez l'état de votre réservation ci-dessous.</p>
            @endif
        </div>

        @if(isset($booking))
            <div class="p-4 mt-8 border border-gray-200 rounded-lg">
                <h2 class="mb-4 text-xl font-semibold text-gray-900">Détails de la réservation</h2>
                
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-500">Salle</p>
                        <p class="text-gray-900">{{ $booking->eventHall->nom_salle }}</p>
                    </div>
                    
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-500">Agence</p>
                        <p class="text-gray-900">{{ $booking->eventHall->agence->nom_agence }}</p>
                    </div>
                    
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-500">Client</p>
                        <p class="text-gray-900">{{ $booking->full_name }}</p>
                    </div>
                    
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-500">Email</p>
                        <p class="text-gray-900">{{ $booking->email }}</p>
                    </div>
                    
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-500">Téléphone</p>
                        <p class="text-gray-900">{{ $booking->phone }}</p>
                    </div>
                    
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-500">Statut</p>
                        <p class="inline-flex px-2 py-1 text-sm font-semibold rounded-full 
                            @if($booking->status == 'Pending') bg-yellow-100 text-yellow-800
                            @elseif($booking->status == 'Accepted') bg-blue-100 text-blue-800
                            @elseif($booking->status == 'Booked') bg-green-100 text-green-800
                            @elseif($booking->status == 'Completed') bg-purple-100 text-purple-800
                            @elseif($booking->status == 'Cancelled') bg-red-100 text-red-800
                            @elseif($booking->status == 'Declined') bg-gray-100 text-gray-800
                            @endif">
                            {{ $booking->status }}
                        </p>
                    </div>
                    
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-500">Date d'arrivée</p>
                        <p class="text-gray-900">{{ \Carbon\Carbon::parse($booking->arrival_time)->format('d/m/Y à H:i') }}</p>
                    </div>
                    
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-500">Date de départ</p>
                        <p class="text-gray-900">{{ \Carbon\Carbon::parse($booking->departure_time)->format('d/m/Y à H:i') }}</p>
                    </div>
                    
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-500">Prix total</p>
                        <p class="text-gray-900">{{ number_format($booking->total_price, 0, ',', ' ') }} FCFA</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-8 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 text-white transition-colors border border-transparent rounded-md bg-primary hover:bg-primary/80 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Retour à l'accueil
            </a>
        </div>
    </div>
</div>
@endsection
