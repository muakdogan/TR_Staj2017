<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OdemeTuru extends Model
{
    //
    protected $table = 'odeme_turleri';
    
    public function ilanlar()
    {
        return $this->hasMmany('App\İlan', 'odeme_turu_id', 'id');
    }
   
}
