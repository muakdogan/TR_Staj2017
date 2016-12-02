<?php

namespace App\Policies;
use App\User;
use App\Firma;
use DB;
use Illuminate\Auth\Access\HandlesAuthorization;

class FirmaPolicy
{
    use HandlesAuthorization;

       public function show(User $user, Firma $firma)
    {
       $kullanici = DB::table('firma_kullanicilar')->where('kullanici_id', '=', $user->kullanici_id)->where('firma_id', '=', $firma->id)->get();
       return $kullanici;
    }
    
    
   
}
