<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Odeme extends Model
{
    protected $table = 'odemeler';
    public $timestamps = false;

    public function firma()
    {
        $this->belongsTo('App\Firma', 'firma_id', 'id');
    }
}
