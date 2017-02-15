<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BelirlIstekli extends Model
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
}
