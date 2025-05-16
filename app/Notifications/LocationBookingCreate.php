<?php

namespace App\Notifications;

use App\Models\Bookings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LocationBookingCreate extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * La réservation liée à la notification.
     *
     * @var \App\Models\Bookings
     */
    protected $booking;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Bookings $booking
     * @return void
     */
    public function __construct(Bookings $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Votre demande de réservation a bien été reçue')
            
            ->view('emails.LocationBookingToAdmin', ['booking' => $this->booking]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->booking->id,
            'type' => 'location_booking_created',
            'message' => 'Votre demande de réservation pour ' . $this->booking->location->nom_location . ' a bien été reçue.',
            'location_id' => $this->booking->location_id,
            'location_name' => $this->booking->location->nom_location,
        ];
    }
} 