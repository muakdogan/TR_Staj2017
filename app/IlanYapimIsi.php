<?php

namespace App;
use App\YapimIsiTeklif;
use Illuminate\Database\Eloquent\Model;

class IlanYapimIsi extends Model
{
    //
     protected $table = 'ilan_yapim_isleri';
     public $timestamps=false;
     public function birimler()
    {
        return $this->belongsTo('App\Birim', 'birim_id', 'id');
    }
       public function ilanlar()
    {
        return $this->belongsTo('App\Ilan', 'ilan_id', 'id');
    }
    public function yapim_isi_teklifler()
    {
        return $this->hasMany('App\YapimIsiTeklif', 'ilan_yapim_isleri_id', 'id');
    }
    public function getYapimIsiTeklif($ilan_yapim_isi_id,$teklif_id){
        $yapimIsiTeklif = YapimIsiTeklif::where('ilan_yapim_isleri_id',$ilan_yapim_isi_id)->where('teklif_id',$teklif_id)->orderBy('id','DESC')->limit(1)->get();
        return $yapimIsiTeklif;
    }
}
