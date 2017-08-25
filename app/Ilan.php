<?php

namespace App;
use App\Sektor;
use App\KismiKapaliKazanan;
use App\KismiAcikKazanan;
use App\BelirliIstekli;
use App\Firma;
use Illuminate\Database\Eloquent\Model;
use App\Puanlama;
use App\Yorum;
use DB;
class Ilan extends Model
{
  //
  protected $table = 'ilanlar';
  //public $timestamps = false;

  public function odeme_turleri()
  {
    return $this->belongsTo('App\OdemeTuru', 'odeme_turu_id', 'id');
  }
  public function firmalar()
  {
    return $this->belongsTo('App\Firma', 'firma_id', 'id');
  }
  public function para_birimleri()
  {
    return $this->belongsTo('App\ParaBirimi', 'para_birimi_id', 'id');
  }
  public function maliyetler()
  {
    return $this->belongsTo('App\Maliyet', 'yaklasik_maliyet_id', 'id');
  }
  public function ilan_mallar()
  {
    return $this->hasMany('App\IlanMal', 'ilan_id', 'id');
  }
  public function ilan_hizmetler()
  {
    return $this->hasMany('App\IlanHizmet', 'ilan_id', 'id');
  }
  public function ilan_goturu_bedeller()
  {
    return $this->hasMany('App\IlanGoturuBedel', 'ilan_id', 'id');
  }
  public function katilimci_firmalar()
  {
    return $this->hasMany('App\Katilimcilar', 'ilan_id', 'id');
  }
  public function belirli_istekliler()
  {
    return $this->hasMany('App\BelirliIstekli', 'ilan_id', 'id');
  }
  public function ilan_yapim_isleri()
  {
    return $this->hasMany('App\IlanYapimIsi', 'ilan_id', 'id');
  }
  public function iller()
  {
    return $this->belongsTo('App\Il', 'teslim_yeri_il_id', 'id');
  }
  public function ilceler()
  {
    return $this->belongsTo('App\Ilce', 'teslim_yeri_ilce_id', 'id');
  }
  public function teklifler()
  {
    return $this->hasMany('App\Teklif', 'ilan_id', 'id');
  }
  public function yorumlar()
  {
    return $this->hasMany('App\Yorum', 'ilan_id', 'id');
  }
  public function puanlamalar()
  {
    return $this->hasMany('App\Puanlama', 'ilan_id', 'id');
  }
  public function sektorler()
  {
    return $this->hasOne('App\Sektor', 'id', 'ilan_sektor');
  }
  public function teklif_hareketler()
  {
   return $this->hasManyThrough('App\TeklifHareket', 'App\Teklif', 'ilan_id', 'teklif_id', 'id');
  }
  public function kismi_acik_kazananlar()
  {
   return $this->hasMany('App\KismiAcikKazanan', 'ilan_id', 'id');
  }
  public function kismi_kapali_kazananlar()
  {
   return $this->hasMany('App\KismiKapaliKazanan', 'ilan_id', 'id');
  }
  public function getIlanTuru()
  {
    if($this->ilan_turu == 1)
      return 'Mal';
    else if ($this->ilan_turu == 2)
      return 'Hizmet';
    else if ($this->ilan_turu == 3)
      return 'Yapım İşi';
  }
  public function getKatilimciTur()
  {
    if($this->katilimcilar == 1)
      return 'Onaylı Tedarikçiler';
    else if ($this->katilimcilar == 2)
      return 'Belirli Firmalar';
    else if ($this->katilimcilar == 3)
      return 'Tüm Firmalar';
  }
  public function getRekabet()
  {
    if($this->rekabet_sekli == 1)
      return 'Tamrekabet';
    else if ($this->rekabet_sekli == 2)
      return 'Sadece Başvuru';
  }
  public function getSozlesmeTuru()
  {
    if($this->sozlesme_turu == 0)
      return 'Birim Fiyatlı';
    else if ($this->sozlesme_turu == 1)
      return 'Götürü Bedel';
  }
  public function getFytSekli()
  {
    if($this->kismi_fiyat == 0)
      return 'Kısmi Fiyat Teklifine Açık';
    else if ($this->kismi_fiyat == 1)
      return 'Kısmi Fiyat Teklifine Kapalı';
  }
  public function getFirmaAdi()
  {
    if($this->goster == 0)
      return 'Firma Adı Gizli';
    else{
        return Firma::find($this->firma_id)->adi;
    }
  }
  public function getKalem ($kalem_id){
        if($this->ilan_turu == 1 && $this->sozlesme_turu == 0){
            $kalem = \App\IlanMal::find($kalem_id);
        }elseif($this->ilan_turu == 2 && $this->sozlesme_turu == 0)  {
            $kalem = App\IlanHizmet::find($kalem_id);
        }elseif($this->ilan_turu == 3){
            $kalem = App\IlanYapimIsi::find($kalem_id);
        }else{
            $kalem = \App\IlanGoturuBedel::find($kalem_id);
        }
        return $kalem;
  }
  public function getIlanTeklifSayisi(){
    return $ilanTeklif= $this->teklifler()->count();
  }
  
