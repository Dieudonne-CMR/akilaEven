<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Bookings;
 
class EventHallBookingCreateEmailToAdmin extends Mailable 
{
    use Queueable, SerializesModels;
    public Bookings $booking;
    /**
     * Create a new message instance.
     */
    public function __construct(Bookings $booking)
    {
        //
        $this->booking = $booking;
    }
   
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: 'Création de réservation',
            // Soit un Address, soit un tableau d’Address
            to: [
                new Address('mbakopngako@gmail.com'),
            ],
        );
    }


    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.EventHallBookingToAdmin',
            with: [
                // Ici, le nom de variable que vous utiliserez dans la Blade
                'booking' => $this->booking,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

   /*  public function build()
    {
        return $this->view('emails.EventHallBookingToAdmin');
                    // Je peux récupérer uniquement les informations dont j'ai besoin et les envoyer directement

                     ->with(['reservation' => $this->reservation]); 
    } 
    */
}
