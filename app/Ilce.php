<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ilce extends Model
{
    protected $table = 'ilceler';
    
    public function semtler()
    {
        return $this->hasMany('App\semtler', 'ilce_id', 'id');
    }
    public function iller()
    {
        return $this->belongsTo('App\iller', 'il_id', 'id');
    }
    public function adresler()
    {
        return $this->hasMany('App\adresler', 'ilce_id', 'id');
    }
     public function ilanlar()
    {
        return $this->hasMany('App\Ilan', 'teslim_yeri_ilce_id', 'id');
    }
}
