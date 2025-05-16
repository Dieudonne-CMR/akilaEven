<?php

namespace App\Mail;

use App\Models\Bookings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
class LocationBookingCreateEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * La réservation liée à l'email.
     *
     * @var \App\Models\Bookings
     */
    public Bookings $booking;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Bookings $booking
     * @return void
     */
    public function __construct(Bookings $booking)
    {
        $this->booking = $booking;
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: "Votre demande de réservation pour {$this->booking->location->nom_location} a bien été reçue",
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
            view: "emails.LocationBookingCreate",
            with: [
                // Ici, le nom de variable que vous utiliserez dans la Blade
                
                'booking' => $this->booking,
            ],
        );
    }
} 