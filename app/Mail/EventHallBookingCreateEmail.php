<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bookings;

class EventHallBookingCreateEmail extends Mailable
{
    use Queueable, SerializesModels;

    public Bookings $booking;

    /**
     * Create a new message instance.
     */
    public function __construct(Bookings $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Votre demande de réservation - Akila Immo')
                    ->view('emails.EventHallBookingCreate')
                    ->with([
                        'booking' => $this->booking
                    ]);
    }
} 