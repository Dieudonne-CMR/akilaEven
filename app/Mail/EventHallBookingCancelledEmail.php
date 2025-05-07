<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bookings;

class EventHallBookingCancelledEmail extends Mailable
{
    use Queueable, SerializesModels;

    public Bookings $booking;

    public function __construct(Bookings $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->subject('Réservation annulée - Akila Even')
                    ->view('emails.EventHallBookingCancelled')
                    ->with([
                        'booking' => $this->booking
                    ]);
    }
} 