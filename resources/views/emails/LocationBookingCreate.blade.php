
@extends('emails.layout')
@section('content')

<div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
    <div style="margin-bottom: 30px; text-align: center;">
        <h1 style="margin-bottom: 15px; font-size: 24px; font-weight: bold; color: #2563eb;">Demande de réservation reçue</h1>
        <p style="color: #6b7280;">Cher(e) {{ $booking->full_name }},</p>
    </div>

    <div style="margin-bottom: 30px;">
        <div style="padding: 20px; margin-bottom: 20px; border: 1px solid #bfdbfe; border-radius: 8px; background-color: #eff6ff;">
            <p style="margin-bottom: 15px; color: #374151;">
                Nous vous confirmons la bonne réception de votre demande de réservation pour la location 
                <strong>{{ $booking->location->nom_location }}</strong>.
            </p>
            <p style="color: #374151;">
                Votre demande est actuellement <strong>en attente de validation</strong> par nos équipes. Nous vous informerons par email dès que celle-ci sera traitée, généralement sous 24 heures.
            </p>
        </div>

        <div style="padding: 20px; margin-bottom: 20px; border-radius: 8px; background-color: #f9fafb;">
            <h2 style="margin-bottom: 15px; font-size: 18px; font-weight: 600;">Récapitulatif de votre demande :</h2>
            <ul style="margin: 0; padding: 0; list-style-type: none;">
              
                <li style="margin-bottom: 8px;"><strong>Location :</strong> {{ $booking->location->nom_location }}</li>
                <li style="margin-bottom: 8px;"><strong>Type :</strong> {{ ucfirst($booking->location->type_location) }} - {{ ucfirst($booking->location->type_logement) }}</li>
                <li style="margin-bottom: 8px;"><strong>Agence :</strong> {{ $booking->location->agence->nom_agence }}</li>
                
                @if($booking->location->type_logement === 'meublé')
                    <li style="margin-bottom: 8px;"><strong>Date d'arrivée :</strong> {{ $booking->arrival_time->format('d/m/Y') }}</li>
                    <li style="margin-bottom: 8px;"><strong>Date de départ :</strong> {{ $booking->departure_time->format('d/m/Y') }}</li>
                    <li style="margin-bottom: 8px;"><strong>Nombre de jours :</strong> {{ $booking->arrival_time->diffInDays($booking->departure_time) + 1 }}</li>
                    <li style="margin-bottom: 8px;"><strong>Prix total estimé :</strong> {{ number_format($booking->total_price, 0, ',', ' ') }} FCFA</li>
                @else
                    <li style="margin-bottom: 8px;"><strong>Prix mensuel :</strong> {{ number_format($booking->location->prix, 0, ',', ' ') }} FCFA</li>                   
               
                    <li style="margin-bottom: 8px;"><strong>Montant initial :</strong> {{ number_format($booking->location->prix, 0, ',', ' ') }}FCFA</li>
                @endif
            </ul>
        </div>

        <div style="padding: 15px; margin-bottom: 20px; border-radius: 8px; background-color: #fefce8;">
            <h3 style="margin-bottom: 10px; font-size: 16px; font-weight: 600; color: #854d0e;">Prochaines étapes :</h3>
            <ul style="margin: 0; padding: 0 0 0 20px; color: #854d0e;">
                <li style="margin-bottom: 8px;">Vous recevrez un email de confirmation une fois votre demande validée.</li>
                <li style="margin-bottom: 8px;">Vous disposerez alors de 24 heures pour confirmer définitivement votre réservation.</li>
                <li style="margin-bottom: 8px;">En cas de rejet de votre demande, vous en serez également informé par email.</li>
            </ul>
        </div>
    </div>

    <div style="margin-bottom: 30px; text-align: center;">
        <p style="margin-bottom: 15px; color: #374151;">
            Des questions ? Besoin d'aide ? N'hésitez pas à nous contacter.
        </p>
        <a href="{{ route('site.contact') }}" 
           style="display: inline-block; padding: 12px 24px; font-weight: 600; color: #ffffff; text-decoration: none; background-color: #2563eb; border-radius: 6px;">
            Nous contacter
        </a>
    </div>

    <div style="margin-top: 30px; font-size: 14px; color: #6b7280;">
        <p>Pour toute question, n'hésitez pas à nous contacter :</p>
        <p>Email : contact@akilaimmo.com</p>
        <p>Téléphone : +237 6 XX XX XX XX</p>
    </div>
</div>
@endsection 