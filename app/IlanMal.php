<?php

namespace App;
use App\MalTeklif;
use Illuminate\Database\Eloquent\Model;
use DB;
Use App\Teklif;
use App\Firma;
use App\KismiAcikKazanan;
use Barryvdh\Debugbar\Facade as Debugbar;
class IlanMal extends Model
{
    //
    public $timestamps=false;
    protected $table = 'ilan_mallar';
    protected $fillable = ['id', 'ilan_id', 'marka','model', 'adi', 'ambalaj','miktar', 'birim_id'];
     
     public function birimler()
    {
        return $this->belongsTo('App\Birim', 'birim_id', 'id');
    }
      public function ilanlar()
    {
        return $this->belongsTo('App\Ilan', 'ilan_id', 'id');
    }
    public function mal_teklifler()
    {
        return $this->hasMany('App\MalTeklif', 'ilan_mal_id', 'id');
    }
    public function getMalTeklif($ilan_mal_id,$teklif_id){
        $malTeklif = MalTeklif::where('ilan_mal_id',$ilan_mal_id)->where('teklif_id',$teklif_id)->orderBy('id','DESC')->limit(1)->get();
        return $malTeklif;
    }
    public function malIdTeklifler($ilan_mal_id,$ilan_id){
        $malIdTeklifler= DB::select(DB::raw("SELECT * 
                        FROM mal_teklifler mt, teklifler t
                        WHERE ilan_mal_id ='$ilan_mal_id'
                        AND t.id = mt.teklif_id
                        AND t.ilan_id ='$ilan_id'
                        AND mt.id
                        IN (

                        SELECT MAX( id ) 
                        FROM mal_teklifler
                        GROUP BY teklif_id, ilan_mal_id
                        )
                        ORDER BY kdv_dahil_fiyat ASC "));
        return $malIdTeklifler;
    }
    public function getFirmaId($teklif_id){
         $firmaMalId = Teklif::find($teklif_id);
         $firmaMal = Firma::find($firmaMalId->firma_id);
         return $firmaMal->id;
    }
    public function getFirmaAdi($teklif_id){
         $firmaMalId = Teklif::find($teklif_id);
         $firmaMal = Firma::find($firmaMalId->firma_id);
         return $firmaMal->adi;
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
