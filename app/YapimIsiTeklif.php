<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YapimIsiTeklif extends Model
{
    //
     protected $table = 'yapim_isi_teklifler';
    
    public $timestamps = false;
    
    public function ilan_yapim_isleri()
    {
        return $this->belongsTo('App\IlanYapimIsi', 'ilan_yapim_isi_id', 'id');
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
