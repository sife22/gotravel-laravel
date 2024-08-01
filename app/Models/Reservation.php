<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function voyage(){
        return $this->belongsTo(Voyage::class);
    }

    public function agence(){
        return $this->belongsTo(Agence::class);
    }

}
