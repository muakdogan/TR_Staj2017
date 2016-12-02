<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UretilenMarka extends Model
{
    protected $table = 'uretilen_markalar';
    
    public $timestamps = false;
    
    public function firmalar()
    {
        return $this->belognsTo('App\Firma', 'firma_id', 'id');
    }
}
