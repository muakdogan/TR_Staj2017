<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ilan extends Model
{
    //
    protected $table = 'ilanlar';
     //public $timestamps = false;
    
    public function odeme_turleri()
    {
        return $this->belongsTo('App\OdemeTuru', 'odeme_turu_id', 'id');
    }
    public function firmalar()
    {
        return $this->belongsTo('App\Firma', 'firma_id', 'id');
    }
      public function para_birimleri()
    {
        return $this->belongsTo('App\ParaBirimi', 'para_birimi_id', 'id');
    }
      public function maliyetler()
    {
        return $this->belongsTo('App\Maliyet', 'yaklasik_maliyet_id', 'id');
    }
      public function ilan_mallar()
    {
        return $this->hasMany('App\IlanMal', 'ilan_id', 'id');
    }
       public function ilan_hizmetler()
    {
        return $this->hasMany('App\IlanHizmet', 'ilan_id', 'id');
    }
       public function ilan_goturu_bedeller()
    {
        return $this->hasMany('App\IlanGoturuBedel', 'ilan_id', 'id');
    }
    
       public function belirli_istekliler()
    {
        return $this->hasMany('App\BelirliIstekli', 'ilan_id', 'id');
    }
       public function ilan_yapim_isleri()
    {
        return $this->hasMany('App\IlanYapimIsi', 'ilan_id', 'id');
    }
       public function iller()
    {
        return $this->belongsTo('App\Il', 'teslim_yeri_il_id', 'id');
    }
       public function ilceler()
    {
        return $this->belongsTo('App\Ilce', 'teslim_yeri_ilce_id', 'id');
    }
    public function teklifler()
    {
        return $this->hasMany('App\Teklif', 'ilan_id', 'id');
    }
    public function yorumlar()
    {
        return $this->hasMany('App\Yorum', 'ilan_id', 'id');
    }
    public function puanlamalar()
    {
        return $this->hasMany('App\Puanlama', 'ilan_id', 'id');
    }
}
