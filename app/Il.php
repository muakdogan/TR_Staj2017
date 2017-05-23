<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Il extends Model
{
    protected $table = 'iller';
    
    public function ilceler()
    {
        return $this->hasMany('App\Ilce', 'il_id', 'id');
    }
    public function adresler()
    {
        return $this->hasMany('App\Adres', 'id', 'il_id');
    }
     public function ilanlar()
    {
        return $this->hasMany('App\Ilan', 'teslim_yeri_il_id', 'id');
    }
    
}
