<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Bookings;
use App\Mail\EventHallBookingCreateEmailToAdmin;
use App\Mail\EventHallBookingConfirmationEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use App\Models\EventHall;
class EventHallBookingConfirmation extends Notification implements ShouldQueue
{
    use Queueable;
    public Bookings $booking;
    /**
     * Create a new notification instance.
     */
    public function __construct($booking)
    {
        //
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $url = URL::temporarySignedRoute(
            'site.confirm-booking',
            now()->addHours(24),
            ['token' => $this->booking->confirmation_token]
        );

        return (new EventHallBookingConfirmationEmail($this->booking, $url));
                  
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $eventHall = EventHall::find($this->booking->eventHall->id, ['nom_salle', 'description_salle']);
        return [
            //
            'confirmed_at'   => $this->booking->confirmed_at,
            'reservation_id' => $this->booking->id,
            'event_hall_id'  => $this->booking->eventHall->id,
            'message'        => "La réservation pour la salle de fête #{$eventHall->nom_salle} a été confirmée.",
            'client_name'    => $this->booking->full_name,
            'client_email'   => $this->booking->email,
            'cancelled_at'   => now()->toDateTimeString(),
        ];
    }
    /**

    * Get the notification's database type.

    */

    public function databaseType(object $notifiable): string

    {

        return 'confirm-booking';

    }

    /**

    * Get the initial value for the "read_at" column.

    */

    public function initialDatabaseReadAtValue(): ?Carbon

    {

        return null;

    }

}
