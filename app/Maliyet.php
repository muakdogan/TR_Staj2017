<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maliyet extends Model
{
    //
     protected $table = 'maliyetler';
     public function ilanlar()
    {
        return $this->hasMany('App\Ilan', 'yaklasik_maliyet_id', 'id');
    }
}
