@extends('emails.layout')

@section('content')
<div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
    <div style="margin-bottom: 30px; text-align: center;">
        <h1 style="margin-bottom: 15px; font-size: 24px; font-weight: bold; color: #16a34a;">Réservation Acceptée !</h1>
        <p style="color: #6b7280;">Cher(e) {{ $booking->full_name }},</p>
    </div>

    <div style="margin-bottom: 30px;">
        <p style="margin-bottom: 15px; color: #374151;">
            Nous sommes ravis de vous informer que votre demande de réservation pour la salle 
            <strong>{{ $booking->eventHall->nom_salle }}</strong> a été acceptée.
        </p>

        <div style="padding: 20px; margin-bottom: 20px; border-radius: 8px; background-color: #f9fafb;">
            <h2 style="margin-bottom: 15px; font-size: 18px; font-weight: 600;">Détails de votre réservation :</h2>
            <ul style="margin: 0; padding: 0; list-style-type: none;">
                <li style="margin-bottom: 8px;"><strong>Numéro de réservation :</strong> #{{ $booking->id }}</li>
                <li style="margin-bottom: 8px;"><strong>Salle :</strong> {{ $booking->eventHall->nom_salle }}</li>
                <li style="margin-bottom: 8px;"><strong>Agence :</strong> {{ $booking->eventHall->agence->nom_agence }}</li>
                <li style="margin-bottom: 8px;"><strong>Date d'arrivée :</strong> {{ $booking->arrival_time->format('d/m/Y H:i') }}</li>
                <li style="margin-bottom: 8px;"><strong>Date de départ :</strong> {{ $booking->departure_time->format('d/m/Y H:i') }}</li>
                <li style="margin-bottom: 8px;"><strong>Capacité :</strong> {{ $booking->eventHall->capacite }} personnes</li>
                <li style="margin-bottom: 8px;"><strong>Prix total :</strong> {{ number_format($booking->total_price, 0, ',', ' ') }} FCFA</li>
            </ul>
        </div>

        <p style="margin-bottom: 20px; color: #374151;">
            Pour confirmer définitivement votre réservation, veuillez cliquer sur le bouton ci-dessous dans les 24 heures.
            Passé ce délai, votre réservation sera automatiquement annulée.
        </p>

        <div style="margin-bottom: 20px; text-align: center;">
            <a href="{{ route('site.event-hall-confirm-booking', $booking->confirmation_token)}}" 
               style="display: inline-block; padding: 12px 24px; font-weight: 600; color: #ffffff; text-decoration: none; background-color: #16a34a; border-radius: 6px;">
                Confirmer ma réservation
            </a>
        </div>
        
        <div style="margin-top: 25px; padding: 15px; background-color: #f9fafb; border-radius: 8px;">
            <p style="margin-bottom: 15px; color: #374151;">
                Si vous souhaitez annuler cette réservation pour quelque raison que ce soit, vous pouvez le faire en cliquant sur le bouton ci-dessous :
            </p>
            <div style="text-align: center;">
                <a href="{{ route('site.event-hall-cancel-booking', $booking->confirmation_token) }}" 
                   style="display: inline-block; padding: 12px 24px; font-weight: 600; color: #ffffff; text-decoration: none; background-color: #dc2626; border-radius: 6px;">
                    Annuler votre réservation
                </a>
            </div>
        </div>
    </div>

    <div style="margin-top: 30px; font-size: 14px; color: #6b7280;">
        <p>Si vous avez des questions, n'hésitez pas à nous contacter :</p>
        <p>Email : contact@akilaimmo.com</p>
        <p>Téléphone : +237 6 XX XX XX XX</p>
    </div>
</div>
@endsection 