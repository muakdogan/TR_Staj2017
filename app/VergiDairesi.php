<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VergiDairesi extends Model
{
    //
    protected $table='vergi_daireleri';
    
    public function mali_bilgileri()
    {
        return $this->hasMany('App\MaliBilgi', 'vergi_dairesi_id', 'id');
    }
}
