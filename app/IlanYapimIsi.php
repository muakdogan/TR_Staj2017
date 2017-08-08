<?php

namespace App;
use App\YapimIsiTeklif;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Firma;
use App\Teklif;
use App\KismiAcikKazanan;
class IlanYapimIsi extends Model
{
    //
     protected $table = 'ilan_yapim_isleri';
     public $timestamps=false;
     public function birimler()
    {
        return $this->belongsTo('App\Birim', 'birim_id', 'id');
    }

    public function fiyat_birimler()
    {
        return $this->belongsTo('App\Birim', 'fiyat_standardi_birimi_id', 'id');
    }
       public function ilanlar()
    {
        return $this->belongsTo('App\Ilan', 'ilan_id', 'id');
    }
    public function yapim_isi_teklifler()
    {
        return $this->hasMany('App\YapimIsiTeklif', 'ilan_yapim_isleri_id', 'id');
    }
    public function getYapimIsiTeklif($ilan_yapim_isi_id,$teklif_id){
        $yapimIsiTeklif = YapimIsiTeklif::where('ilan_yapim_isleri_id',$ilan_yapim_isi_id)->where('teklif_id',$teklif_id)->orderBy('id','DESC')->limit(1)->get();
        return $yapimIsiTeklif;
    }
    public function yapimIsiIdTeklifler($ilan_id){
        $yapimIsiIdTeklifler= DB::select(DB::raw("SELECT * 
                FROM yapim_isi_teklifler yt, teklifler t
                WHERE ilan_yapim_isleri_id ='$this->id'
                AND t.id = yt.teklif_id
                AND t.ilan_id = '$ilan_id'
                AND yt.id
                IN (

                SELECT MAX( id ) 
                FROM yapim_isi_teklifler
                GROUP BY teklif_id, ilan_yapim_isleri_id
                )
                ORDER BY kdv_dahil_fiyat ASC  "));
        return $yapimIsiIdTeklifler;
    }   
    public function getFirmaId($teklif_id){
        $firmaYapimIsiId =Teklif::find($teklif_id);
        $firmaYapimIsi = Firma::find($firmaYapimIsiId->firma_id);
        
         return $firmaYapimIsi->id;
    }
    public function getFirmaAdi($teklif_id){
        $firmaYapimIsiId = Teklif::find($teklif_id);
        $firmaYapimIsi = Firma::find($firmaYapimIsiId->firma_id);
        return $firmaYapimIsi->adi;
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
