<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IlanHizmet extends Model
{
    //
     protected $table = 'ilan_hizmetler';
     public $timestamps=false;
     public function birimler()
    {
        return $this->belongsTo('App\Birim', 'birim_id', 'id');
    }
     public function fiyat_birimler()
    {
        return $this->belongsTo('App\Birim', 'fiyat_standardi_birim_id', 'id');
    }
       public function ilanlar()
    {
        return $this->belongsTo('App\Ilan', 'ilan_id', 'id');
    }
     public function miktar_birimler()
    {
        return $this->belongsTo('App\Birim', 'miktar_birim_id', 'id');
    }
    public function hizmet_teklifler()
    {
        return $this->hasMany('App\HizmetTeklif', 'ilan_hizmetler_id', 'id');
    }
}
