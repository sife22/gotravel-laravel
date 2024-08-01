<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['url', 'voyage_id'];
    public function voyage(){
        return $this->belongsTo(Voyage::class);
    }
}
