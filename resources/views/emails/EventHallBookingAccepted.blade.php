@extends('emails.layout')

@section('content')
<div class="max-w-2xl p-8 mx-auto bg-white rounded-lg shadow-lg">
    <div class="mb-8 text-center">
        <h1 class="mb-4 text-3xl font-bold text-green-600">Réservation Acceptée !</h1>
        <p class="text-gray-600">Cher(e) {{ $booking->full_name }},</p>
    </div>

    <div class="mb-8">
        <p class="mb-4 text-gray-700">
            Nous sommes ravis de vous informer que votre demande de réservation pour la salle 
            <strong>{{ $booking->eventHall->nom_salle }}</strong> a été acceptée.
        </p>

        <div class="p-6 mb-6 rounded-lg bg-gray-50">
            <h2 class="mb-4 text-xl font-semibold">Détails de votre réservation :</h2>
            <ul class="space-y-2">
                <li><strong>Date d'arrivée :</strong> {{ $booking->arrival_time->format('d/m/Y H:i') }}</li>
                <li><strong>Date de départ :</strong> {{ $booking->departure_time->format('d/m/Y H:i') }}</li>
                <li><strong>Prix total :</strong> {{ number_format($booking->total_price, 2) }} €</li>
            </ul>
        </div>

        <p class="mb-6 text-gray-700">
            Pour confirmer définitivement votre réservation, veuillez cliquer sur le bouton ci-dessous dans les 24 heures.
            Passé ce délai, votre réservation sera automatiquement annulée.
        </p>

        <div class="text-center">
          {{--   <a href="{{ $urlConfirmation }}"  --}}
            <a href="{{ route('site.event-hall-confirm-booking', $booking->confirmation_token)}}" 
               class="inline-block px-8 py-3 font-semibold text-white transition duration-300 bg-green-600 rounded-lg hover:bg-green-700">
                Confirmer ma réservation
            </a>
        </div>
    </div>

    <div class="mt-8 text-sm text-gray-500">
        <p>Si vous avez des questions, n'hésitez pas à nous contacter :</p>
        <p>Email : contact@akilaeven.com</p>
        <p>Téléphone : +33 1 23 45 67 89</p>
    </div>
</div>
@endsection 