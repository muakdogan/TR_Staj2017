<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoturuBedelTeklif extends Model
{
    protected $table = 'goturu_bedel_teklifler';
    
    public $timestamps = false;
    
    public function ilan_goturu_bedeller()
    {
        return $this->belongsTo('App\IlanGoturuBedel', 'ilan_goturu_bedeller_id', 'id');
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
