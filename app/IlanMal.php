<?php

namespace App;
use App\MalTeklif;
use Illuminate\Database\Eloquent\Model;

class IlanMal extends Model
{
    //
    public $timestamps=false;
    protected $table = 'ilan_mallar';
    protected $fillable = ['id', 'ilan_id', 'marka','model', 'adi', 'ambalaj','miktar', 'birim_id'];
     
     public function birimler()
    {
        return $this->belongsTo('App\Birim', 'birim_id', 'id');
    }
      public function ilanlar()
    {
        return $this->belongsTo('App\Ilan', 'ilan_id', 'id');
    }
    public function mal_teklifler()
    {
        return $this->hasMany('App\MalTeklif', 'ilan_mal_id', 'id');
    }
    public function getMalTeklif($ilan_mal_id,$teklif_id){
        $malTeklif = MalTeklif::where('ilan_mal_id',$ilan_mal_id)->where('teklif_id',$teklif_id)->orderBy('id','DESC')->limit(1)->get();
        return $malTeklif;
    }
}
