<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SatilanMarka extends Model
{
    protected $table = 'satilan_markalar';
    
    public $timestamps = false;
    
    public function firmalar()
    {
        return $this->belognsToMany('App\Firma', 'firma_satilan_markalar', 'sat_marka_id', 'firma_id');
    }
}
