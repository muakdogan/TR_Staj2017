<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirmaBrosur extends Model
{
    protected $table = 'firma_brosurler';
    
    public $timestamps = false;
    
    public function firmalar()
    {
        return $this->belongsTo('App\Firma', 'firma_id', 'id');
    }
}
