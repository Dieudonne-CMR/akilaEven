@extends('emails.layout', ['title' => 'Nouvelle demande de réservation'])

@section('content')
<div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
    <div style="margin-bottom: 30px; text-align: center;">
        <h1 style="margin-bottom: 15px; font-size: 24px; font-weight: bold; color: #2563eb;">Nouvelle demande de réservation</h1>
        <p style="color: #6b7280;">Une nouvelle demande de réservation vient d'être effectuée pour une salle de fête.</p>
    </div>
    
    <div style="margin-bottom: 30px;">
        <div style="overflow: hidden; border: 1px solid #e5e7eb; border-radius: 8px;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background-color: #f9fafb;">
                    <tr>
                        <th style="padding: 12px 15px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase; border-bottom: 1px solid #e5e7eb;">Détail</th>
                        <th style="padding: 12px 15px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase; border-bottom: 1px solid #e5e7eb;">Information</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 12px 15px; font-weight: 500; color: #111827; border-bottom: 1px solid #e5e7eb;">Salle</td>
                        <td style="padding: 12px 15px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">{{ $booking->eventHall->nom_salle }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 15px; font-weight: 500; color: #111827; border-bottom: 1px solid #e5e7eb;">Agence</td>
                        <td style="padding: 12px 15px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">{{ $booking->eventHall->agence->nom_agence }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 15px; font-weight: 500; color: #111827; border-bottom: 1px solid #e5e7eb;">Client</td>
                        <td style="padding: 12px 15px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">{{ $booking->full_name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 15px; font-weight: 500; color: #111827; border-bottom: 1px solid #e5e7eb;">Email</td>
                        <td style="padding: 12px 15px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">{{ $booking->email }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 15px; font-weight: 500; color: #111827; border-bottom: 1px solid #e5e7eb;">Téléphone</td>
                        <td style="padding: 12px 15px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">{{ $booking->phone }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 15px; font-weight: 500; color: #111827; border-bottom: 1px solid #e5e7eb;">Date d'arrivée</td>
                        <td style="padding: 12px 15px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">{{ \Carbon\Carbon::parse($booking->arrival_time)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 15px; font-weight: 500; color: #111827; border-bottom: 1px solid #e5e7eb;">Date de départ</td>
                        <td style="padding: 12px 15px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">{{ \Carbon\Carbon::parse($booking->departure_time)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 15px; font-weight: 500; color: #111827; border-bottom: 1px solid #e5e7eb;">Prix total</td>
                        <td style="padding: 12px 15px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">{{ number_format($booking->total_price, 0, ',', ' ') }} FCFA</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 15px; font-weight: 500; color: #111827;">Statut</td>
                        <td style="padding: 12px 15px; color: #6b7280;">{{ \App\Helpers\BookingStatusHelper::getPaymentStatusMessage($booking->status) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div style="display: flex; justify-content: center; gap: 15px; margin-bottom: 30px;">
        <a href="{{ route('admin.bookings.show', $booking->id) }}" 
           style="display: inline-block; padding: 10px 20px; font-weight: 600; font-size: 13px; text-transform: uppercase; color: #ffffff; text-decoration: none; background-color: #2563eb; border-radius: 4px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
            Voir les détails
        </a>
        
        <a href="{{ route('admin.bookings.decline', $booking->id) }}" 
           style="display: inline-block; padding: 10px 20px; font-weight: 600; font-size: 13px; text-transform: uppercase; color: #ffffff; text-decoration: none; background-color: #dc2626; border-radius: 4px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
            Annuler la réservation
        </a>
    </div>
    
    <div style="padding: 15px; background-color: #fefce8; border-radius: 8px; color: #854d0e; margin-top: 25px;">
        <p>Veuillez traiter cette demande de réservation dans les plus brefs délais pour assurer une bonne expérience client.</p>
    </div>
    
    <div style="margin-top: 30px; font-size: 14px; color: #6b7280; text-align: center;">
        <p>Cet email a été envoyé automatiquement par le système de réservation de Akila Immo.</p>
        <p>© {{ date('Y') }} Akila Immo. Tous droits réservés.</p>
    </div>
</div>
@endsection
