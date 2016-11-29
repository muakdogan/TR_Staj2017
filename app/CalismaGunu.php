<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalismaGunu extends Model
{
    protected $table = 'calisma_gunleri';
    
    public $timestamps = false;
    
    public function firmalar()
    {
        return $this->hasMany('App\FirmaCalismaBilgisi', 'calisma_gunleri_id', 'id');
    }
}
