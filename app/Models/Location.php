<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
  protected $fillable = [
      'agence_id',
      'nom_location',
      'description_location',
      'localisation',
      'area',
      'type_location',
      'type_logement',
      "equipments",
      "rules",
      'ville_id',
      'user_id',
      'prix',
      'photo',
      'photo1',
      'photo2',
      'photo3',
      'status'
  ];

  public function agence()
  {
    return $this->belongsTo(Agence::class);
  }
  public function ville(){
    return $this->belongsTo(Ville::class);
  }
  public function user(){
    return $this->belongsTo(User::class);
  }
  public function bookings(){
    return $this->hasMany(Bookings::class);
  }
  public const TYPE_LOCATION = [
    'appartement',
    'chambre moderne',
    'studio',
    'villa',
    'bureau',
    'maison'
  ];
  public const STATUS = [
    'available',
    'unavailable',
    
  ];
  public const TYPE_LOGEMENT = [
    'meublé',
    'habitation',    
  ];

  protected $casts = [
      
      'area'     => 'decimal:2',
      'prix'     => 'decimal:2',
      'equipments' => 'array',
      'rules' => 'string',     
  ];
}
