<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class Bookings extends Model
{
    /** @use HasFactory<\Database\Factories\BookingsFactory> */
    use HasFactory;
    protected $fillable = [
        'full_name',        
        'email',
        'phone',
        'address',
        'city',        
        'arrival_time',
        'departure_time',
        'status',
        'message',
        'expires_at',
        'total_price',
        'event_hall_id',
        'confirmation_token',
        'confirmed_at'
    ];

    protected $casts = [
        'arrival_time'   => 'datetime',
        'departure_time' => 'datetime',
        'expires_at'     => 'datetime',
        'confirmed_at'   => 'datetime',
    ];

    // Les statuts possibles
    public const STATUS = [
        'pending',
        'cancelled',
        'booked',
        'accepted',
        /* 'declined', */
        'completed',
        'refunded'
    ];

    /**
     * La salle d'événement réservée
     */
    public function eventHall()
    {
        return $this->belongsTo(EventHall::class);
    }

    /**
     * Vérifie si, après acceptation, le client a dépassé
     * le délai de 24 h pour confirmer.
     */
    public function isExpired(): bool
    {
        return $this->status === 'accepted'
            && $this->expires_at !== null
            && Carbon::now()->greaterThan($this->expires_at);
    }
}
