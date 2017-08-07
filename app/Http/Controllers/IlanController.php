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
        $this->middleware('firmaYetkili');
    }
    //
    public function showIlan(){
        $dt = Carbon::now();
        $dt->toDateString();  
        $iller = Il::all();
        $firma=  Firma::all();
        $sektorler= Sektor::all();
        $odeme_turleri= OdemeTuru::all();
        $teklifler= \App\Teklif::all();
        if(session()->get('firma_id') == null){ 
            $sektor_id = 0;
            $davetEdildigimIlanlar = null;
        }else{
            $fId = session()->get('firma_id');
            $firmaSektor = Firma::find($fId);
            foreach($firmaSektor->sektorler as $sektor){
                        $sektor_id = $sektor->id;
            }
            $davetEdildigimIlanlar = BelirlIstekli::where('firma_id',$fId)->get();
        }
        $ilanlar = Ilan::join('firmalar', 'ilanlar.firma_id', '=', 'firmalar.id')
                ->join('adresler', 'adresler.firma_id', '=', 'firmalar.id')
                ->join('iller', 'adresler.il_id', '=', 'iller.id')
                ->where('adresler.tur_id', '=' , 1)
                ->where('ilanlar.yayin_tarihi', '<=' , $dt->today())
                ->where('ilanlar.kapanma_tarihi', '>=' , $dt->today())
                ->orderBy('ilanlar.yayin_tarihi', 'DESC')
                ->select('ilanlar.id as ilan_id','ilanlar.adi as ilanadi', 'ilanlar.*','firmalar.id as firmaid', 'firmalar.*','adresler.id as adresid','adresler.*','iller.adi as iladi'); 
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
                $sektorler = Sektor::all();
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
            /*$ilanlar->where(function ($query) use ($sektor_id,$keyword) {
                        Debugbar::info("girdi keyword");
                        $query->where('ilanlar.adi' ,$keyword )
                                ->orWhere('firmalar.adi',$keyword )
                                ->orWhere('ilanlar.ilan_sektor',$sektor_id);
                        });*/
             
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
      
        
        $ilanlar=$ilanlar->paginate(5);
        
        if (Request::ajax()) {
            return Response::json(View::make('Firma.ilan.ilanlar',array('ilanlar'=> $ilanlar))->render());
        }
        
        return View::make('Firma.ilan.ilanAra')-> with('ilanlar',$ilanlar)
                ->with('iller', $iller)->with('sektorler',$sektorler)->with('odeme_turleri',$odeme_turleri)
                ->with('firma',$firma)->with('teklifler',$teklifler)->with('sektorler',$sektorler)->with('odeme_turleri',$odeme_turleri)
                ->with('ilId',$ilId)->with('keyword',$keyword)->with('sektor_id',$sektor_id)->with('davetEdildigimIlanlar',$davetEdildigimIlanlar);
    
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

    public function davetEdildigimIlanlar ($firma_id)
    {
        $firma=Firma::find($firma_id);
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
