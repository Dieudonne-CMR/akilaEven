@extends('emails.layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-green-600 mb-4">Réservation Acceptée !</h1>
        <p class="text-gray-600">Cher(e) {{ $booking->full_name }},</p>
    </div>

    <div class="mb-8">
        <p class="text-gray-700 mb-4">
            Nous sommes ravis de vous informer que votre demande de réservation pour la salle 
            <strong>{{ $booking->eventHall->nom_salle }}</strong> a été acceptée.
        </p>

        <div class="bg-gray-50 p-6 rounded-lg mb-6">
            <h2 class="text-xl font-semibold mb-4">Détails de votre réservation :</h2>
            <ul class="space-y-2">
                <li><strong>Date d'arrivée :</strong> {{ $booking->arrival_time->format('d/m/Y H:i') }}</li>
                <li><strong>Date de départ :</strong> {{ $booking->departure_time->format('d/m/Y H:i') }}</li>
                <li><strong>Prix total :</strong> {{ number_format($booking->total_price, 2) }} €</li>
            </ul>
        </div>

        <p class="text-gray-700 mb-6">
            Pour confirmer définitivement votre réservation, veuillez cliquer sur le bouton ci-dessous dans les 24 heures.
            Passé ce délai, votre réservation sera automatiquement annulée.
        </p>

        <div class="text-center">
            <a href="{{ $confirmationUrl }}" 
               class="inline-block bg-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300">
                Confirmer ma réservation
            </a>
        </div>
    </div>

    <div class="text-sm text-gray-500 mt-8">
        <p>Si vous avez des questions, n'hésitez pas à nous contacter :</p>
        <p>Email : contact@akilaeven.com</p>
        <p>Téléphone : +33 1 23 45 67 89</p>
    </div>
</div>
@endsection 