 public function getIlanSektorAdi($ilan_sektor_id){
        $sektorAdi=Sektor::find($ilan_sektor_id);
        return $sektorAdi->adi;
 }
 public function belirliIstekliControl($ilan_id ,$firma_id){

        $belirliFirmalar = BelirliIstekli::where('ilan_id',$ilan_id)->get();
        $belirliFirma= 0;

        foreach ($belirliFirmalar as $belirliIstekli){
            if($belirliIstekli->firma_id == $firma_id ){
                $belirliFirma = 1;
            }
        }
        return $belirliFirma;
 }
 public function kazananFiyatAcik(){
   $sonucTarihi = KismiAcikKazanan::where('ilan_id',$this->id)->get();
   $kazananFiyat=0;
   foreach($sonucTarihi as $sonuclanma){
       $kazananFiyat+=$sonuclanma->kazanan_fiyat;
   }
   return number_format($kazananFiyat,2,'.','');
 }
 public function sonuc_tarihi_acik(){
   $sonucTarihi = KismiAcikKazanan::where('ilan_id',$this->id)->get();
   if(count($sonucTarihi)!=0)
   {
       foreach ($sonucTarihi as $sonucAcik){
       }
       $sonucTarihiAcik=date('d-m-Y', strtotime($sonucAcik->sonuclanma_tarihi));
   }
   else
   {
      $sonucTarihiAcik=" ";
   }
   return $sonucTarihiAcik;
 }

 public function sonuc_tarihi_kapali(){
        $sonucTarihiKapali = KismiKapaliKazanan::where('ilan_id',$this->id)->get();
        if(count($sonucTarihiKapali)!=0)
        {
            foreach ($sonucTarihiKapali as $sonucKapali){
            }
            $sonucTarihiKapali=date('d-m-Y', strtotime($sonucKapali->sonuclanma_tarihi));
        }
        else
        {
           $sonucTarihiKapali=" ";
        }
        return $sonucTarihiKapali;
  }

