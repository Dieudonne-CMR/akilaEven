<?php

namespace App\Mail\Client;

use App\Models\Bookings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\URL;
class EventHallBookingStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public Bookings $booking;
    public string $status;
    public $template;
    public $confirmationUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Bookings $booking, string $status)
    {
        $this->booking = $booking;
        $this->status = $status;
         // Lien signé qui expire dans 24 heures
         $this->confirmationUrl = URL::temporarySignedRoute(
          'site.event-hall-confirm-booking',
          now()->addHours(24),
          ['token' => $booking->confirmation_token]
      );
        
        // Déterminer le template en fonction du statut
        $this->template = match($status) {
            'accepted' => 'emails.EventHallBookingAccepted',
            'completed' => 'emails.EventHallBookingCompleted',
            'cancelled' => 'emails.EventHallBookingCancelled',
            default => throw new \InvalidArgumentException('Statut invalide')
        };
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: "Mise à jour de votre réservation - {$this->booking->eventHall->nom_salle}",
            // Soit un Address, soit un tableau d’Address
            to: [
                new Address($this->booking->email),
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->template,
            with: [
                // Ici, le nom de variable que vous utiliserez dans la Blade
                'booking' => $this->booking,
                'urlConfirmation' => $this->confirmationUrl,
            ],
        );
    }
} 