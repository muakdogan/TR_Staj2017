<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    protected $table = 'roller';

    public function firma_kullanicilar()
    {
        return $this->hasMany('App\FirmaKullanici', 'rol_id', 'id');
    }
    public function get_name($role_id)
    {
        return $this->find($role_id)->adi;
    }

}
