<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HizmetTeklif extends Model
{
    //
     protected $table = 'hizmet_teklifler';
    
    public $timestamps = false;
    
    public function ilan_hizmetler()
    {
        return $this->belongsTo('App\IlanHizmet', 'ilan_hizmet_id', 'id');
    }
    public function firma_kullanicilar()
    {
        return $this->belongsTo('App\FirmaKullanici', 'firma_kullanicilar_id', 'id');
    }
    public function para_birimleri()
    {
        return $this->belongsTo('App\ParaBirimi', 'para_birimleri_id', 'id');
    }
     public function teklifler()
    {
        return $this->belongsTo('App\Teklif', 'teklif_id', 'id');
    }
}
