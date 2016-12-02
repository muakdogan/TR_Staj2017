<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdresTuru extends Model
{
    protected $table = 'adres_turleri';
    
    public $timestamps = false;
    
    public function adresler()
    {
        return $this->hasMany('App\Adres', 'tur_id', 'id');
    }
}
