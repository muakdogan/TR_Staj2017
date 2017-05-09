<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirmaKullanici extends Model
{
    //
    protected $table = 'firma_kullanicilar';
    public $timestamps = false;
    public function roller()
    {
        return $this->belongsTo('App\Rol', 'rol_id', 'id');
    }
    public function mal_teklifler()
    {
        return $this->hasMany('App\MalTeklif', 'firma_kullanicilar_id', 'id');
    }
    public function hizmet_teklifler()
    {
        return $this->hasMany('App\HizmetTeklif', 'firma_kullanicilar_id', 'id');
    }
    public function goturu_bedeller_teklifler()
    {
        return $this->hasMany('App\GoturuBedelTeklif', 'firma_kullanicilar_id', 'id');
    }
    public function yapim_isi_teklifler()
    {
        return $this->hasMany('App\YapimIsiTeklif', 'firma_kullanicilar_id', 'id');
    }

}
