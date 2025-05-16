<?php

namespace App\Mail;

use App\Models\Bookings;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LocationBookingCreateEmailToAdmin extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * La réservation liée à l'email.
     *
     * @var \App\Models\Bookings
     */
    public $booking;

    /**
     * L'administrateur qui recevra l'email.
     * 
     * @var \App\Models\User
     */
    protected $admin;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Bookings $booking
     * @param \App\Models\User $admin
     * @return void
     */
    public function __construct(Bookings $booking, User $admin)
    {
        $this->booking = $booking;
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $locationName = $this->booking->location->nom_location;
        $customerName = $this->booking->full_name;

        return $this->subject("Nouvelle demande de réservation : {$locationName} par {$customerName}")
                   ->view('emails.LocationBookingToAdmin')
                   ->with([
                       'booking' => $this->booking,
                       'admin' => $this->admin,
                   ]);
    }
} 