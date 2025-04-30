<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class EventHall extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_salle',
        'description_salle',
        ' tion',
        'capacite',
        'prix',
        'photo', 
        'photo1', 
        'photo2', 
        'photo3', 
        'photo4',
        'ville_id',
        'user_id',
        'hotel_id',
        'views', // New field added
        "area",
        "event_type",
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

    protected $casts = [
        'capacite' => 'integer',
        'area'     => 'decimal:2',
        'prix'     => 'decimal:2',
    ];
    
}
/* 🧠 Modèle	Ajouter les champs à $fillable ✅
🧱 Base de données	Créer ou modifier une migration pour ajouter les colonnes
⚙️ Commande	php artisan migrate pour appliquer les changements */
