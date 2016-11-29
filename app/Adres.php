<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adres extends Model
{
    protected $table = 'adresler';
    
    public $timestamps = false;
    
    public function adres_turleri()
    {
        return $this->belongsTo('App\AdresTuru', 'tur_id', 'id');
    }
    public function iller()
    {
        return $this->belongsTo('App\Il', 'il_id', 'id');
    }
    public function ilceler()
    {
        return $this->belongsTo('App\Ilce', 'ilce_id', 'id');
    }
    public function semtler()
    {
        return $this->belongsTo('App\Semt', 'semt_id', 'id');
    }
    public function firmalar()
    {
        return $this->belongsTo('App\Firma', 'firma_id', 'id');
    }
}
