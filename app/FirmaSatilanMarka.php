<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirmaSatilanMarka extends Model
{
    //
    protected $table = 'firma_satilan_markalar';
    public $timestamps = false;
    
    public function firmalar()
    {
        return $this->belongsTo('App\Firma', 'firma_satilan_markalar', 'firma_id', 'id');
    }
}
