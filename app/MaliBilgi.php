<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaliBilgi extends Model
{
    protected $table = 'mali_bilgiler';
    
    public function firmalar()
    {
        return $this->belongsTo('App\Firma', 'firma_id', 'id');
    }
    public function vergi_daireleri()
    {
        return $this->belongsTo('App\VergiDairesi', 'vergi_dairesi_id', 'id');
    }
}
