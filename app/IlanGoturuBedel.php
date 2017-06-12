<?php

namespace App;
Use App\GoturuBedelTeklif;
use Illuminate\Database\Eloquent\Model;

class IlanGoturuBedel extends Model
{
    //
    protected $table = 'ilan_goturu_bedeller';
    public $timestamps=false;
       public function ilanlar()
    {
        return $this->belongsTo('App\Ilan', 'ilan_id', 'id');
    }
    public function goturu_bedel_teklifler()
    {
        return $this->hasMany('App\GoturuBedelTeklif', 'ilan_goturu_bedeller_id', 'id');
    }
     public function miktar_birimler()
    {
        return $this->belongsTo('App\Birim', 'miktar_birim_id', 'id');
    }
    public function getGoturuBedelTeklif($ilan_goturu_bedel_id,$teklif_id){
        $goturuBedelTeklif = GoturuBedelTeklif::where('ilan_goturu_bedel_id',$ilan_goturu_bedel_id)->where('teklif_id',$teklif_id)->orderBy('id','DESC')->limit(1)->get();
        return $goturuBedelTeklif;
    }
}
