<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'hotel_id',
        'nom_chambre',
        'description_chambre',
        'localisation',
        'capacite',
        'prix',
        'photo',
        'photo1',
        'photo2',
        'photo3'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
