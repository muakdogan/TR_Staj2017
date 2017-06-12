<?php

namespace App;
use App\HizmetTeklif;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Firma;
use App\Teklif;
use App\KismiAcikKazanan;
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
    public function getHizmetTeklif($ilan_hizmet_id,$teklif_id){
        $hizmetTeklif = HizmetTeklif::where('ilan_hizmet_id',$ilan_hizmet_id)->where('teklif_id',$teklif_id)->orderBy('id','DESC')->limit(1)->get();
        return $hizmetTeklif;
    }
    public function hizmetIdTeklifler($ilan_id){
        $hizmetIdTeklifler= DB::select(DB::raw("SELECT * 
                        FROM hizmet_teklifler ht , teklifler t
                        WHERE ilan_hizmet_id ='$this->id'
                        AND ht.teklif_id = t.id 
                        AND t.ilan_id = '$ilan_id'
                        AND ht.id
                        IN (

                        SELECT MAX( id ) 
                        FROM hizmet_teklifler
                        GROUP BY teklif_id, ilan_hizmet_id
                        )
                        ORDER BY kdv_dahil_fiyat ASC  "));
        return $hizmetIdTeklifler;
    }
    public function getFirmaId($teklif_id){
         $firmaHizmetId = Teklif::find($teklif_id);
         $firmaHizmet = Firma::find($firmaHizmetId->firma_id);
         return $firmaHizmet->id;
    }
    public function getFirmaAdi($teklif_id){
         $firmaHizmetId = Teklif::find($teklif_id);
         $firmaHizmet = Firma::find($firmaHizmetId->firma_id);
         return $firmaHizmet->adi;
    }
    public function kisKazanCount(){
        $kazanan = KismiAcikKazanan::where("ilan_id",$this->ilanlar->id)->where("kalem_id",$this->id)->first();
        if(count($kazanan) != 0){
            $kisKazanCount=1;
        }
        else{
            $kisKazanCount=0;
        }
        return $kisKazanCount;
    } 
    public function kisKazananFirmaId(){
        $kazanan = KismiAcikKazanan::where("ilan_id",$this->ilanlar->id)->where("kalem_id",$this->id)->first();
        
        return $kazanan->kazanan_firma_id;
    }
}
