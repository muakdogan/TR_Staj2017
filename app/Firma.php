<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firma extends Model
{
    protected $table = 'firmalar';
    public $timestamps=false;
    public function sektorler()
    {
        return $this->belongsToMany('App\Sektor', 'firma_sektorler', 'firma_id', 'sektor_id');
    }
    public function faaliyetler()
    {
        return $this->belongsToMany('App\Faaliyet', 'firma_faaliyetler', 'firma_id', 'faaliyet_id');
    }
    public function departmanlar()
    {
        return $this->belongsToMany('App\Departman', 'firma_departmanlar', 'firma_id', 'departman_id');
    }
    public function satilan_markalar()
    {
        return $this->belongsToMany('App\SatilanMarka', 'firma_satilan_markalar', 'firma_id', 'satilan_marka_id');
    }
    public function kalite_belgeleri()
    {
        return $this->belongsToMany('App\KaliteBelgesi', 'firma_kalite_belgeleri', 'firma_id', 'belge_id')->withPivot('belge_no');
    }
    public function uretilen_markalar()
    {
        return $this->hasMany('App\UretilenMarka', 'firma_id', 'id');
    }
    public function firma_referanslar()
    {
        return $this->hasMany('App\FirmaReferans', 'firma_id', 'id');
    }
    public function firma_brosurler()
    {
        return $this->hasMany('App\FirmaBrosur', 'firma_id', 'id');
    }
    public function mali_bilgiler()
    {
        return $this->hasOne('App\MaliBilgi', 'firma_id', 'id');
    }
    public function ticari_bilgiler()
    {
        return $this->hasOne('App\TicariBilgi', 'firma_id', 'id');
    }
    public function iletisim_bilgileri()
    {
        return $this->hasOne('App\IletisimBilgisi', 'firma_id', 'id');
    }
    public function firma_calisma_bilgileri()
    {
        return $this->hasOne('App\FirmaCalismaBilgisi', 'firma_id', 'id');
    }    
    public function adresler()
    {
        return $this->hasMany('App\Adres', 'firma_id', 'id');
    }
    public function sirket_turleri()
    {
        return $this->belongsTo('App\SirketTuru', 'tur_id', 'id');
    }
    public function kullanicilar()
    {
        return $this->belongsToMany('App\Kullanici','firma_kullanicilar', 'firma_id','kullanici_id');
    }
     public function ilanlar()
    {
        return $this->hasOne('App\Ilan', 'firma_id', 'id');
    }
    public function ilan_mallar()
    {
        return $this->hasManyThrough('App\IlanMal', 'App\Ilan','firma_id','ilan_id','id');
    }
     public function ilan_hizmetler()
    {
        return $this->hasManyThrough('App\IlanHizmet', 'App\Ilan','firma_id','ilan_id','id');
    }
     public function ilan_goturu_bedeller()
    {
        return $this->hasManyThrough('App\IlanGoturuBedel', 'App\Ilan','firma_id','ilan_id','id');
    }
    public function teklifler()
    {
        return $this->hasMany('App\Teklif', 'firma_id', 'id');
    }
    public function yorumlar()
    {
        return $this->hasMany('App\Yorum', 'firma_id', 'id');
    }
    public function yorumlarFirma()
    {
        return $this->hasMany('App\Yorum', 'yorum_yapan_firma_id', 'id');
    }
    public function puanlamalar()
    {
        return $this->hasMany('App\Puanlama', 'firma_id', 'id');
    }
    public function puanlamalarFirma()
    {
        return $this->hasMany('App\Puanlama', 'yorum_yapan_firma_id', 'id');
    }
    
    
}
