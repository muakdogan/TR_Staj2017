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
}
