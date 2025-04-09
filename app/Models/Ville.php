<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ville extends Model
{
    use HasFactory;
    protected $fillable = ['nom'];

    public function eventHalls(){
        return $this->hasMany(EventHall::class);
    }
}
