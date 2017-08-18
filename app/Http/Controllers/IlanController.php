<?php

namespace App\Http\Controllers;
use Request;
use App\Il;
use App\Firma;
use App\OdemeTuru;
use App\Sektor;
use App\BelirlIstekli;
use DB;
use App\Ilan;
use App\IlanHizmet;
use App\IlanMal;
use App\IlanGoturuBedel;
use App\IlanYapimIsi;
use App\Maliyet;
use App\ParaBirimi;
use App\Birim;
use App\OnayliTedarikci;

use Input;
use View;
use Carbon\Carbon;
use Response;
use Barryvdh\Debugbar\Facade as Debugbar;
use Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class IlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('firmaYetkili', ['except' => ['showIlan']]);
    }
    //
    public function showIlan(){

        $firma_id = session()->get('firma_id');

        $dt = Carbon::now();
        $dt->toDateString();  
        $iller = Il::all();

        $ilanlar =  Ilan::where('goster', 1)->with([
            'sektorler',
            'firmalar.adresler' => function($query)
                { $query->where('adresler.tur_id', 1);},
            'firmalar.adresler.iller',
            'firmalar.adresler.adres_turleri'])
            ->where('ilanlar.yayin_tarihi', '<=', date_create(NULL))
            ->where('ilanlar.kapanma_tarihi', '>=', date_create(NULL));

        $sektorler= Sektor::all();//tüm sektörlerin görünebilmesi için ayrı olarak sorgulanıyor
        $firma = Firma::with('sektorler')->find($firma_id);
        $odeme_turleri= OdemeTuru::all();
        $teklifler= \App\Teklif::all();

        $misafir = !$firma || $firma->onay == 0;

        if($misafir){ 
            $sektor_id = 0;
            $davetEdildigimIlanlar = null;
        }else{
            foreach($firma->sektorler as $sektor){
                        $sektor_id = $sektor->id;
            }
            $davetEdildigimIlanlar = BelirlIstekli::where('firma_id',$firma_id)->get();
        }
        /*$ilanlar = Ilan::join('firmalar', 'ilanlar.firma_id', '=', 'firmalar.id')
                ->join('adresler', 'adresler.firma_id', '=', 'firmalar.id')
                ->join('iller', 'adresler.il_id', '=', 'iller.id')
                ->where('adresler.tur_id', '=' , 1)
                ->where('ilanlar.yayin_tarihi', '<=' , $dt->today())
                ->where('ilanlar.kapanma_tarihi', '>=' , $dt->today())
                ->orderBy('ilanlar.yayin_tarihi', 'DESC')
                ->select('ilanlar.id as ilan_id','ilanlar.adi as ilanadi', 'ilanlar.*','firmalar.id as firmaid', 'firmalar.*','adresler.id as adresid','adresler.*','iller.adi as iladi'); */
        $ilId = Input::get('ilAdi');
        $keyword = Input::get('keyword');
        $il_id = Input::get('il');
        $bas_tar = Input::get('bas_tar');
        $bit_tar = Input::get('bit_tar');   
        $sektorlerInput = Input::get('sektor');
        $tur = Input::get('tur');
        $usul= Input::get('usul');
        $radSearch= Input::get('radSearch');
        $input= Input::get('input');
        $sozlesme= Input::get('sozles');
        $odeme= Input::get('odeme');
        
        if($input != NULL){
            if($radSearch == "tum"){
                foreach ($sektorler as $sektor){
                    if($sektor->adi == $input){
                        $sektor_id = $sektor->id;
                    }
                    else{
                        $sektor_id = 0;
                    }
                }
                Debugbar::info($input);
                $ilanlar->where('ilanlar.goster',1)
                    ->where(function ($query) use ($input,$sektor_id) {
                        $query->where('ilanlar.adi', 'like', '%' . $input . '%')
                            ->orWhere('firmalar.adi', 'like', '%' . $input . '%')
                            ->orWhere('ilanlar.aciklama', 'like', '%' . $input . '%')
                            ->orWhere('iller.adi', 'like', '%' . $input . '%')
                            ->orWhere('ilanlar.ilan_sektor',$sektor_id);
                    });
                        
            }
            else if($radSearch == "ilan_baslık"){
                $ilanlar->where('ilanlar.adi', $input);
            }
            else{
                $ilanlar->where('firmalar.adi', $input);                
            }
        }
        if($ilId != NULL){
            $ilanlar->where('adresler.il_id',$ilId);
        }
        if($keyword != NULL){
            Debugbar::info("girdi keyword1");
            $sektorler = Sektor::all();
            foreach ($sektorler as $sektor){
                if($sektor->adi == $keyword){
                    $sektor_id = $sektor->id;
                }
                else{
                    $sektor_id = 0;
                }
            }
            Debugbar::info($keyword);
            $ilanlar->where(function ($query) use ($sektor_id,$keyword) {
                        Debugbar::info("girdi keyword");
                        $query->where('ilanlar.adi' ,$keyword )
                                ->orWhere('firmalar.adi',$keyword )
                                ->orWhere('ilanlar.ilan_sektor',$sektor_id);
                        });
             
        }
        if($il_id != NULL)
            {
             $ilanlar->whereIn('adresler.il_id',$il_id);
            }
        if ($bas_tar != NULL) {
            $ilanlar->where('ilanlar.yayin_tarihi','>=', $bas_tar);
        }
        if ($bit_tar != NULL) {
            $ilanlar->where('ilanlar.kapanma_tarihi','<=',$bit_tar);
        }
        if($sektorlerInput != NULL){
            $ilanlar->whereIn('ilanlar.ilan_sektor',$sektorlerInput);
        }
        if($tur != NULL){
            $ilanlar->where('ilanlar.ilan_turu',$tur);
        }
        if($usul != NULL){
            $ilanlar->where('ilanlar.usulu',$usul);
        }
        if($sozlesme != NULL){
            $ilanlar->where('ilanlar.sozlesme_turu',$sozlesme);
        }
        if($odeme != NULL){
            $ilanlar->whereIn('ilanlar.odeme_turu_id',$odeme);
        }
      
        $ilanlar=$ilanlar->orderBy('yayin_tarihi', 'DESC')->paginate(5);
        
        if (Request::ajax()) {
            return Response::json(View::make('Firma.ilan.ilanlar',array('ilanlar'=> $ilanlar, 'misafir' => $misafir))->render());
        }
        
        return View::make('Firma.ilan.ilanAra')-> with('ilanlar',$ilanlar)
                ->with('iller', $iller)->with('sektorler',$sektorler)->with('odeme_turleri',$odeme_turleri)
                ->with('teklifler',$teklifler)->with('sektorler',$sektorler)->with('odeme_turleri',$odeme_turleri)
                ->with('ilId',$ilId)->with('keyword',$keyword)->with('sektor_id',$sektor_id)->with('davetEdildigimIlanlar',$davetEdildigimIlanlar)
                ->with('misafir', $misafir);
    
    }

    public function ilanOlustur($firma_id)
    {
        $firma = Firma::find($firma_id);
   
        $ilan = new \App\Ilan();

        if (Gate::denies('createIlan', [$ilan, $firma_id])) {
            return redirect()->intended();
        }

        if (!$ilan)
        
        if (!$ilan->ilan_yapim_isleri)
            $ilan->ilan_yapim_isleri = new App\IlanYapimIsi();

        $sektorler= \App\Sektor::all();
        $maliyetler=  \App\Maliyet::all();
        $odeme_turleri= \App\OdemeTuru::all();
        $para_birimleri= \App\ParaBirimi::all();
        $iller = Il::all();
        $birimler=  \App\Birim::all();

        return view('Firma.ilan.ilanOlustur', ['firma' => $firma])->with('iller',$iller)->with('sektorler',$sektorler)->with('maliyetler',$maliyetler)->with('odeme_turleri',$odeme_turleri)->with('para_birimleri',$para_birimleri)->with('birimler',$birimler)->with('ilan',$ilan);

    }


    public function ilanDuzenle($firmaID,$ilanID){
        $firma = Firma::find($firmaID);
        $ilan = Ilan::find($ilanID);

        /*
         * Ilan ve firma ID gecerli olmalidir ve
         * Kullanici sadece kendi ilanini guncelleyebilir.
         */
        if ($ilan==null || $firma==null || Gate::denies('show', $firma)) {
            return redirect()->intended();
        }

        if (!$ilan->ilan_hizmetler){
            $ilan->ilan_hizmetler = new IlanHizmet();
        }

        if (!$ilan->ilan_mallar)
            $ilan->ilan_mallar = new IlanMal();

        if (!$ilan->ilan_goturu_bedeller)
            $ilan->ilan_goturu_bedeller = new IlanGoturuBedel();

        $goturu_bedel= IlanGoturuBedel::where('ilan_id',$ilan->id)->get();
        Debugbar::info($goturu_bedel);
        if (!$ilan->ilan_yapim_isleri)
            $ilan->ilan_yapim_isleri = new IlanYapimIsi();

        $ilan_sektor = Sektor::find($ilan->ilan_sektor);
        $maliyetler =  Maliyet::all();
        $odeme_turleri = OdemeTuru::all();
        $para_birimleri = ParaBirimi::all();
        $iller = DB::select(DB::raw("SELECT *  FROM  `iller` WHERE adi = 'İstanbul' OR adi =  'İzmir' OR adi =  'Ankara'
                                     UNION SELECT * FROM iller"));
        $birimler =  Birim::all();

        $teklifVarMi=0;
        if($ilan->teklif_hareketler()->limit(1)->paginate()!=null){
            $teklifVarMi=1;
        }

        return view('Firma.ilanDuzenle.index')->with('firma',$firma)->with('iller',$iller)->with('maliyetler',$maliyetler)->with('odeme_turleri',$odeme_turleri)->with('para_birimleri',$para_birimleri)->with('birimler',$birimler)->with('ilan',$ilan)->with('teklifVarMi',$teklifVarMi)->with('ilan_sektor',$ilan_sektor)->with('goturu_bedel',$goturu_bedel);
    }

    public function ilanDuzenleSubmit($firmaID,$ilanID){

        $firma = Firma::find($firmaID);
        $ilan = Ilan::find($ilanID);


        /*
         * Ilan ve firma ID gecerli olmalidir ve
         * Kullanici sadece kendi ilanini guncelleyebilir.
         */
        if ($ilan==null || $firma==null) {
            return false;
        }

        $ilan->adi=Input::get('ilan_adi');
        //$ilan->aciklama="";
        $ilan->katilimcilar= Input::get('katilimcilar');//1 - Onayli tedarikciler | 2 - Belirli Firmalar | 3 - Tum Firmalar
        $ilan->rekabet_sekli= Input::get('rekabet_sekli');//1 - Tam Rekabet | 2 - Sadece Basvuru
        //$ilan->usulu="";//1 - Tam Rekabet | 2 - Belirli Istekliler Arasında | 3 - Sadece Basvuru
        $ilan->kismi_fiyat=Input::get('kismi_fiyat');//1 - Kısmi Fiyat Teklifine Kapalı | 2 - Kısmi Fiyat Teklifine Acik
        $ilan->sozlesme_turu= Input::get('sozlesme_turu');//0 - Birim Fiyatli | 1 - Goturu Bedel
        //$ilan->teknik_sartname="";//pdf dosya
        $ilan->teslim_yeri_satici_firma= Input::get('teslim_yeri');
        if($ilan->teslim_yeri_satici_firma=='Adrese Teslim'){
            $ilan->teslim_yeri_il_id= Input::get('il_id');
            $ilan->teslim_yeri_ilce_id= Input::get('ilce_id');
        }
        else{
            $ilan->teslim_yeri_il_id= null;
            $ilan->teslim_yeri_ilce_id= null;
        }
        $ilan->isin_suresi= Input::get('isin_suresi');
        $ilan->odeme_turu_id=Input::get('odeme_turu');
        $ilan->para_birimi_id=Input::get('para_birimi');
        $ilan->yaklasik_maliyet= Input::get('maliyet');
        $ilan->komisyon_miktari=Input::get('yaklasik_maliyet');
        $ilan->goster = Input::get('firma_adi_goster');//0 - Gizle | 1 - Goster
       // $ilan->statu = 0;//0 - Aktif | 1 - Sonuclanmamis | 2 Pasif

        //ilan tarihi guncelle
        $ilan_tarihi= explode(" - ", Input::get('ilan_tarihi_araligi'));


        $ilan_tarihi_replace1=$ilan_tarihi[0];
        $ilan_tarihi_replace1 = str_replace('/', '-', $ilan_tarihi_replace1);
        $ilan_tarihi_replace2=$ilan_tarihi[1];
        $ilan_tarihi_replace2 = str_replace('/', '-', $ilan_tarihi_replace2);
        $ilan->yayin_tarihi=date('Y-m-d', strtotime($ilan_tarihi_replace1));
        $ilan->kapanma_tarihi= date('Y-m-d', strtotime($ilan_tarihi_replace2));

        //is tarihi guncelle
        $is_tarihi= explode(" - ", Input::get('is_tarihi_araligi'));
        $is_tarihi_replace1=$is_tarihi[0];
        $is_tarihi_replace1 = str_replace('/', '-', $is_tarihi_replace1);
        $is_tarihi_replace2=$is_tarihi[1];
        $is_tarihi_replace2 = str_replace('/', '-', $is_tarihi_replace2);

        $ilan->is_baslama_tarihi= date('Y-m-d', strtotime($is_tarihi_replace1));
        $ilan->is_bitis_tarihi= date('Y-m-d', strtotime($is_tarihi_replace2));


        $ilan->save();

        $upKalemArray = json_decode(Input::get('updatedArray'));
        $upSayac = count($upKalemArray);
        $delKalemArray = json_decode(Input::get('deletedArray'));
        $delSayac = count($delKalemArray);
/*
        if(Input::get('belirli_istekli')!=null){
            foreach(Input::get('belirli_istekli') as $belirli){
                $belirli_istekliler= new BelirlIstekli();
                $belirli_istekliler->ilan_id = $ilan->id;
                $belirli_istekliler->firma_id=$belirli;
                $belirli_istekliler->save();
            }
        }
        if(Input::get('onayli_tedarikciler')!=null){
            foreach(Input::get('onayli_tedarikciler') as $onayli){
                $onayli_tedarikciler= new OnayliTedarikci();
                $onayli_tedarikciler->firma_id = $ilan->firma_id;
                $onayli_tedarikciler->tedarikci_id=$onayli;
                $onayli_tedarikciler->save();
            }
        }
*/
        //kalem bilgileri kaydediliyor ilan türüne ve sözleşme türüne göre.

        if($ilan->sozlesme_turu==1){//GOTURU ILAN TURU

            if($ilan->ilan_turu==1){
                //Varsa Mal Kalemleri Sil
                DB::table('ilan_mallar')->where('ilan_id',$ilan->id)->delete();
            }
            else if($ilan->ilan_turu==2){
                //Varsa Hizmet Kalemleri Sil
                DB::table('ilan_hizmetler')->where('ilan_id',$ilan->id)->delete();
            }
            else{
                //Varsa Yapim Kalemleri Sil
                DB::table('ilan_yapim_isleri')->where('ilan_id',$ilan->id)->delete();
            }

            if(Input::get('kalem_id')=='-1'){
                $goturu= new IlanGoturuBedel();
                $goturu->ilan_id=$ilan->id;
                $goturu->kalem_id=  Input::get('goturu_id');
                $goturu->kalem_adi= Input::get('goturu_kalem');
                $goturu->aciklama=Str::title(strtolower(Input::get('goturu_aciklama')));
                $goturu->miktar=Input::get('goturu_miktar');
                $goturu->miktar_birim_id=Input::get('goturu_miktar_birim_id');
                $goturu->save();
            }
            else{
                $goturu = IlanGoturuBedel::find(Input::get('kalem_id'));
                $goturu->kalem_id=  Input::get('goturu_id');
                $goturu->kalem_adi= Input::get('goturu_kalem');
                $goturu->aciklama=Str::title(strtolower(Input::get('goturu_aciklama')));
                $goturu->miktar=Input::get('goturu_miktar');
                $goturu->miktar_birim_id=Input::get('goturu_miktar_birim_id');
                $goturu->save();
            }



        }
        else if($ilan->ilan_turu==1){//MAL ILAN TURU

            //Varsa goturu bedel siler
            DB::table('ilan_goturu_bedeller')->where('ilan_id',$ilan->id)->delete();

            foreach(Input::get('mal_id') as $malId){
                $arrayMalId[] = $malId;
            }
            foreach(Input::get('mal_kalem') as $malKalem){
                $arrayMalKalem[] = $malKalem;
            }
            foreach(Input::get('mal_marka') as $marka){
                $arrayMarka[] = $marka;
            }
            foreach(Input::get('mal_model') as $model){
                $arrayModel[] = $model;
            }
            foreach(Input::get('mal_aciklama') as $malAciklama){
                $arrayMalAciklama[] = $malAciklama;
            }
            foreach(Input::get('mal_ambalaj') as $ambalaj){
                $arrayAmbalaj[] = $ambalaj;
            }
            foreach(Input::get('mal_miktar') as $miktar){
                $arrayMiktar[] = $miktar;
            }

            foreach(Input::get('mal_birim') as $birim){
                $arrayBirim[] = $birim;
            }

            $x=0;
            //KALEM DELETE
            for ($i=0;$i<count($delKalemArray);$i++){
                DB::table('ilan_mallar')->where('id',$delKalemArray[$i])->delete();
            }

            foreach(Input::get('kalem_id') as $kalem_id){
                if($kalem_id=="-1"){
                    $mal= new IlanMal();
                    $mal->ilan_id=$ilan->id;
                    $mal->kalem_id=$arrayMalId[$x];
                    $mal->kalem_adi=$arrayMalKalem[$x];
                    $mal->marka=Str::title(strtolower($arrayMarka[$x]));
                    $mal->model=Str::title(strtolower($arrayModel[$x]));
                    $mal->aciklama=Str::title(strtolower($arrayMalAciklama[$x]));
                    $mal->ambalaj=Str::title(strtolower($arrayAmbalaj[$x]));
                    $mal->miktar=$arrayMiktar[$x];
                    $mal->birim_id=$arrayBirim[$x];
                    $mal->save();
                }
                else{
                    //KALEM UPDATE
                    if( $upSayac!=0){
                        for ($i=0;$i<count($upKalemArray);$i++){
                            if ($kalem_id==$upKalemArray[$i]){
                                $mal=IlanMal::find($kalem_id);
                                if($mal!=null){
                                    $mal->kalem_id=$arrayMalId[$x];
                                    $mal->kalem_adi=$arrayMalKalem[$x];
                                    $mal->marka=Str::title(strtolower($arrayMarka[$x]));
                                    $mal->model=Str::title(strtolower($arrayModel[$x]));
                                    $mal->aciklama=Str::title(strtolower($arrayMalAciklama[$x]));
                                    $mal->ambalaj=Str::title(strtolower($arrayAmbalaj[$x]));
                                    $mal->miktar=$arrayMiktar[$x];
                                    $mal->birim_id=$arrayBirim[$x];
                                    $mal->save();
                                    $upSayac--;
                                }
                                break;
                            }
                        }
                    }
                }
                $x++;
            }
        }
        else if($ilan->ilan_turu==2){//HIZMET ILAN TURU

            //Varsa goturu bedel siler
            DB::table('ilan_goturu_bedeller')->where('ilan_id',$ilan->id)->delete();

            foreach(Input::get('hizmet_id') as $hizmetId){
                $arrayHizmetId[] = $hizmetId;
            }
            foreach(Input::get('hizmet_kalem') as $hizmetKalem){
                $arrayHizmetKalem[] = $hizmetKalem;
            }
            foreach(Input::get('hizmet_aciklama') as $hizmetAciklama){
                $arrayHizmetAciklama[] = $hizmetAciklama;
            }
            foreach(Input::get('hizmet_fiyat_standardi') as $hfs){
                $arrayHfs[] = $hfs;
            }
            foreach(Input::get('hizmet_fiyat_standardi_birimi') as $hfsb){
                $arrayHfsb[] = $hfsb;
            }
            foreach(Input::get('hizmet_miktar') as $hizmetMiktar){
                $arrayHizmetMiktar[] = $hizmetMiktar;
            }
            foreach(Input::get('hizmet_miktar_birim_id') as $hmb){
                $arrayHmb[] = $hmb;
            }

            $x=0;
            //KALEM DELETE
            for ($i=0;$i<count($delKalemArray);$i++){
                    DB::table('ilan_hizmetler')->where('id',$delKalemArray[$i])->delete();
            }

            foreach(Input::get('kalem_id') as $kalem_id){
                if($kalem_id=="-1"){
                    $hizmet= new IlanHizmet();
                    $hizmet->ilan_id=$ilan->id;
                    $hizmet->kalem_id= $arrayHizmetId[$x];
                    $hizmet->kalem_adi= $arrayHizmetKalem[$x];
                    $hizmet->aciklama=Str::title(strtolower($arrayHizmetAciklama[$x]));
                    $hizmet->fiyat_standardi=Str::title(strtolower($arrayHfs[$x]));
                    $hizmet->fiyat_standardi_birim_id=$arrayHfsb[$x];
                    $hizmet->miktar=$arrayHizmetMiktar[$x];
                    $hizmet->miktar_birim_id=$arrayHmb[$x];
                    $hizmet->save();
                }
                else{
                    //KALEM UPDATE
                    if( $upSayac!=0){
                        for ($i=0;$i<count($upKalemArray);$i++){
                            if ($kalem_id==$upKalemArray[$i]){
                                $hizmet=IlanHizmet::find($kalem_id);
                                if($hizmet!=null){
                                    $hizmet->kalem_id= $arrayHizmetId[$x];
                                    $hizmet->kalem_adi= $arrayHizmetKalem[$x];
                                    $hizmet->aciklama=Str::title(strtolower($arrayHizmetAciklama[$x]));
                                    $hizmet->fiyat_standardi=Str::title(strtolower($arrayHfs[$x]));
                                    $hizmet->fiyat_standardi_birim_id=$arrayHfsb[$x];
                                    $hizmet->miktar=$arrayHizmetMiktar[$x];
                                    $hizmet->miktar_birim_id=$arrayHmb[$x];
                                    $hizmet->save();
                                    $upSayac--;
                                }
                                break;
                            }
                        }
                    }
                }
                $x++;
            }
        }
        else if($ilan->ilan_turu==3){ //YAPIM ISI ILAN TURU

            //Varsa goturu bedel siler
            DB::table('ilan_goturu_bedeller')->where('ilan_id',$ilan->id)->delete();

            foreach(Input::get('yapim_id') as $yapimId){
                $arrayYapimId[] = $yapimId;
            }
            foreach(Input::get('yapim_kalem') as $yapimKalem){
                $arrayYapimKalem[] = $yapimKalem;
            }
            foreach(Input::get('yapim_aciklama') as $yapimAciklama){
                $arrayYapimAciklama[] = $yapimAciklama;
            }
            foreach(Input::get('yapim_fiyat_standardi') as $yfs){
                $arrayYfs[] = $yfs;
            }
            foreach(Input::get('yapim_fiyat_standardi_birimi') as $yfsb){
                $arrayYfsb[] = $yfsb;
            }
            foreach(Input::get('yapim_miktar') as $yapimMiktar){
                $arrayYapimMiktar[] = $yapimMiktar;
            }
            foreach(Input::get('yapim_miktar_birim_id') as $ymb){
                $arrayYmb[] = $ymb;
            }

            $x=0;
            //KALEM DELETE
            for ($i=0;$i<count($delKalemArray);$i++){
                DB::table('ilan_yapim_isleri')->where('id',$delKalemArray[$i])->delete();
            }

            foreach(Input::get('kalem_id') as $kalem_id){
                if($kalem_id=="-1"){
                    $yapim= new IlanYapimIsi();
                    $yapim->ilan_id=$ilan->id;
                    $yapim->kalem_id= $arrayYapimId[$x];
                    $yapim->kalem_adi=  $arrayYapimKalem[$x];
                    $yapim->aciklama=Str::title(strtolower( $arrayYapimAciklama[$x]));
                    $yapim->fiyat_standardi=Str::title(strtolower($arrayYfs[$x]));
                    $yapim->fiyat_standardi_birimi_id=$arrayYfsb[$x];
                    $yapim->miktar=$arrayYapimMiktar[$x];
                    $yapim->birim_id=$arrayYmb[$x];
                    $yapim->save();
                }
                else{
                    //KALEM UPDATE
                    if( $upSayac!=0){
                        for ($i=0;$i<count($upKalemArray);$i++){
                            if ($kalem_id==$upKalemArray[$i]){
                                $yapim=IlanYapimIsi::find($kalem_id);
                                if($yapim!=null){
                                    $yapim->kalem_id= $arrayYapimId[$x];
                                    $yapim->kalem_adi=  $arrayYapimKalem[$x];
                                    $yapim->aciklama=Str::title(strtolower( $arrayYapimAciklama[$x]));
                                    $yapim->fiyat_standardi=Str::title(strtolower($arrayYfs[$x]));
                                    $yapim->fiyat_standardi_birimi_id=$arrayYfsb[$x];
                                    $yapim->miktar=$arrayYapimMiktar[$x];
                                    $yapim->birim_id=$arrayYmb[$x];
                                    $yapim->save();
                                    $upSayac--;
                                }
                                break;
                            }
                        }
                    }
                }
                $x++;
            }
        }


        DebugBar::info($upKalemArray);
        DebugBar::info($delKalemArray);
        DebugBar::info(Input::get('ilan_adi'));
    }

    //TODO: test et
    public function ilanOlusturEkle(Request $request, $firma_id)
    {
        //ilan bilgileri kaydediliyor.
        
        $firma = Firma::find($firma_id);
        $ilan = new Ilan;
        $ilan->adi=Str::title(strtolower( $request->ilan_adi));
        $ilan->ilan_sektor=$request->firma_sektor;
        
        $ilan_tarihi= explode(" - ", $request->ilan_tarihi_araligi);
        DebugBar::info($ilan_tarihi);
        
        $ilan_tarihi_replace1=$ilan_tarihi[0];
        $ilan_tarihi_replace1 = str_replace('/', '-', $ilan_tarihi_replace1);
        $ilan_tarihi_replace2=$ilan_tarihi[1];
        $ilan_tarihi_replace2 = str_replace('/', '-', $ilan_tarihi_replace2);
        
        DebugBar::info(date('Y-m-d', strtotime($ilan_tarihi_replace1)));
        DebugBar::info(date('Y-m-d', strtotime($ilan_tarihi_replace2)));
         
        $ilan->yayin_tarihi=date('Y-m-d', strtotime($ilan_tarihi_replace1));
        $ilan->kapanma_tarihi= date('Y-m-d', strtotime($ilan_tarihi_replace2));
       
        
        $is_tarihi= explode(" - ", $request->is_tarihi_araligi);
        DebugBar::info($is_tarihi);
        
        $is_tarihi_replace1=$is_tarihi[0];
        $is_tarihi_replace1 = str_replace('/', '-', $is_tarihi_replace1);
        $is_tarihi_replace2=$is_tarihi[1];
        $is_tarihi_replace2 = str_replace('/', '-', $is_tarihi_replace2);
        
        
        $ilan->is_baslama_tarihi= date('Y-m-d', strtotime($is_tarihi_replace1));
        DebugBar::info(date('Y-m-d', strtotime($is_tarihi_replace1)));
        
        $ilan->is_bitis_tarihi= date('Y-m-d', strtotime($is_tarihi_replace2));
        DebugBar::info(date('Y-m-d', strtotime($is_tarihi_replace2)));
        
        $ilan->aciklama =Str::title(strtolower( $request->aciklama));
        $ilan->ilan_turu= $request->ilan_turu;
        $ilan->katilimcilar= $request->katilimcilar;
        $ilan->rekabet_sekli= $request->rekabet_sekli;
        $ilan->sozlesme_turu= $request->sozlesme_turu;
        $ilan->odeme_turu_id=$request->odeme_turu;
        $ilan->para_birimi_id=$request->para_birimi;
        $ilan->kismi_fiyat=$request->kismi_fiyat;
        $ilan->yaklasik_maliyet= $request->maliyet;
        $ilan->komisyon_miktari=$request->yaklasik_maliyet;
        $ilan->teslim_yeri_satici_firma= $request->teslim_yeri;
        $ilan->teslim_yeri_il_id= $request->il_id;
        $ilan->teslim_yeri_ilce_id= $request->ilce_id;
        $ilan->isin_suresi= $request->isin_suresi;
        
        $ilan->adi= $request->ilan_adi;
        $ilan->sozlesme_onay= $request->sozlesme_onay;
        //foreach($request->firma_adi_gizli as $firma_adi_gizli){
          $ilan->goster = $request->firma_adi_goster;
        //}
        if($request->file('teknik'))
        {
          $file = $request->file('teknik');
          $file = array('teknik' => $request->file('teknik'));
          $destinationPath = 'Teknik';
          $extension = $request->file('teknik')->getClientOriginalExtension();
          $fileName = rand(11111, 99999) . '.' . $extension;
          $ilan->teknik_sartname = $fileName;
          $request->file('teknik')->move($destinationPath, $fileName);
          Session::flash('success', 'Upload successfully');

        }
        $ilan->statu = 0;

        $firma->ilanlar()->save($ilan);

        if($request->belirli_istekli!=null){
          foreach($request->belirli_istekli as $belirli){
            $belirli_istekliler= new \App\BelirlIstekli();
            $belirli_istekliler->ilan_id = $ilan->id;
            $belirli_istekliler->firma_id=$belirli;
            $belirli_istekliler->save();
          }
        }
         if($request->onayli_tedarikciler!=null){
          foreach($request->onayli_tedarikciler as $onayli){
            $onayli_tedarikciler= new App\OnayliTedarikci();
            $onayli_tedarikciler->firma_id = $ilan->firma_id;
            $onayli_tedarikciler->tedarikci_id=$onayli;
            $onayli_tedarikciler->save();
          }
        }
        
        //kalem bilgileri kaydediliyor ilan türüne ve sözleşme türüne göre.
        if($ilan->ilan_turu==1 && $ilan->sozlesme_turu==0){
            
            foreach($request->mal_id as $malId){
                  $arrayMalId[] = $malId;
            }
            foreach($request->mal_kalem as $malKalem){
                  $arrayMalKalem[] = $malKalem;
            }
            foreach($request->mal_marka as $marka){
                  $arrayMarka[] = $marka;
            }
            foreach($request->mal_model as $model){
                  $arrayModel[] = $model;
            }
            foreach($request->mal_aciklama as $malAciklama){
                  $arrayMalAciklama[] = $malAciklama;
            }
            foreach($request->mal_ambalaj as $ambalaj){
                  $arrayAmbalaj[] = $ambalaj;
            }
            foreach($request->mal_miktar as $miktar){
                  $arrayMiktar[] = $miktar;
            }
            
            foreach($request->mal_birim as $birim){
                  $arrayBirim[] = $birim;
            }
           
            $i=0;
              foreach($request->mal_kalem as $malKalem){
                $mal= new \App\IlanMal();
                $mal->ilan_id=$ilan->id;
                $mal->kalem_id=$arrayMalId[$i];
                $mal->kalem_adi=$arrayMalKalem[$i];
                $mal->marka=Str::title(strtolower($arrayMarka[$i]));
                $mal->model=Str::title(strtolower($arrayModel[$i]));
                $mal->aciklama=Str::title(strtolower($arrayMalAciklama[$i]));
                $mal->ambalaj=Str::title(strtolower($arrayAmbalaj[$i]));
                $mal->miktar=$arrayMiktar[$i];
                $mal->birim_id=$arrayBirim[$i];
                $mal->save();
                $i++;
              }
        }
        else if($ilan->ilan_turu==2 && $ilan->sozlesme_turu==0){
          
            
            foreach($request->hizmet_id as $hizmetId){
                  $arrayHizmetId[] = $hizmetId;
            }
            foreach($request->hizmet_kalem as $hizmetKalem){
                  $arrayHizmetKalem[] = $hizmetKalem;
            }
            foreach($request->hizmet_aciklama as $hizmetAciklama){
                  $arrayHizmetAciklama[] = $hizmetAciklama;
            }
            foreach($request->hizmet_fiyat_standardi as $hfs){
                  $arrayHfs[] = $hfs;
            }
            foreach($request->hizmet_fiyat_standardi_birimi as $hfsb){
                  $arrayHfsb[] = $hfsb;
            }
            foreach($request->hizmet_miktar as $hizmetMiktar){
                  $arrayHizmetMiktar[] = $hizmetMiktar;
            }
            foreach($request->hizmet_miktar_birim_id as $hmb){
                  $arrayHmb[] = $hmb;
            }
           
            $i=0;
              foreach($request->hizmet_kalem as $hizmetKalem){
                $hizmet= new \App\IlanHizmet();
                $hizmet->ilan_id=$ilan->id;
                $hizmet->kalem_id= $arrayHizmetId[$i];
                $hizmet->kalem_adi= $arrayHizmetKalem[$i];
                $hizmet->aciklama=Str::title(strtolower($arrayHizmetAciklama[$i]));
                $hizmet->fiyat_standardi=Str::title(strtolower($arrayHfs[$i]));
                $hizmet->fiyat_standardi_birim_id=$arrayHfsb[$i];
                $hizmet->miktar=$arrayHizmetMiktar[$i];
                $hizmet->miktar_birim_id=$arrayHmb[$i];
                $hizmet->save();
                $i++;
              } 
        }
         else if($ilan->sozlesme_turu==1){
             
            foreach($request->goturu_id as $goturuId){
                  $arrayGoturuId[] = $goturuId;
            }
            foreach($request->goturu_kalem as $goturuKalem){
                  $arrayGooturuKalem[] = $goturuKalem;
            }
            foreach($request->goturu_aciklama as $goturuAciklama){
                  $arrayGoturuAciklama[] = $goturuAciklama;
            }
            foreach($request->goturu_miktar as $goturuMiktar){
                  $arrayGoturuMiktar[] = $goturuMiktar;
            }
            foreach($request->goturu_miktar_birim_id as $gmb){
                  $arrayGmb[] = $gmb;
            }
            $i=0;
              foreach($request->goturu_kalem as $goturuKalem){
                $goturu= new \App\IlanGoturuBedel();
                $goturu->ilan_id=$ilan->id;
                $goturu->kalem_id=  $arrayGoturuId[$i];
                $goturu->kalem_adi= $arrayGooturuKalem[$i];
                $goturu->aciklama=Str::title(strtolower($arrayGoturuAciklama[$i]));
                $goturu->miktar=$arrayGoturuMiktar[$i];
                $goturu->miktar_birim_id=$arrayGmb[$i];
                $goturu->save();
                $i++;
              } 
         }
         else if($ilan->ilan_turu==3){
             
             foreach($request->yapim_id as $yapimId){
                  $arrayYapimId[] = $yapimId;
            }
            foreach($request->yapim_kalem as $yapimKalem){
                  $arrayYapimKalem[] = $yapimKalem;
            }
            foreach($request->yapim_aciklama as $yapimAciklama){
                  $arrayYapimAciklama[] = $yapimAciklama;
            }
            foreach($request->yapim_fiyat_standardi as $yfs){
                  $arrayYfs[] = $yfs;
            }
            foreach($request->yapim_fiyat_standardi_birimi as $yfsb){
                  $arrayYfsb[] = $yfsb;
            }
            foreach($request->yapim_miktar as $yapimMiktar){
                  $arrayYapimMiktar[] = $yapimMiktar;
            }
            foreach($request->yapim_miktar_birim_id as $ymb){
                  $arrayYmb[] = $ymb;
            }
           
            $i=0;
              foreach($request->yapim_kalem as $yapimKalem){
                $yapim= new \App\IlanYapimIsi();
                $yapim->ilan_id=$ilan->id;
                $yapim->kalem_id= $arrayYapimId[$i];
                $yapim->kalem_adi=  $arrayYapimKalem[$i];
                $yapim->aciklama=Str::title(strtolower( $arrayYapimAciklama[$i]));
                $yapim->fiyat_standardi=Str::title(strtolower($arrayYfs[$i]));
                $yapim->fiyat_standardi_birimi_id=$arrayYfsb[$i];
                $yapim->miktar=$arrayYapimMiktar[$i];
                $yapim->birim_id=$arrayYmb[$i];
                $yapim->save();
                $i++;
              } 
             
         }
         return Redirect::to('ilanlarim/'.$firma->id);
      
    }

    public function ilanlarim($firmaId)
    {
        $firma = Firma::find($firmaId);
        $model_ilanlar=  Ilan::all();
        if (Gate::denies('show', $firma)) {
            return Redirect::to('/');
        }

        $aktif_ilanlar= Ilan::where('firma_id',$firma->id)->where('statu',0)->get();

        $aktif_count= $aktif_ilanlar->count();


        $ilanlarım = $firma->ilanlar()->orderBy('kapanma_tarihi','desc')->get();
        $sonuc_ilanlar= Ilan::where('firma_id',$firma->id)->where('statu',1)->get();
        $sonuc_kapali = $sonuc_ilanlar->count();
        $kazananFiyat=0;

        $pasif_ilanlar = \App\Ilan::where('firma_id',$firma->id)->where('statu',2)->get();


        return view('Firma.ilan.ilanlarim')->with('firma', $firma)->with('aktif_ilanlar', $aktif_ilanlar)->with('aktif_count', $aktif_count)->with('ilanlarım', $ilanlarım)
                ->with('sonuc_kapali', $sonuc_kapali)->with('sonuc_ilanlar', $sonuc_ilanlar)->with('model_ilanlar', $model_ilanlar)
                ->with('kazananFiyat', $kazananFiyat)->with('pasif_ilanlar',$pasif_ilanlar);
    }

    //TODO: başvuru fonksiyonlarının IlanController'da olması gerektiğini onayla
    public function basvurularim($firma_id)
    {
        $firma = Firma::find($firma_id);

        if (Gate::denies('show', $firma)) {
            return Redirect::to('/');
        }

        $basvurular = DB::select(DB::raw("SELECT *
                            FROM teklif_hareketler th1
                            JOIN (
                            SELECT teklif_id, t.ilan_id AS ilanId, MAX( tarih ) tarih
                            FROM teklifler t, teklif_hareketler th
                            WHERE t.id = th.teklif_id
                            AND t.firma_id ='$firma->id'
                            GROUP BY th.teklif_id
                            )th2 ON th1.teklif_id = th2.teklif_id
                            AND th1.tarih = th2.tarih ORDER BY th2.tarih DESC "));
        $basvurular_count = DB::select(DB::raw("SELECT count(th1.id) as count
                            FROM teklif_hareketler th1
                            JOIN (
                            SELECT teklif_id, t.ilan_id AS ilanId, MAX( tarih ) tarih
                            FROM teklifler t, teklif_hareketler th
                            WHERE t.id = th.teklif_id
                            AND t.firma_id ='$firma->id'
                            GROUP BY th.teklif_id
                            )th2 ON th1.teklif_id = th2.teklif_id
                            AND th1.tarih = th2.tarih ORDER BY th2.tarih DESC "));
        $kazananKismi = \App\KismiAcikKazanan::where('kazanan_firma_id',$firma->id)->get();
        $kazananKismiCount= $kazananKismi->count();

        $kazananKapali = \App\KismiKapaliKazanan::where('kazanan_firma_id',$firma->id)->get();
        $kazananKismiCount = $kazananKismiCount +($kazananKapali->count());
        $teklifler=  \App\Teklif::all();
        //$kullanici = App\Kullanici::find($kul_id);
        $detaylar = \App\MalTeklif::all();
        return view('Firma.ilan.basvurularim')->with('firma', $firma)->with('teklifler', $teklifler)->with('detaylar', $detaylar)
            ->with('basvurular', $basvurular)->with('basvurular_count', $basvurular_count)
            ->with('kazananKismi', $kazananKismi)->with('kazananKapali', $kazananKapali)->with('kazananKismiCount', $kazananKismiCount);

    }

    public function davetEdildigimIlanlar ()
    {
        $firma=Firma::find(session()->get('firma_id'));
        return view('Firma.ilan.davetEdildigimIlanlar')->with('firma', $firma);
    }

    public function teklifGonder ($firma_id,$ilan_id,$kullanici_id,Request $request) {

        if (Gate::denies('teklifGonder', [\App\Ilan::find($ilan_id), $firma_id])) {
            abort(403, 'Kullanıcı rolü teklif vermeye uygun değil.');
        }

        DB::beginTransaction();
        try {
            $now = new Carbon();//tarih

            $ilan=  Ilan::find($ilan_id);
            $teklifExist = Teklif::where('firma_id',$firma_id)->where('ilan_id',$ilan_id)->get();
            $teklifExist=$teklifExist->toArray();
            if($teklifExist != null ){
                $id = $teklifExist[0]['id'];
            }
            else{
                $id=0;
            }
            $teklif = Teklif::find($id);
            if($teklifExist == null ){
                $teklif = new \App\Teklif;
                $teklif->firma_id =$firma_id;
                $teklif->ilan_id = $ilan_id;
                $teklif->save();
            }
            $kdvsizFiyatToplam=0;
            $arrayFiyat = Array();
            $arrayKdv = Array();

            foreach($request->kdv as $kdv){
                $arrayKdv[] = $kdv;
            }
            foreach($request->birim_fiyat as $birimFiyat){
                $arrayFiyat[] = $birimFiyat;
                Debugbar::info($birimFiyat);
            }
            if($ilan->ilan_turu == 1 && $ilan->sozlesme_turu == 0){
                $i=0;
                foreach($request->ilan_mal_id as $id){
                    $ilan_mal= \App\IlanMal::find($id);
                    $ilan_mal_teklifler = new App\MalTeklif;
                    $ilan_mal_teklifler-> ilan_mal_id = $ilan_mal->id;
                    $ilan_mal_teklifler-> teklif_id = $teklif->id;
                    if($arrayKdv[$i] == -1){
                        $i++;
                        continue;
                    }
                    $ilan_mal_teklifler->kdv_dahil_fiyat = $arrayFiyat[$i] * ($ilan_mal->miktar)*(1+$arrayKdv[$i]/100);
                    $ilan_mal_teklifler->kdv_orani = $arrayKdv[$i];
                    $ilan_mal_teklifler->kdv_haric_fiyat = $arrayFiyat[$i];
                    $ilan_mal_teklifler->tarih= $now;
                    $ilan_mal_teklifler->para_birimleri_id=$ilan->para_birimi_id;
                    $ilan_mal_teklifler->kullanici_id=$kullanici_id;
                    $ilan_mal_teklifler->save();
                    $kdvsizFiyatToplam = $kdvsizFiyatToplam + ($arrayFiyat[$i]*$ilan_mal->miktar);
                    $i++;
                }
            }elseif ($ilan->ilan_turu == 2 && $ilan->sozlesme_turu == 0) {
                $i=0;
                foreach($request->ilan_hizmet_id as $id){
                    $ilan_hizmet= \App\IlanHizmet::find($id);
                    $ilan_hizmet_teklifler = new App\HizmetTeklif;
                    $ilan_hizmet_teklifler-> ilan_hizmet_id = $ilan_hizmet->id;
                    $ilan_hizmet_teklifler-> teklif_id = $teklif->id;
                    if($arrayKdv[$i] == -1){
                        $i++;
                        continue;
                    }
                    $ilan_hizmet_teklifler->kdv_dahil_fiyat = $arrayFiyat[$i] * ($ilan_hizmet->miktar)*(1+$arrayKdv[$i]/100);
                    $ilan_hizmet_teklifler->kdv_orani = $arrayKdv[$i];
                    $ilan_hizmet_teklifler->kdv_haric_fiyat=$arrayFiyat[$i];
                    $ilan_hizmet_teklifler->tarih= $now;
                    $ilan_hizmet_teklifler->para_birimleri_id=$ilan->para_birimi_id;
                    $ilan_hizmet_teklifler->kullanici_id=$kullanici_id;
                    $ilan_hizmet_teklifler->save();
                    $i++;
                }

            }elseif($ilan->sozlesme_turu == 1){

                $i=0;
                foreach($request->ilan_goturu_bedel_id as $id){
                    $ilan_goturu = \App\IlanGoturuBedel::find($id);
                    $ilan_goturu_teklifler = new App\GoturuBedelTeklif;
                    $ilan_goturu_teklifler-> ilan_goturu_bedel_id = $ilan_goturu->id;
                    $ilan_goturu_teklifler-> teklif_id = $teklif->id;
                    if($arrayKdv[$i] == -1){
                        $i++;
                        continue;
                    }
                    $ilan_goturu_teklifler->kdv_dahil_fiyat =$arrayFiyat[$i] * ($ilan_goturu->miktar)*(1+$arrayKdv[$i]/100);
                    $ilan_goturu_teklifler->kdv_orani =$arrayKdv[$i];
                    $ilan_goturu_teklifler->kdv_haric_fiyat=$arrayFiyat[$i];
                    $ilan_goturu_teklifler->tarih=$now;
                    $ilan_goturu_teklifler->para_birimleri_id=$ilan->para_birimi_id;
                    $ilan_goturu_teklifler->kullanici_id=$kullanici_id;
                    $ilan_goturu_teklifler->save();
                    $kdvsizFiyatToplam = $kdvsizFiyatToplam + ($arrayFiyat[$i]*$ilan_goturu->miktar);
                    $i++;
                }

            }else{
                $i=0;
                foreach($request->ilan_yapim_isi_id as $id){
                    $ilan_yapim = \App\IlanYapimIsi::find($id);
                    $ilan_yapim_teklifler = new App\YapimIsiTeklif;
                    $ilan_yapim_teklifler-> ilan_yapim_isleri_id = $ilan_yapim->id;
                    $ilan_yapim_teklifler-> teklif_id = $teklif->id;
                    if($arrayKdv[$i] == -1){
                        $i++;
                        continue;
                    }
                    $ilan_yapim_teklifler->kdv_dahil_fiyat = $arrayFiyat[$i] * ($ilan_yapim->miktar)*(1+$arrayKdv[$i]/100);
                    $ilan_yapim_teklifler->kdv_orani = $arrayKdv[$i];
                    $ilan_yapim_teklifler->kdv_haric_fiyat=$arrayFiyat[$i];
                    $ilan_yapim_teklifler->tarih= $now;
                    $ilan_yapim_teklifler->para_birimleri_id=$ilan->para_birimi_id;
                    $ilan_yapim_teklifler->kullanici_id=$kullanici_id;
                    $ilan_yapim_teklifler->save();
                    $i++;
                }
            }
            //$firma_kullanici = \App\FirmaKullanici::where('kullanici_id',$kullanici_id)->where('firma_id',$firma_id)->select('firma_kullanicilar.id')->get();
            $teklifHareket = new App\TeklifHareket;
            $teklifHareket->kdv_haric_fiyat=$request->toplamFiyatKdvsiz;
            $teklifHareket->kdv_dahil_fiyat=$request->toplamFiyat;
            $teklifHareket->para_birimleri_id=$ilan->para_birimi_id;
            $teklifHareket->tarih = $now;
            $teklifHareket->kullanici_id=$kullanici_id;
            $teklifHareket->iskonto_orani=$request->iskontoVal;
            $teklifHareket->iskontolu_kdvli_fiyat=$request->iskontoluToplamFiyatKdvli;
            $teklifHareket->iskontolu_kdvsiz_fiyat=$request->iskontoluToplamFiyatKdvsiz;
            $teklif->teklif_hareketler()->save($teklifHareket);

            DB::commit();
            return Response::json("başarılı");
            // all good
        } catch (\Exception $e) {
            $error="error";
            DB::rollback();
            return Response::json($error);
        }
    }
}
