<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IletisimBilgisi extends Model
{
    protected $table = 'iletisim_bilgileri';
    
    public $timestamps = false;
    
    public function firmalar()
    {
        return $this->belongsTo('App\Firma', 'firma_id', 'id');
    }
}
