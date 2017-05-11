<?php

namespace App;
use App\Firma;
use App\Puanlama;
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
    
    public function getFirmaLogo($yorum_yapan_firma_id)
    {
         $yorumYapanFirma = Firma::find($yorum_yapan_firma_id);
         return $yorumYapanFirma->logo;
        
    }
    public function getFirmaAdi($yorum_yapan_firma_id)
    {
         $yorumYapanFirma = Firma::find($yorum_yapan_firma_id);
         return $yorumYapanFirma->adi;
        
    }
    public function getPuan($ilan_id,$firma_id,$tur)
    {
        $puanlar =  Puanlama::where('firma_id','=',$firma_id)
             ->where('ilan_id','=',$ilan_id)
             ->select('kriter1 as urunKalite','kriter2 as teslimat','kriter3 as teknik','kriter4 as iletisim')->get();
        
        if($tur=='ürünKalite'){
            
          return   $puanlar[0]['urunKalite'];
                
        }
        else if($tur=='teslimat'){
          return   $puanlar[0]['teslimat'];
            
        }
        else if($tur=='teknik'){
          return   $puanlar[0]['teknik'];
            
        }
        else if($tur=='iletisim'){
           return   $puanlar[0]['iletisim'];
            
        }
    
    }
    
}
