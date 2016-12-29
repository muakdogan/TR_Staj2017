<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yorum extends Model
{
    //
    protected $table = 'yorumlar';
    
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
}
