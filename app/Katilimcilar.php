<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Katilimci extends Model
{

  protected $table = 'katilimcilar';
  public $timestamps=false;
  public function ilanlar()
  {
    return $this->belongsTo('App\Ilan', 'ilan_id', 'id');
  }
  public function firmalar()
  {
    return $this->belongsTo('App\Firma', 'firma_id', 'id');
  }
}
