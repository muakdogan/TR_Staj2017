<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puanlama extends Model
{
    //
    protected $table = 'puanlamalar';
    
    public $timestamps = false;
    
    public function firmalar()
    {
        return $this->belongsTo('App\Firma', 'firma_id', 'id');
    }
    public function ilanlar()
    {
        return $this->belongsTo('App\Ilan', 'ilan_id', 'id');
    }
    public function kullanicilar()
    {
        return $this->belongsTo('App\Kullanici', 'yorum_yapan_kullanici_id', 'id');
    }
    public function yorum()
    {
        return $this->hasOne('App\Yorum', 'ilan_id', 'ilan_id');
    }
   
  
}
