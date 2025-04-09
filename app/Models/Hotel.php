<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_hotel', 
        'description_hotel', 
        'logo', 
        'ville', 
        'localisation', 
        'bannier1', 
        'bannier2', 
        'bannier3', 
        'date_at', 
        'mat_user',
        'telephone',
        'email'
    ];

     // Relation avec l'utilisateur
     public function user()
     {
         return $this->belongsTo(User::class, 'mat_user');
     }

        // Générer le matricule de l'hôtel
    protected static function boot()
     {
         parent::boot();
     
         static::creating(function ($hotel) {
             $hotel->matricule_hotel = 'HOTEL-' . Str::upper(Str::random(6)) . now()->format('ymd');
             
             // Vérifier l'unicité
             while (Hotel::where('matricule_hotel', $hotel->matricule_hotel)->exists()) {
                 $hotel->matricule_hotel = 'HOTEL-' . Str::upper(Str::random(6)) . now()->format('ymd');
             }
         });
     }

     public function rooms()
     {
         return $this->hasMany(Room::class);
     }
     
     public function eventHalls()
     {
         return $this->hasMany(EventHall::class);
     }

}

