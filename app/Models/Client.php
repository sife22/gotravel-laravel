<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class Client extends Model
{
    use HasFactory;
    use Notifiable;
    public $timestamps = false;

    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
}
