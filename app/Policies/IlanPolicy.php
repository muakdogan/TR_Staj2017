<?php

namespace App\Policies;
use App\Kullanici;
use App\Firma;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

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
    public function createIlan(Kullanici $user, $ilan, $firma_id)
    {
        $rol_id = $user->get_role_id($firma_id);

        //kullanıcıyı session'daki firma ile eşleştir. Alakasız kullanıcı ise null dönecek
        $yetkiliKullanici = DB::table('firma_kullanicilar')->where('kullanici_id', '=', $user->id)->where('firma_id', '=', $firma_id)->get();

        return $rol_id !== '3'//bu değer db'den string olarak geliyor
            && $yetkiliKullanici;//URL'ye başka firmanın id'si yazarak işlem yapılmaması için
    }
    public function teklifGonder(Kullanici $user, $ilan, $firma_id)
    {
        $rol_id = $user->get_role_id($firma_id);

        //kullanıcıyı session'daki firma ile eşleştir. Alakasız kullanıcı ise null dönecek
        $yetkiliKullanici = DB::table('firma_kullanicilar')->where('kullanici_id', '=', $user->id)->where('firma_id', '=', $firma_id)->get();

        return $rol_id !== '2'//bu değer db'den string olarak geliyor
            && $yetkiliKullanici;//URL'ye başka firmanın id'si yazarak işlem yapılmaması için
    }
}
