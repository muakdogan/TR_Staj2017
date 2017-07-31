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

        if (!$firma->ilanlar)
            $firma->ilanlar = new Ilan();
        if (!$firma->ilanlar->ilan_mallar)
            $firma->ilanlar->ilan_mallar = new IlanMal();
        if (!$firma->ilanlar->ilan_hizmetler)
            $firma->ilanlar->ilan_hizmetler = new IlanHizmet();
        if (!$firma->ilanlar->ilan_yapim_isleri)
            $firma->ilanlar->ilan_yapim_isleri = new IlanYapimIsi();

        if (!$firma->ilanlar->ilan_goturu_bedeller)
            $firma->ilanlar->ilan_goturu_bedeller = new IlanGoturuBedel();

        $kullanici_id=Auth::user()->kullanici_id;

        $dt = Carbon::today();
        $time = Carbon::parse($dt);
        $dt = $time->format('Y-m-d');

        return view('Firma.ilan.kismiRekabet')->with('firma', $firma)->with('ilan',$ilan)->with('kullanici_id',$kullanici_id)->with("dt",$dt);
    }

}
