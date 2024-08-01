<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function images(){
        return $this->hasMany(Image::class);
    }

    public function agence(){
        return $this->belongsTo(Agence::class);
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
}
