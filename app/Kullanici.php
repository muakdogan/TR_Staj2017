<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kullanici extends Model
{
    //
    protected $table = 'kullanicilar';
    public $timestamps=false;
    
    public function users()
    {
        return $this->hasOne('App\User', 'kullanici_id', 'id');
    }
    public function firmalar()
    {
        return $this->belongsToMany('App\Firma','firma_kullanicilar', 'kullanici_id', 'firma_id');
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
}
