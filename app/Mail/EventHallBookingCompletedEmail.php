<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bookings;

class EventHallBookingCompletedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public Bookings $booking;

    public function __construct(Bookings $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->subject('Paiement reçu - Réservation confirmée - Akila Even')
                    ->view('emails.EventHallBookingCompleted')
                    ->with([
                        'booking' => $this->booking
                    ]);
    }
} 