<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MalTeklif extends Model
{
    //
     protected $table = 'mal_teklifler';
    
    public $timestamps = false;
    
    public function ilan_mallar()
    {
        return $this->belongsTo('App\IlanMal', 'ilan_mal_id', 'id');
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
