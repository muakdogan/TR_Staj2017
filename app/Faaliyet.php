<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faaliyet extends Model
{
    protected $table = 'faaliyetler';
    
    public $timestamps = false;
    
    public function firmalar()
    {
        return $this->belognsToMany('App\Firma', 'firma_faaliyetler', 'faaliyet_id', 'firma_id');
    }
}
