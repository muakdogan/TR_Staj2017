<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KismiAcikKazanan extends Model
{
    //
    protected $table = 'kismi_acik_kazananlar';
    
    public $timestamps = false;
    public function ilanlar()
    {
     return $this->belongsTo('App\Ilan', 'ilan_id', 'id');
    }
    
}
