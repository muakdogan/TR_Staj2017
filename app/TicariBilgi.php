<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicariBilgi extends Model
{
    protected $table = 'ticari_bilgiler';
    
    public function firmalar()
    {
        return $this->belongsTo('App\Firma', 'firma_id', 'id');
    }
    public function ticaret_odalari()
    {
        return $this->belongsTo('App\TicaretOdasi', 'tic_oda_id', 'id');
    }
    public function sektorler()
    {
        return $this->belongsTo('App\Sektor', 'ust_sektor_id', 'id');
    }
}
