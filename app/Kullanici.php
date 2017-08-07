<?php

namespace App;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Kullanici extends Authenticatable
{
  //
  protected $table = 'kullanicilar';

  protected $fillable = [
    'name', 'email', 'password',
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'password', 'remember_token', 'last_seen',
  ];

  public function firmalar()
  {
    return $this->belongsToMany('App\Firma','firma_kullanicilar', 'kullanici_id', 'firma_id')->withPivot('rol_id', 'unvan');
  }
  public function yorumlar()
  {
    return $this->hasMany('App\Yorum', 'yorum_yapan_kullanici_id', 'id');
  }
  public function puanlamalar()
  {
    return $this->hasMany('App\Puanlama', 'yorum_yapan_kullanici_id', 'id');
  }
  public function teklif_hareketler()
  {
    return $this->hasMany('App\TeklifHareket', 'kullanici_id', 'id');
  }
  public function mal_teklifler()
  {
    return $this->hasMany('App\MalTeklif', 'kullanici_id', 'id');
  }
  public function yapim_isi_teklifler()
  {
    return $this->hasMany('App\YapimIsiTeklif', 'kullanici_id', 'id');
  }
  public function hizmet_teklifler()
  {
    return $this->hasMany('App\HizmetTeklif', 'kullanici_id', 'id');
  }
  public function goturu_bedel_teklifler()
  {
    return $this->hasMany('App\GoturuBedelTeklif', 'kullanici_id', 'id');
  }
  public function get_role_id($firma_id)
  {
    $firmas = $this->firmalar()->find($firma_id);
    if ($firmas)
      return $firmas->pivot->rol_id;
    else return null;
  }
}
