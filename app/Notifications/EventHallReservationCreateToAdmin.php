<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Notifications\Notification;

use App\Models\Bookings;
use App\Mail\EventHallBookingCreateEmailToAdmin;
use App\Models\EventHall;
use Illuminate\Support\Carbon;

class EventHallReservationCreateToAdmin extends Notification implements ShouldQueue
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
    public function toMail(object $notifiable)
    {
        /* return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!'); */
       /*  return (new MailMessage)
        ->view(

            'mail.invoice.paid', ['invoice' => "dd"]
    
        )
        ->subject('Création de réservation')
        ->to($notifiable->email)
        ->from('akilawebfactory2025@gmail.com', 'Akila Even'); */
       
        
        return (new EventHallBookingCreateEmailToAdmin($this->booking));
        
      
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        // Début de la sélection
        $eventHall = EventHall::find($this->booking->eventHall->id, ['nom_salle', 'description_salle']);
        // Fin de la sélection
        return [
            //
            'reservation_id' => $this->booking->id,
            'event_hall_id'  => $this->booking->eventHall->id,
            'message'        => "Une demande de réservation a été faite pour la salle de fête #{$eventHall->nom_salle}.",
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

        return 'create-booking';

    }

    /**

    * Get the initial value for the "read_at" column.

    */

    public function initialDatabaseReadAtValue(): ?Carbon

    {

        return null;

    }


    /*
    Si tu veux accéder aux notifications d'un utilisateur, tu peux faire ceci:
    $user = App\Models\User::find(1);   
    foreach ($user->notifications as $notification) {
        echo $notification->type;
    }
    */

    /*
    Si tu veux récupérer les notifications non lues
    $user = App\Models\User::find(1);  
    foreach ($user->unreadNotifications as $notification) {
        echo $notification->type;
    }
    */

    /*
    Si tu veux marquer des notifications comme lues:
    $user = App\Models\User::find(1); 
    foreach ($user->unreadNotifications as $notification) {
        $notification->markAsRead();
    }
        
    ou
        $user->unreadNotifications->markAsRead();

    */
}
