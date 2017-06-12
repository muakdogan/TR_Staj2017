<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Birim extends Model
{
    //
     protected $table = 'birimler';
     
     public function ilan_mallar()
    {
        return $this->hasMany('App\IlanMal', 'birim_id', 'id');
    }
     public function ilan_hizmetler()
    {
        return $this->hasMany('App\IlanHizmet', 'birim_id', 'id');
    }
     public function ilan_yapim_islari()
    {
        return $this->hasMany('App\IlanYapimIsi', 'birim_id', 'id');
    }
     public function ilan_hizmetler_fiyat()
    {
        return $this->hasMany('App\IlanHizmet', 'fiyat_standardi_birim_id', 'id');
    }
     public function ilan_hizmetler_miktar()
    {
        return $this->hasMany('App\IlanHizmet', 'miktar_birim_id', 'id');
    }
     public function ilan_goturu_bedeller_miktar()
    {
        return $this->hasMany('App\IlanGoturuBedel', 'miktar_birim_id', 'id');
    }
    
}
