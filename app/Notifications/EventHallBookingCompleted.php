<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Bookings;
use App\Mail\EventHallBookingCompletedEmail;
use Illuminate\Support\Carbon;

class EventHallBookingCompleted extends Notification implements ShouldQueue
{
    use Queueable;

    public Bookings $booking;

    public function __construct(Bookings $booking)
    {
        $this->booking = $booking;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable)
    {
        return (new EventHallBookingCompletedEmail($this->booking));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'reservation_id' => $this->booking->id,
            'event_hall_id' => $this->booking->event_hall_id,
            'message' => "La réservation #{$this->booking->id} a été complétée (paiement reçu).",
            'client_name' => $this->booking->full_name,
            'client_email' => $this->booking->email,
            'completed_at' => now()->toDateTimeString(),
        ];
    }

    public function databaseType(object $notifiable): string
    {
        return 'booking-completed';
    }
} 