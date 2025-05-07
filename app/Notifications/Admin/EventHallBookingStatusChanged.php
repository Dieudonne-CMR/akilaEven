<?php

namespace App\Notifications\Admin;

use App\Models\Bookings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventHallBookingStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    public Bookings $booking;
    public string $status;

    /**
     * Create a new notification instance.
     */
    public function __construct(Bookings $booking, string $status)
    {
        $this->booking = $booking;
        $this->status = $status;
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
    public function toMail(object $notifiable): MailMessage
    {
        $statusLabels = [
            'accepted' => 'acceptée',
            'completed' => 'complétée',
            'cancelled' => 'annulée'
        ];

        return (new MailMessage)
            ->subject("Réservation {$statusLabels[$this->status]} - {$this->booking->eventHall->nom_salle}")
            ->greeting("Bonjour {$notifiable->name},")
            ->line("La réservation #{$this->booking->id} a été {$statusLabels[$this->status]}.")
            ->line("Client: {$this->booking->full_name}")
            ->line("Email: {$this->booking->email}")
            ->line("Téléphone: {$this->booking->phone}")
            ->line("Date d'arrivée: {$this->booking->arrival_time->format('d/m/Y H:i')}")
            ->line("Date de départ: {$this->booking->departure_time->format('d/m/Y H:i')}")
            ->action('Voir les détails', url("/admin/bookings/{$this->booking->id}"))
            ->line('Merci de votre attention.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'booking_id' => $this->booking->id,
            'status' => $this->status,
            'client_name' => $this->booking->full_name,
            'event_hall' => $this->booking->eventHall->nom_salle,
            'arrival_time' => $this->booking->arrival_time,
            'departure_time' => $this->booking->departure_time,
        ];
    }
    public function databaseType(object $notifiable): string

    {

        return 'update-booking';

    }
} 