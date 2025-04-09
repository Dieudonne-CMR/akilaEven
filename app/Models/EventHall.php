<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventHall extends Model
{
    protected $fillable = [
        'nom_salle',
        'description_salle',
        'localisation',
        'capacite',
        'prix',
        'photo', 
        'photo1', 
        'photo2', 
        'photo3', 
        'photo4',
        'ville_id',
        'user_id',
        'hotel_id'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function ville(){
        return $this->belongsTo(Ville::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
