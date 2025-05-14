<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bookings;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\URL;
class EventHallBookingCreateEmail extends Mailable
{
    /* use Queueable, SerializesModels; */

    public Bookings $booking;

    /**
     * Create a new message instance.
     */
    public function __construct(Bookings $booking)
    {
        $this->booking = $booking;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: "Votre demande de réservation chez Akila Immo pour la salle{$this->booking->eventHall->nom_salle}",
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
            view: 'emails.EventHallBookingCreate',
            with: [
                // Ici, le nom de variable que vous utiliserez dans la Blade
                'booking' => $this->booking,
                
            ],
        );
    }
    
} 