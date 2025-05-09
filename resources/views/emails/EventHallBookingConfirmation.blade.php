@extends('emails.layout')

@section('content')
<div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
    <div style="margin-bottom: 30px; text-align: center;">
        <h1 style="margin-bottom: 15px; font-size: 24px; font-weight: bold; color: #16a34a;">Réservation Confirmée</h1>
        <p style="color: #6b7280;">Cher(e) {{ $booking->full_name }},</p>
    </div>

    <div style="margin-bottom: 30px;">
        <p style="margin-bottom: 15px; color: #374151;">
            Nous vous remercions d'avoir confirmé votre réservation pour la salle 
            <strong>{{ $booking->eventHall->nom_salle }}</strong>. Votre réservation est maintenant définitivement enregistrée.
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
                <li style="margin-bottom: 8px;"><strong>Statut :</strong> {{ $booking->status }}</li>
            </ul>
        </div>

        <div style="padding: 15px; margin-bottom: 20px; border-radius: 8px; background-color: #fefce8;">
            <h3 style="margin-bottom: 10px; font-size: 16px; font-weight: 600; color: #854d0e;">Prochaines étapes :</h3>
            <ul style="margin: 0; padding: 0 0 0 20px; color: #854d0e;">
                <li style="margin-bottom: 8px;">Veuillez procéder au paiement dans les meilleurs délais pour finaliser votre réservation.</li>
                <li style="margin-bottom: 8px;">Un agent pourrait vous contacter pour des informations supplémentaires.</li>
            </ul>
        </div>
    </div>

    <div style="margin-top: 30px; font-size: 14px; color: #6b7280;">
        <p>Si vous avez des questions, n'hésitez pas à nous contacter :</p>
        <p>Email : contact@akilaimmo.com</p>
        <p>Téléphone : +237 6 XX XX XX XX</p>
    </div>
</div>
@endsection
