<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sektor extends Model
{
    protected $table = 'sektorler';

    public $timestamps = false;

    public function firmalar()
    {
        return $this->belongsToMany('App\Firma', 'firma_sektorler', 'sektor_id', 'firma_id');
    }
    public function ilanlar()
    {
        return $this->belongsTo('App\Ilan', 'ilan_sektor', 'id');
    }
    
    
}
