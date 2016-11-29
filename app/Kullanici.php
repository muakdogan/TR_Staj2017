<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kullanici extends Model
{
    //
    protected $table = 'kullanicilar';
    public $timestamps=false;
    
    public function users()
    {
        return $this->hasOne('App\User', 'kullanici_id', 'id');
    }
    
    public function firmalar()
    {
        return $this->belongsToMany('App\Firma','firma_kullanicilar', 'kullanici_id', 'firma_id');
    }
    
   
}
