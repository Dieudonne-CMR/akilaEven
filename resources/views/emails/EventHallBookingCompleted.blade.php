@extends('emails.layout')

@section('content')
<div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
    <div style="margin-bottom: 30px; text-align: center;">
        <h1 style="margin-bottom: 15px; font-size: 24px; font-weight: bold; color: #16a34a;">Paiement Confirmé !</h1>
        <p style="color: #6b7280;">Cher(e) {{ $booking->full_name }},</p>
    </div>

    <div style="margin-bottom: 30px;">
        <div style="padding: 20px; margin-bottom: 20px; border-radius: 8px; background-color: #f0fdf4; border: 1px solid #bbf7d0;">
            <p style="margin-bottom: 15px; color: #374151;">
                Nous avons le plaisir de vous confirmer que votre paiement pour la réservation de la salle 
                <strong>{{ $booking->eventHall->nom_salle }}</strong> a bien été reçu. Votre réservation est désormais confirmée et complète.
            </p>
            <div style="display: flex; align-items: center; justify-content: center; margin: 15px 0;">
                <img src="https://cdn-icons-png.flaticon.com/512/5610/5610944.png" alt="Succès" style="width: 64px; height: 64px;">
            </div>
        </div>

        <div style="padding: 20px; margin-bottom: 20px; border-radius: 8px; background-color: #f9fafb;">
            <h2 style="margin-bottom: 15px; font-size: 18px; font-weight: 600;">Récapitulatif de votre réservation :</h2>
            <ul style="margin: 0; padding: 0; list-style-type: none;">
                <li style="margin-bottom: 8px;"><strong>Numéro de réservation :</strong> #{{ $booking->id }}</li>
                <li style="margin-bottom: 8px;"><strong>Salle :</strong> {{ $booking->eventHall->nom_salle }}</li>
                <li style="margin-bottom: 8px;"><strong>Agence :</strong> {{ $booking->eventHall->agence->nom_agence }}</li>
                <li style="margin-bottom: 8px;"><strong>Adresse :</strong> {{ $booking->eventHall->localisation }}, {{ $booking->eventHall->ville->nom }}</li>
                <li style="margin-bottom: 8px;"><strong>Date d'arrivée :</strong> {{ $booking->arrival_time->format('d/m/Y H:i') }}</li>
                <li style="margin-bottom: 8px;"><strong>Date de départ :</strong> {{ $booking->departure_time->format('d/m/Y H:i') }}</li>
                <li style="margin-bottom: 8px;"><strong>Capacité :</strong> {{ $booking->eventHall->capacite }} personnes</li>
                <li style="margin-bottom: 8px;"><strong>Montant payé :</strong> {{ number_format($booking->total_price, 0, ',', ' ') }} FCFA</li>
            </ul>
        </div>

        <div style="padding: 20px; margin-bottom: 20px; text-align: center; background-color: #eff6ff; border-radius: 8px;">
            <h3 style="margin-bottom: 10px; font-size: 18px; font-weight: 600; color: #1e40af;">Merci de nous faire confiance !</h3>
            <p style="color: #1e40af;">
                Nous sommes heureux de vous compter parmi nos clients et ferons tout notre possible pour que votre événement soit une réussite.
            </p>
        </div>

        <div style="padding: 15px; border-radius: 8px; background-color: #f9fafb;">
            <h3 style="margin-bottom: 10px; font-size: 16px; font-weight: 600;">Informations pratiques :</h3>
            <ul style="margin: 0; padding: 0 0 0 20px; color: #4b5563;">
                <li style="margin-bottom: 8px;">Un responsable vous contactera quelques jours avant votre arrivée pour finaliser les détails.</li>
                <li style="margin-bottom: 8px;">N'hésitez pas à nous contacter si vous avez besoin de services supplémentaires.</li>
                <li style="margin-bottom: 8px;">Pensez à présenter une pièce d'identité à votre arrivée.</li>
            </ul>
        </div>
    </div>

    <div style="margin-top: 30px; font-size: 14px; color: #6b7280;">
        <p>Pour toute question, n'hésitez pas à nous contacter :</p>
        <p>Email : contact@akilaimmo.com</p>
        <p>Téléphone : +237 6 XX XX XX XX</p>
    </div>
</div>
@endsection 