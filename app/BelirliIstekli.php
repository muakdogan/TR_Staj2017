<?php

namespace App;
use App\Ilan;
use Illuminate\Database\Eloquent\Model;

class BelirliIstekli extends Model
{
    //
    
    protected $table = 'belirli_istekliler';
    public $timestamps=false;
     public function ilanlar()
    {
        return $this->belongsTo('App\Ilan', 'ilan_id', 'id');
    }
     public function firmalar()
    {
        return $this->belongsTo('App\Firma', 'firma_id', 'id');
    }
    
    public function dvtIlanAdi($ilan_id)
    {
        $dIlan = Ilan::find($ilan_id);
        return $dIlan->adi; 
    }
    public function dIlanTeklifsayısı($ilan_id)
    {
        $dIlan = Ilan::find($ilan_id);
        return   $dIlan->teklifler()->count();
    }
    public function getdIlan($ilan_id)
    {
        $dIlan = Ilan::find($ilan_id);
        return   $dIlan->ilan_id;
    }
     public function getdIlanId($ilan_id)
    {
        $dIlan = Ilan::find($ilan_id);
        return   $dIlan->id;
    }
    
}
