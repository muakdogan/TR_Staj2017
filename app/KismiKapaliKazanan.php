<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KismiKapaliKazanan extends Model
{
    //
    protected $table = 'kismi_kapali_kazananlar';
    
    public $timestamps = false;
    
    public function ilanlar()
    {
     return $this->belongsTo('App\Ilan', 'ilan_id', 'id');
    }
    public function firma()
    {
        return $this->belongsTo('App\Firma', 'kazanan_firma_id', 'id');
    }
}
