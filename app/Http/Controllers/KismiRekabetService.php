<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ilan as Ilan;
use App\Firma as Firma;
use App\IlanMal as IlanMal;
use App\IlanHizmet as IlanHizmet;
use App\IlanYapimIsi as IlanYapimIsi;
use App\IlanGoturuBedel as IlanGoturuBedel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests;

class KismiRekabetService extends Controller
{
    //
    public function kismiRekabetService($firmaID,$ilanID){
        $firma = Firma::find($firmaID);
        $ilan = Ilan::find($ilanID);

        if (!$ilan)
            $firma->ilanlar = new Ilan();
        if (!$ilan->ilan_mallar)
            $firma->ilanlar->ilan_mallar = new IlanMal();
        if (!$ilan->ilan_hizmetler)
            $firma->ilanlar->ilan_hizmetler = new IlanHizmet();
        if (!$ilan->ilan_yapim_isleri)
            $firma->ilanlar->ilan_yapim_isleri = new IlanYapimIsi();

        if (!$ilan->ilan_goturu_bedeller)
            $firma->ilanlar->ilan_goturu_bedeller = new IlanGoturuBedel();

        $kullanici_id=Auth::user()->kullanici_id;

        $dt = Carbon::today();
        $time = Carbon::parse($dt);
        $dt = $time->format('Y-m-d');

        return view('Firma.ilan.kismiRekabet')->with('firma', $firma)->with('ilan',$ilan)->with('kullanici_id',$kullanici_id)->with("dt",$dt);
    }

}
