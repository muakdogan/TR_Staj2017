<?php

namespace App;

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
   
}
