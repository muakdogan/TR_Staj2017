<?php

namespace App\Policies;
use App\Kullanici;
use App\Firma;
use DB;
use Illuminate\Auth\Access\HandlesAuthorization;

class FirmaPolicy
{
  use HandlesAuthorization;

  public function show(Kullanici $user, Firma $firma)
  {
    $kullanici = DB::table('firma_kullanicilar')->where('kullanici_id', '=', $user->id)->where('firma_id', '=', $firma->id)->get();
    return $kullanici;
  }



}
