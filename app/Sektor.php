<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sektor extends Model
{
    protected $table = 'sektorler';
    
    public $timestamps = false;
    
    public function firmalar()
    {
        return $this->belongsToMany('App\Firma', 'firma_sektorler', 'sektor_id', 'firma_id');
    }
    public function iller()
    {
        return $this->belongsTo('App\iller', 'il_id', 'id');
    }
    public function ilceler()
    {
        return $this->belongsTo('App\ilceler', 'ilce_id', 'id');
    }
    public function semtler()
    {
        return $this->belongsTo('App\semtler', 'semt_id', 'id');
    }
    public function iletisim_bilgileri()
    {
        return $this->hasOne('App\iletisim_bilgileri', 'adres_id', 'id');
    }
}
