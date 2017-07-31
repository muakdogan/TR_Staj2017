<?php

namespace App;
use App\Firma;
use DB;
use Illuminate\Database\Eloquent\Model;
use Barryvdh\Debugbar\Facade as Debugbar;
class Teklif extends Model
{
    //
    protected $table = 'teklifler';
    
    public $timestamps = false;
    
    public function teklif_hareketler()
    {
        return $this->hasMany('App\TeklifHareket', 'teklif_id', 'id');
    }
    public function mal_teklifler()
    {
        return $this->hasMany('App\MalTeklif', 'teklif_id', 'id');
    }
    public function hizmet_teklifler()
    {
        return $this->hasMany('App\HizmetTeklif', 'teklif_id', 'id');
    }
    public function yapim_isi_teklifler()
    {
        return $this->hasMany('App\YapimIsiTeklif', 'teklif_id', 'id');
    }
    public function goturu_bedel_teklifler()
    {
        return $this->hasMany('App\GoturuBedelTeklif', 'teklif_id', 'id');
    }
     public function ilanlar()
    {
        return $this->belongsTo('App\Ilan', 'ilan_id', 'id');
    }
    public function firmalar()
    {
        return $this->belongsTo('App\Firma', 'firma_id', 'id');
    }
    public function getFirma($param){
        $firma = Firma::find($this->firma_id);
        if($param == "adi"){
            return $firma->adi;
        }
        else if( $param == "id"){
            return $firma->id;
        }
    }
    public function verilenFiyat(){
        $verilenFiyat = $this->teklif_hareketler()->orderBy('id','desc')->limit(1)->get(); // Teklif hareketler tablosunda grouplama yaptığım için en güncel kayıt gelmesi için .Özge
        return number_format($verilenFiyat[0]['kdv_dahil_fiyat'],2,'.','');
    }
    public function getTeklifMallar(){
        $teklifMallar=DB::select(DB::raw("SELECT * 
                                                FROM teklifler t, mal_teklifler m
                                                WHERE t.id = m.teklif_id
                                                AND t.id ='$this->id'
                                                GROUP BY m.ilan_mal_id"));
        return $teklifMallar;
    }
    public function getTeklifHizmetler(){
        Debugbar::info($this->firma_id);
        $teklifHizmetler=DB::select(DB::raw("SELECT * 
                                                FROM teklifler t, hizmet_teklifler h
                                                WHERE t.id = h.teklif_id
                                                AND t.id ='$this->id'
                                                GROUP BY h.ilan_hizmet_id"));
        return $teklifHizmetler;
    }
    public function getTeklifYapimIsleri(){
        $teklifYapimIsleri=DB::select(DB::raw("SELECT * 
                                                FROM teklifler t, yapim_isi_teklifler y
                                                WHERE t.id = y.teklif_id
                                                AND t.id ='$this->id'
                                                GROUP BY y.ilan_yapim_isleri_id"));
        return $teklifYapimIsleri;
    }
    public function getTeklifGoturuBedel (){
        $teklifGoturuBedeller=DB::select(DB::raw("SELECT * 
                                                FROM teklifler t, goturu_bedel_teklifler g
                                                WHERE t.id = g.teklif_id
                                                AND t.id ='$this->id'
                                                GROUP BY g.ilan_goturu_bedel_id"));
        return $teklifGoturuBedeller;
    }
    public function getIlanTeklifSayisi (){
        return $this->ilanlar->teklifler()->count();
    }
    public function teklifMalCount($ilan){
        
        if($ilan->ilan_turu == 1 && $ilan->sozlesme_turu == 0){ //MAl -->
            $ilanMalCount = $ilan->ilan_mallar()->count();
            $teklifMallar=$this->getTeklifMallar();
                $teklifMalCount=0;
                foreach($teklifMallar as $teklifMal){
                    $teklifMalCount++;
                }
        }else if($ilan->ilan_turu == 2 && $ilan->sozlesme_turu == 0){ //--Hizmet -->
                $ilanMalCount = $ilan->ilan_hizmetler()->count();
                $teklifHizmetler=$this->getTeklifHizmetler();
                $teklifMalCount=0;
                foreach($teklifHizmetler as $teklifHizmet){
                    $teklifMalCount++;
                }
                Debugbar::info($teklifHizmetler);
        }elseif($ilan->ilan_turu == 3){//<!-- Yapım İşi-->
                $ilanMalCount = $ilan->ilan_yapim_isleri()->count();
                $teklifYapimIsleri=$this->getTeklifYapimIsleri();
                $teklifMalCount=0;
                foreach($teklifYapimIsleri as $teklifYapimIsi){
                    $teklifMalCount++;
                }
        }
        else{ //<!-- Goturu Bedel-->
            $ilanMalCount = $ilan->ilan_goturu_bedeller()->count();
                        $teklifGoturuBedeller=DB::select(DB::raw("SELECT *
                                        FROM teklifler t, goturu_bedel_teklifler g
                                        WHERE t.id = g.teklif_id
                                        AND t.id ='$this->id'
                                        GROUP BY g.ilan_goturu_bedel_id"));
                        $teklifMalCount=0;
                        foreach($teklifGoturuBedeller as $teklifGoturuBedel){
                            $teklifMalCount++;
                        }
        }
        if($ilanMalCount == $teklifMalCount){
            return true;
        }
        else{
            return false;
        }
               
    }
            
}
