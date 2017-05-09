<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Kullanici2 extends Authenticatable
{
    protected $table = 'kullanicilar2';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'last_seen',
    ];




}
