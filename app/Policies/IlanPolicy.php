<?php

namespace App\Policies;
use App\Kullanici;
use App\Firma;

use Illuminate\Auth\Access\HandlesAuthorization;

class IlanPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function createIlan(Kullanici $user)
    {
      $rol_id = $user->get_role_id(session()->get('firma_id'));
      return $rol_id !== 3;
    }
}
