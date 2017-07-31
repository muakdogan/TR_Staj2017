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
    public function kullanicilar()
    {
        return $this->belongsTo('App\Kullanici', 'kullanici_id', 'id');
    }
    public function para_birimleri()
    {
        return $this->belongsTo('App\ParaBirimi', 'para_birimleri_id', 'id');
    }

    public function verilenFiyat(){
        $verilenFiyat = $this->orderBy('id','desc')->limit(1)->get();
        return number_format($verilenFiyat[0]['kdv_dahil_fiyat'],2,'.','');
    }

    public function paraFormat($para){
        return number_format($para,2,',','.');
    }

}
