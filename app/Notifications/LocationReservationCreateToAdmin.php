<?php

namespace App\Notifications;

use App\Models\Bookings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LocationReservationCreateToAdmin extends Notification implements ShouldQueue
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
        $locationName = $this->booking->location->nom_location;
        $customerName = $this->booking->full_name;

        return (new MailMessage)
            ->subject("Nouvelle demande de réservation : {$locationName} par {$customerName}")
            ->view('emails.LocationBookingToAdmin', [
                'booking' => $this->booking,
                'admin' => $notifiable,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $locationName = $this->booking->location->nom_location;
        $customerName = $this->booking->full_name;

        return [
            'id' => $this->booking->id,
            'type' => 'location_reservation_created',
            'message' => "Nouvelle demande de réservation pour {$locationName} par {$customerName}",
            'location_id' => $this->booking->location_id,
            'location_name' => $locationName,
            'customer_name' => $customerName,
            'customer_email' => $this->booking->email,
            'customer_phone' => $this->booking->phone,
            'status' => $this->booking->status,
            'created_at' => $this->booking->created_at->toIso8601String(),
        ];
    }
} 