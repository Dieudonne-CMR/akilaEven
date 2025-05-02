@extends('emails.layout', ['title' => 'Confirmation de votre réservation'])

@section('content')
    <h1>Confirmez votre réservation</h1>
    
    <p>Bonjour {{ $booking->full_name }},</p>
    
    <p>Votre demande de réservation pour la salle <strong>{{ $booking->eventHall->nom_salle }}</strong> a été acceptée par l'administrateur.</p>
    
    <p>Veuillez confirmer votre réservation en cliquant sur le bouton ci-dessous. Une fois confirmée, la salle sera réservée à votre nom.</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ url('/event-hall-confirm-booking/'.$booking->confirmation_token) }}" class="button button-success" style="color: white;">Confirmer ma réservation</a>
    </div>
    
    <p>Voici les détails de votre réservation :</p>
    
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed; font-weight: bold;">Salle :</td>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed;">{{ $booking->eventHall->nom_salle }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed; font-weight: bold;">Hôtel :</td>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed;">{{ $booking->eventHall->hotel->nom_hotel }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed; font-weight: bold;">Date d'arrivée :</td>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed;">{{ \Carbon\Carbon::parse($booking->arrival_time)->format('d/m/Y à H:i') }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed; font-weight: bold;">Date de départ :</td>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed;">{{ \Carbon\Carbon::parse($booking->departure_time)->format('d/m/Y à H:i') }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed; font-weight: bold;">Prix total :</td>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed;">{{ number_format($booking->total_price, 0, ',', ' ') }} FCFA</td>
        </tr>
    </table>
    
    <p><strong>Important :</strong> Vous avez 24 heures pour confirmer votre réservation. Passé ce délai, votre réservation sera automatiquement annulée.</p>
    
    <p style="margin-top: 30px;">Nous vous remercions pour votre confiance et nous réjouissons de vous accueillir prochainement.</p>
    
    <p>Cordialement,<br>L'équipe de réservation</p>
@endsection
