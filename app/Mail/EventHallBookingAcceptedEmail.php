<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bookings;

class EventHallBookingAcceptedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public Bookings $booking;

    public function __construct(Bookings $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->subject('Votre réservation a été acceptée - Akila Immo')
                    ->view('emails.EventHallBookingAccepted')
                    ->with([
                        'booking' => $this->booking,
                        'confirmationUrl' => route('site.event-hall-confirm-booking', $this->booking->confirmation_token)
                    ]);
    }
} 