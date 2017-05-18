<?php

namespace App;
use App\Firma;
use DB;
use Illuminate\Database\Eloquent\Model;

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
        $firma = Firma::find($this->firma_id);
        $verilenFiyat = $firma->teklif_hareketler()->orderBy('id','desc')->limit(1)->get();
        return number_format($verilenFiyat[0]['kdv_dahil_fiyat'],2,'.','');
    }
    public function getTeklifMallar(){
        $teklifMallar=DB::select(DB::raw("SELECT * 
                                                FROM teklifler t, mal_teklifler m
                                                WHERE t.id = m.teklif_id
                                                AND t.id ='$this->firma_id'
                                                GROUP BY m.ilan_mal_id"));
        return $teklifMallar;
    }
    public function getTeklifHizmetler(){
        $teklifHizmetler=DB::select(DB::raw("SELECT * 
                                                FROM teklifler t, hizmet_teklifler h
                                                WHERE t.id = h.teklif_id
                                                AND t.id ='$this->firma_id'
                                                GROUP BY h.ilan_hizmet_id"));
        return $teklifHizmetler;
    }
    public function getTeklifYapimIsleri(){
        $teklifYapimIsleri=DB::select(DB::raw("SELECT * 
                                                FROM teklifler t, hizmet_teklifler h
                                                WHERE t.id = h.teklif_id
                                                AND t.id ='$this->firma_id'
                                                GROUP BY h.ilan_hizmet_id"));
        return $teklifYapimIsleri;
    }
    public function getTeklifGoturuBedel (){
        $teklifGoturuBedeller=DB::select(DB::raw("SELECT * 
                                                FROM teklifler t, goturu_bedel_teklifler g
                                                WHERE t.id = g.teklif_id
                                                AND t.id ='$this->firma_id'
                                                GROUP BY g.ilan_goturu_bedel_id"));
        return $teklifGoturuBedeller;
    }
    public function getIlanTeklifSayisi (){
        return $this->ilanlar->teklifler()->count();
    }
            
}