  public function kazananFiyatKapali(){
    $sonucTarihiKapali = KismiKapaliKazanan::where('ilan_id',$this->id)->get();
    if(count($sonucTarihiKapali)!=0)
    {
        foreach ($sonucTarihiKapali as $sonucKapali){
        }
        $kazananFiyatKapali=number_format($sonucKapali->kazanan_fiyat,2,'.','');
    }
    else
    {
       $kazananFiyatKapali=" ";
    }
    return $kazananFiyatKapali;
  }
  public function kazananFirmaAdiKapali(){
    $sonucTarihiKapali = KismiKapaliKazanan::where('ilan_id',$this->id)->get();
    if(count($sonucTarihiKapali)!=0)
    {
      foreach ($sonucTarihiKapali as $sonucKapali){
       $kazananFirmaAdiKapali= Firma::find($sonucKapali->kazanan_firma_id);
      }
        $kazananFirmaAdiKapali = $kazananFirmaAdiKapali->adi;
    }
    else
    {
       $kazananFirmaAdiKapali=" ";
    }
    return $kazananFirmaAdiKapali;
  }
  public function kazananFirmaId(){
    $sonucKapali = KismiKapaliKazanan::where('ilan_id',$this->id)->get();
    $sonucAcik = KismiAcikKazanan::where('ilan_id',$this->id)->get();
    if(count($sonucKapali)!=0)
    {
      foreach ($sonucKapali as $sonucK){
      }
        $kazananFirmaId = $sonucK->kazanan_firma_id;
    }else{ $kazananFirmaId = 0;}

    if(count($sonucAcik)!=0)
    {
      foreach ($sonucAcik as $sonucA){
      }
      $kazananFirmaId= $sonucA->kazanan_firma_id;
    }else{$kazananFirmaId =0;}

    return $kazananFirmaId;
  }
    public function existsYorum($firma_id){
      $existsYorum = Yorum::where('ilan_id',$this->id)->where('firma_id',$firma_id)->get();
      return $existsYorum;
    }
    public function existsPuan($firma_id){
      $existsPuan = Puanlama::where('ilan_id',$this->id)->where('firma_id',$firma_id)->get();
      return $existsPuan;
    }
    public function minFiyat(){
        if($this->ilan_turu == 1 && $this->sozlesme_turu == 0){ //<!--MAl -->
          $minFiyat = DB::select(DB::raw("SELECT SUM( toplam ) AS deneme
              FROM (

              SELECT min( kdv_dahil_fiyat ) AS toplam
              FROM teklifler t, mal_teklifler m
              WHERE t.id = m.teklif_id
              AND t.ilan_id ='$this->id'
              AND m.id
              IN (

              SELECT MAX( id )
              FROM mal_teklifler
              GROUP BY teklif_id, ilan_mal_id
              )
              GROUP BY ilan_mal_id
              )y"));
        }elseif($this->ilan_turu == 2 && $this->sozlesme_turu == 0){ //<!--Hizmet -->
            $minFiyat = DB::select(DB::raw("SELECT SUM( toplam ) AS deneme
                FROM (
                SELECT min( kdv_dahil_fiyat ) AS toplam
                FROM teklifler t, hizmet_teklifler h
                WHERE t.id = h.teklif_id
                AND t.ilan_id ='$this->id'
                AND h.id
                IN (
                SELECT MAX( id )
                FROM hizmet_teklifler
                GROUP BY teklif_id, ilan_hizmet_id
                )
                GROUP BY ilan_hizmet_id
                )y"));
        }elseif($this->ilan_turu == 3){ //<!-- Yapım İşi-->
            $minFiyat = DB::select(DB::raw("SELECT SUM( toplam ) AS deneme
                FROM (
                SELECT min( kdv_dahil_fiyat ) AS toplam
                FROM teklifler t, yapim_isi_teklifler y
                WHERE t.id = y.teklif_id
                AND t.ilan_id ='$this->id'
                AND y.id
                IN (
                SELECT MAX( id )
                FROM yapim_isi_teklifler
                GROUP BY teklif_id, ilan_yapim_isleri_id
                )
                GROUP BY ilan_yapim_isleri_id
                )y"));
        }else{ //<!-- Goturu Bedel-->
            $minFiyat = DB::select(DB::raw("SELECT SUM( toplam ) AS deneme
                FROM (
                SELECT min( kdv_dahil_fiyat ) AS toplam
                FROM teklifler t, goturu_bedel_teklifler g
                WHERE t.id = g.teklif_id
                AND t.ilan_id ='$this->id'
                AND g.id
                IN (
                SELECT MAX( id )
                FROM goturu_bedel_teklifler
                GROUP BY teklif_id, ilan_goturu_bedel_id
                )
                GROUP BY ilan_goturu_bedel_id
                )y"));
        }
        return $minFiyat;

    }

}
