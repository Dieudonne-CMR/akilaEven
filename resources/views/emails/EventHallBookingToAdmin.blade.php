@extends('emails.layout', ['title' => 'Nouvelle demande de réservation'])

@section('content')
    <h1>Nouvelle demande de réservation</h1>
    
    <p>Bonjour,</p>
    
    <p>Une nouvelle demande de réservation vient d'être effectuée pour une salle de fête. Voici les détails :</p>
    
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
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed; font-weight: bold;">Client :</td>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed;">{{ $booking->full_name }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed; font-weight: bold;">Email :</td>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed;">{{ $booking->email }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed; font-weight: bold;">Téléphone :</td>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed;">{{ $booking->phone }}</td>
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
        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed; font-weight: bold;">Status :</td>
            <td style="padding: 10px; border-bottom: 1px solid #e8eaed;">{{ $booking->status }}</td>
        </tr>
    </table>
    
    <p>Veuillez vous connecter à votre tableau de bord pour accepter ou refuser cette réservation.</p>
    
    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ route('dashboard') }}" class="button button-primary" style="color: white;">Accéder au tableau de bord</a>
    </div>
    
    <p style="margin-top: 30px;">Cordialement,<br>L'équipe de réservation</p>
@endsection
