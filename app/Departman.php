<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departman extends Model
{
    protected $table = 'departmanlar';
    
    public $timestamps = false;
    
    public function firmalar()
    {
        return $this->belognsToMany('App\Firma', 'firma_departmanlar', 'departman_id', 'firma_id');
    }
    
}
