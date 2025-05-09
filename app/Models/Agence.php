<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Agence extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_agence', 
        'description_agence', 
        'logo', 
        'ville', 
        'localisation', 
        'bannier1', 
        'bannier2', 
        'bannier3', 
        'date_at', 
        'mat_user',
        'telephone',
        'email',
        'website',
        'services'
    ];

    protected $casts = [
        'services' => 'array',
    ];
    

     // Relation avec l'utilisateur
     public function user()
     {
         return $this->belongsTo(User::class, 'mat_user');
     }

        // Générer le matricule de l'agence
    protected static function boot()
     {
         parent::boot();
     
         static::creating(function ($agence) {
             $agence->matricule_agence = 'AGENCE-' . Str::upper(Str::random(6)) . now()->format('ymd');
             
             // Vérifier l'unicité
             while (Agence::where('matricule_agence', $agence->matricule_agence)->exists()) {
                 $agence->matricule_agence = 'AGENCE-' . Str::upper(Str::random(6)) . now()->format('ymd');
             }
         });
         static::deleting(function ($agence) {
            Log::info("Tentative de suppression de l'agence ID:{$agence->id}");
            
            // Aucun code de blocage ici pour éviter les problèmes
            return true;
        });
     }

    /*  public function locations()
     {
         return $this->hasMany(Location::class);
     } */
     public function locations()
     {
         return $this->hasMany(Location::class);
     }
     
     public function eventHalls()
     {
         return $this->hasMany(EventHall::class);
     }

}

