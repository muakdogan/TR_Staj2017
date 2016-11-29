<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semt extends Model
{
    protected $table = 'semtler';
    
    public function ilceler()
    {
        return $this->belongsTo('App\ilceler', 'ilce_id', 'id');
    }
    public function adresler()
    {
        return $this->hasMany('App\adresler', 'semt_id', 'id');
    }
}
