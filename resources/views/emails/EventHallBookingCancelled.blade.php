@extends('emails.layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-red-600 mb-4">Réservation Annulée</h1>
        <p class="text-gray-600">Cher(e) {{ $booking->full_name }},</p>
    </div>

    <div class="mb-8">
        <p class="text-gray-700 mb-4">
            Nous vous informons que votre réservation pour la salle 
            <strong>{{ $booking->eventHall->nom_salle }}</strong> a été annulée.
        </p>

        <div class="bg-gray-50 p-6 rounded-lg mb-6">
            <h2 class="text-xl font-semibold mb-4">Détails de la réservation annulée :</h2>
            <ul class="space-y-2">
                <li><strong>Numéro de réservation :</strong> #{{ $booking->id }}</li>
                <li><strong>Date d'arrivée prévue :</strong> {{ $booking->arrival_time->format('d/m/Y H:i') }}</li>
                <li><strong>Date de départ prévue :</strong> {{ $booking->departure_time->format('d/m/Y H:i') }}</li>
            </ul>
        </div>

        <div class="bg-yellow-50 p-4 rounded-lg mb-6">
            <h3 class="text-lg font-semibold text-yellow-800 mb-2">Informations importantes :</h3>
            <ul class="text-yellow-700 space-y-2">
                <li>• Si vous avez effectué un paiement, le remboursement sera traité dans les plus brefs délais</li>
                <li>• Pour toute question concernant l'annulation, n'hésitez pas à nous contacter</li>
                <li>• Nous espérons vous accueillir prochainement pour une nouvelle réservation</li>
            </ul>
        </div>
    </div>

    <div class="text-center mb-8">
        <a href="{{ route('site.salleFete') }}" 
           class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
            Voir nos autres salles disponibles
        </a>
    </div>

    <div class="text-sm text-gray-500 mt-8">
        <p>Pour toute question, n'hésitez pas à nous contacter :</p>
        <p>Email : contact@akilaeven.com</p>
        <p>Téléphone : +33 1 23 45 67 89</p>
    </div>
</div>
@endsection 