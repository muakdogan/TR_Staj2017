<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KaliteBelgesi extends Model
{
    protected $table = 'kalite_belgeleri';
    
    public $timestamps = false;
    
    public function firmalar()
    {
        return $this->belognsToMany('App\Firma', 'firma_kalite_belgeleri', 'belge_id', 'firma_id')->withPivot('belge_no');
    }
}
