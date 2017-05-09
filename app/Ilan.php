<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
  public function katilimcilar()
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
  public function getIlanTuru()
  {
    if($this->ilan_turu == 1)
      return 'Mal';
    else if ($this->ilan_turu == 2)
      return 'Hizmet';
    else if ($this->ilan_turu == 3)
      return 'Yapım İşi';
  }
  public function getKatilimcilar()
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
    else
      return session()->get('firma_adi');
  }
}
