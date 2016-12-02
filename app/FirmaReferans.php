<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirmaReferans extends Model
{
    protected $table = 'firma_referanslar';
    
    public $timestamps = false;
    
    public function firmalar()
    {
        return $this->belongsTo('App\Firma', 'firma_id', 'id');
    }
}
