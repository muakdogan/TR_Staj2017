<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirmaCalismaBilgisi extends Model
{
    protected $table = 'firma_calisma_bilgileri';
    
    public $timestamps = false;
    
    public function firmalar()
    {
        return $this->belongsTo('App\Firma', 'firma_id', 'id');
    }
    public function calisma_gunleri()
    {
        return $this->belongsTo('App\CalismaGunu', 'calisma_gunleri_id', 'id');
    }
}
