<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeklifHareket extends Model
{
    //
     protected $table = 'teklif_hareketler';
    
    public $timestamps = false;
    
    public function teklifler()
    {
        return $this->belongsTo('App\Teklif', 'teklif_id', 'id');
    }
    public function firma_kullanicilar()
    {
        return $this->belongsTo('App\FirmaKullanici', 'firma_kullanicilar_id', 'id');
    }
    public function para_birimleri()
    {
        return $this->belongsTo('App\ParaBirimi', 'para_birimleri_id', 'id');
    }
}
