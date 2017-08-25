<?php
namespace App\Http\Controllers;
use App\Firma;
use App\Sektor;
use App\Il;
use App\IletisimBilgisi;
use App\Adres;
use App\SirketTuru;
use App\TicariBilgi;
use App\TicaretOdasi;
use App\FirmaSatilanMarka;
use App\Ilce;
use App\Semt;
use Input;
use Session;
use File;
use Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\OnayliTedarikci;
use Barryvdh\Debugbar\Facade as Debugbar;
//use Illuminate\Http\Request;
//use App\Http\Requests;
use Response;
use Illuminate\Support\Str;
use DB;
use Request;
use View;

class FirmaController extends Controller
{
    public function __construct()
    {
        $this->middleware('firmaYetkili', ['except' => ['showFirma']]);
        $this->middleware('auth',['only'=>['showFirma']]);
    }

    /*public function properFunc($string){

        $proper=Str::title(strtolower($string));
        return response($proper);
    }*/


     public function showFirma(){
        $firma = Firma::find(session()->get('firma_id'));

        if (Gate::denies('show', $firma)) {
            return Redirect::to('/');
        }

        $firmaSektorleri=$firma->sektorler()->get();

        $firmaFatura = $firma->adresler()->where('tur_id', '=', '2')->first();
        if (!$firmaFatura) {
               $firmaFatura = new Adres();
               $firmaFatura->iller = new Il();
               $firmaFatura->ilceler = new Ilce();
               $firmaFatura->semtler = new Semt();
        }
        $firmaAdres = $firma->adresler()->where('tur_id', '=', '1')->first();
        if (!$firmaAdres) {
               $firmaAdres = new Adres();
               $firmaAdres->iller = new Il();
               $firmaAdres->ilceler = new Ilce();
               $firmaAdres->semtler = new Semt();
        }
        if (!$firma->ticari_bilgiler) {
                $firma->ticari_bilgiler = new TicariBilgi();
                $firma->ticari_bilgiler->ticaret_odalari = new TicaretOdasi();
                $firma->ticari_bilgiler->sektorler = new Sektor();
        }
         if (!$firma->kalite_belgeleri) {
                      $firma->firma_kalite_belgeleri = new App\FirmaKaliteBelgesi();
        }
        if (!$firma->firma_referanslar) {
           $firma->firma_referanslar = new App\FirmaReferans();
        } else {
           $firmaReferanslar = $firma->firma_referanslar()->orderBy('ref_turu', 'desc')->orderBy('is_yili', 'desc')->get();
        }
        if (!$firma->firma_brosurler) {
                 $firma->firma_brosurler = new App\FirmaBrosur();
        }
        if (!$firma->firma_calisma_bilgileri) {
               $firma->firma_calisma_bilgileri = new \App\FirmaCalismaBilgisi();
               $calismaGunu = '';
        } else{
               $calismaGunu = $firma->firma_calisma_bilgileri->calisma_gunleri->adi;
        }
        $calisan= DB::table('firma_calisma_bilgileri')->where('firma_id', $firma->id)->count();
        $brosur=DB::table('firma_brosurler')->where('firma_id',$firma->id )->count();
        $referans= DB::table('firma_referanslar')->where('firma_id', $firma->id)->count();
        $uretilenMarka = DB::table('uretilen_markalar')->where('firma_id', '=', $firma->id)->get();
        $satilanMarka = FirmaSatilanMarka::where('firma_id', '=', $firma->id)->get();
        $kaliteBelge= DB::table('firma_kalite_belgeleri')->where('firma_id', $firma->id)->count();
        $iller = Il::all();
        $sirketTurleri=  SirketTuru::all();
        $vergiDaireleri= \App\VergiDairesi::all();
        $ticaretodasi=  \App\TicaretOdasi::all();
        $ustsektor=  Sektor::all();
        $departmanlar=  \App\Departman::all();
        $faaliyetler= \App\Faaliyet::all();
        $kalite_belgeleri= \App\KaliteBelgesi::all();
        $calisma_günleri= \App\CalismaGunu::all();
        return view('Firma.firmaProfili', ['firma' => $firma], ['iller' => $iller])->with('sirketTurleri',$sirketTurleri)
                ->with('vergiDaireleri',$vergiDaireleri)->with('ustsektor',$ustsektor)
                ->with('ticaretodasi',$ticaretodasi)->with('departmanlar',$departmanlar)
                ->with('faaliyetler',$faaliyetler)->with('kalite_belgeleri',$kalite_belgeleri)
                ->with('calisma_günleri',$calisma_günleri)->with('firmaFatura',$firmaFatura)->with('firmaAdres',$firmaAdres)
                ->with('uretilenMarka',$uretilenMarka)->with('satilanMarka',$satilanMarka)->with('kaliteBelge',$kaliteBelge)
                ->with('firmaReferanslar',$firmaReferanslar)->with('referans',$referans)->with('brosur',$brosur)
                ->with('calismaGunu',$calismaGunu)->with('calisan',$calisan)->with('firmaSektorleri',$firmaSektorleri);
    }

    public function firmaDetay($firma_id)
    {    
        $firma=Firma::where('id', $firma_id)->with([
            'firma_satilan_markalar',
            'uretilen_markalar',
            'adresler' => function($query) use ($firma_id){
            $query->where('tur_id', '1')->union(DB::table('adresler')->where('firma_id', $firma_id)->where('tur_id', '2'))->orderBy('tur_id', 'ASC');
            },
            'adresler.iller',
            'adresler.ilceler',
            'adresler.semtler',
            'mali_bilgiler',
            'ticari_bilgiler',
            'departmanlar',
            'faaliyetler',
            'sirket_turleri',
            'kalite_belgeleri',
            'firma_referanslar' => function($query){$query->orderBy('ref_turu', 'desc')->orderBy('is_yili', 'desc');},
            'firma_brosurler',
            'firma_calisma_bilgileri'
        ])->first();

        //yorumlar ve puanlar arasında eloquent ilişkisi olmadığı için query builder.
        $yorumlar = DB::table('yorumlar')->where('yorumlar.firma_id', $firma_id)->orderBy('yorumlar.tarih', 'DESC')
        ->join('puanlamalar', 'yorumlar.firma_id', '=', 'puanlamalar.firma_id')
        ->join('firmalar', 'yorumlar.yorum_yapan_firma_id', '=', 'firmalar.id')//firma isimleri için
        ->get();
    
        if (!$firma)
            abort('404');
    
        return view('Firma.firmaDetay')->with(['firma'=>$firma, 'yorumlar'=>$yorumlar]);
    }

    public function uyelikBilgileri()
    {
        $firma = Firma::where('id', session()->get('firma_id'))->with([
            'odemeler'
        ])->first();

        return view('Firma.uyelikBilgileri', ['firma' => $firma]);
    }

    public function showFirmalar(){
        $firma_id = session()->get('firma_id');
        $iller = Il::all();
        $sektorler= Sektor::all();
        $firma = Firma::find($firma_id);
        $onayli_tedarikciler=OnayliTedarikci::where('firma_id', $firma_id)->select('tedarikci_id')->get();
        Debugbar::info($onayli_tedarikciler);
        $il_id = Input::get('il');
        $sektorlerInput = Input::get('sektor');
        $radSearch= Input::get('radSearch');
        $input= Input::get('input');
        /*SELECT *, (select case
           when exists (
              SELECT 1
              FROM onayli_tedarikciler o
              WHERE o.tedarikci_id = f.id
                 AND o.firma_id = 9
           )
           then 1
           else 0
        end)
        FROM firmalar f */
        //$firmalar=Firma::select("*");
        $firmalar = Firma::join('adresler', 'adresler.firma_id', '=', 'firmalar.id')
                ->join('iller', 'adresler.il_id', '=', 'iller.id')
                ->where('adresler.tur_id', '=' , 1)
                ->select("firmalar.*","firmalar.adi as firma_adi","iller.adi as iladi",DB::raw("(case
                when exists (
                   SELECT 1
                   FROM onayli_tedarikciler o
                   WHERE o.tedarikci_id = firmalar.id
                      AND o.firma_id = 9
                )
                then 1
                else 0
             end)as onay"));
        if($radSearch != NULL){
            if($radSearch == "sektor"){
                $firmalar = $firmalar->join('firma_sektorler', 'firmalar.id', '=', 'firma_sektorler.firma_id')
                ->join('sektorler', 'firma_sektorler.sektor_id', '=', 'sektorler.id')->where('sektorler.adi',$input);
            }
            else if($radSearch == "sehir"){
                DebugBar::info($input);
                $firmalar=$firmalar->where('iller.adi',Str::upper($input));
            }
            else if($radSearch == "firma"){
                $firmalar=$firmalar->where('firmalar.adi', 'like', '%' . $input . '%');
            }

        }
        if($radSearch == ""){
            if($input != NULL){
                Debugbar::info("girdi Else");
                $firmalar = $firmalar->where(function ($query) use ($input) {
                        $query->whereExists(function ($q) use($input) {
                            $q->select(DB::raw(1))
                            ->join('sektorler', 'sektorler.id', '=', 'firma_sektorler.sektor_id')
                            ->from('firma_sektorler')
                            ->whereRaw('firmalar.id = firma_sektorler.firma_id')->where('sektorler.adi',$input);
                        })
                        ->orWhere('iller.adi',Str::upper($input))
                        ->orWhere('firmalar.adi', 'like', '%' . $input . '%');
                    });
            }
        }
        if($il_id != NULL){
            $firmalar=$firmalar->whereIn('adresler.il_id',$il_id);
        }

        if($sektorlerInput != NULL){
            $firmalar = $firmalar->join('firma_sektorler', 'firmalar.id', '=', 'firma_sektorler.firma_id')
                ->join('sektorler', 'firma_sektorler.sektor_id', '=', 'sektorler.id')->whereIn('sektorler.id',$sektorlerInput);
        }

        $firmalar=$firmalar->paginate(5);
         DebugBar::info($firmalar);
        if (Request::ajax()) {
            return Response::json(View::make('Firma.firmalar',array('firmalar'=> $firmalar))->render());
        }

        return View::make('Firma.firmaHavuzu')-> with('firmalar',$firmalar)
                ->with('iller', $iller)->with('sektorler',$sektorler)
                ->with('firma',$firma)->with('onayliTedarikciler',$onayli_tedarikciler);

    }

    public function onayliTedarikciEkle(){
        $firma_id = session()->get('firma_id');
        if($firma_id) {
            $tedarikci_id = Input::get('tedarikci_id');
            $kontrol = OnayliTedarikci::where('firma_id', $firma_id)->where('tedarikci_id', $tedarikci_id)->count();
            if ($kontrol == 0) {
                $tedarikci = new OnayliTedarikci();
                $tedarikci->firma_id = $firma_id;
                $tedarikci->tedarikci_id = $tedarikci_id;
                $tedarikci->save();
            }
        }
    }

    public function onayliTedarikciCikar(){
        $firma_id = session()->get('firma_id');
        if($firma_id){
            $tedarikci_id = Input::get('tedarikci_id');
            OnayliTedarikci::where('firma_id',$firma_id)->where('tedarikci_id',$tedarikci_id)->delete();
        }
    }

    public function onayliTedarikcilerim(){
        $onayli_tedarikciler  = Firma::join('adresler', 'adresler.firma_id', '=', 'firmalar.id')
                ->join('iller', 'adresler.il_id', '=', 'iller.id')
                ->where('adresler.tur_id', '=' , 1)
                ->whereExists(function ($query) {
                    $query->select(DB::raw("*"))
                          ->from('onayli_tedarikciler')
                          ->whereRaw('onayli_tedarikciler.firma_id='.session()->get("firma_id"))
                          ->whereRaw('onayli_tedarikciler.tedarikci_id = firmalar.id');
                })
                ->select("firmalar.*","firmalar.adi as firma_adi","iller.adi as iladi")->get();
        return View::make('Firma.onayliTedarikciler')-> with('onayli_tedarikciler',$onayli_tedarikciler);
    }

    public function uploadImage(Request $request) {

            $file = $request->file('logo');
            $file = array('logo' => $request->file('logo'));
            $rules = array('logo' => 'required|mimes:jpeg,bmp,png|max:100000'); //mimes:jpeg,bmp,png and for max size max:10000
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                return Redirect::to('firmaProfili/'.$request->firmaId)->withInput()->withErrors($validator);
            }
            else {
                if ($request->file('logo')->isValid()) {
                    $destinationPath = 'uploads'; // upload path
                    $extension = $request->file('logo')->getClientOriginalExtension();
                    $fileName = rand(11111, 99999) . '.' . $extension;

                    $firma = Firma::find($request->id);
                    $oldName=$firma->logo;
                    $firma->logo = $fileName;
                    $firma->save();
                    $request->file('logo')->move($destinationPath, $fileName);

                    Session::flash('success', 'Upload successfully');
                    File::delete("uploads/$oldName");
                    return Redirect::to('firmaProfili/'.$firma->id);
                }
                else {

                    Session::flash('error', 'uploaded file is not valid');
                    return Redirect::to('firmaProfili/'.$request->firmaId)->withInput()->withErrors($validator);
                }
            }

    }

    public function deleteImage($id){
        $item = Firma::findOrFail($id);
        $oldName=$item->logo;
        $item->logo=null;
        $item->save();
        File::delete("uploads/$oldName");
        return Redirect::to('iletisimbilgilerii/'.$item->id);
    }
    public function iletisimAdd(Request $request){

        DB::beginTransaction();

        try {
            $firma = Firma::find($request->id);

            $iletisim = $firma->iletisim_bilgileri ?: new IletisimBilgisi();
            $iletisim->telefon =Str::title(strtolower( $request->telefon));
            $iletisim->fax =Str::title(strtolower( $request->fax));
            $iletisim->web_sayfasi = $request->web_sayfasi;
            $firma->iletisim_bilgileri()->save($iletisim);

            $adres = $firma->adresler()->where('tur_id', '=', '1')->first() ?: new Adres();
            $adres->il_id = $request->il_id;
            $adres->ilce_id = $request->ilce_id;
            $adres->semt_id = $request->semt_id;
            $adres->adres = Str::title(strtolower($request->adres));
            $tur = 1;
            $adres->tur_id = $tur;
            $firma->adresler()->save($adres);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            $error="error";
            DB::rollback();
            return Response::json($error);
        }
    }
    public function tanitimAdd(Request $request){

            $firma = Firma::find($request->id);
            $firma->tanitim_yazisi = Str::title(strtolower($request->tanitim_yazisi));
            $firma->save();
            return redirect('firmaProfili/'.$firma->id);

    }
    public function maliBilgiAdd(Request $request){

    DB::beginTransaction();

        try {
                $firma = Firma::find($request->id);
                $firma->sirket_turu =Str::title(strtolower( $request->sirket_turu));
                $firma->save();

                $maliBilgi = $firma->mali_bilgiler ?: new \App\MaliBilgi();
                $maliBilgi->unvani =Str::title(strtolower( $request->unvani));
                $maliBilgi->vergi_numarasi =Str::title(strtolower( $request->vergi_numarasi));
                $maliBilgi->vergi_dairesi_id = $request->vergi_dairesi_id;
                $maliBilgi->sermayesi = Str::title(strtolower($request ->sermayesi));
                $maliBilgi->yillik_cirosu = Str::title(strtolower($request ->yillik_cirosu));
                $maliBilgi->ciro_goster = $request ->ciro_goster;
                $maliBilgi->sermaye_goster = $request ->sermaye_goster;
                $firma->mali_bilgiler()->save($maliBilgi);


                $adres = $firma->adresler()->where('tur_id', '=', '2')->first() ?: new Adres();
                $adres->il_id = $request->mali_il_id;
                $adres->ilce_id = $request->mali_ilce_id;
                $adres->semt_id = $request->mali_semt_id;
                $adres->adres =Str::title(strtolower($request->fatura_adresi));
                $tur = 2;
                $adres->tur_id = $tur;
                $firma->adresler()->save($adres);

         DB::commit();
            // all good
        } catch (\Exception $e) {
            $error="error";
            DB::rollback();
            return Response::json($error);
        }
        //return redirect('firmaProfili/'.$firma->id);
    }
    public function ticariBilgiAdd(Request $request){

    DB::beginTransaction();

        try {

            $firma = Firma::find($request->id);
            $firma->kurulus_tarihi=$request->kurulus_tarihi;
            $firma->save();

            $ticariBilgi = $firma->ticari_bilgiler ?: new \App\TicariBilgi();
            $ticariBilgi->tic_sicil_no = $request->ticaret_sicil_no;
            $ticariBilgi->tic_oda_id = $request->ticaret_odasi;
            $ticariBilgi->ust_sektor = $request->ust_sektor;

            $firma->ticari_bilgiler()->save($ticariBilgi);

            $uretilenMarka = new \App\UretilenMarka();
            foreach($request->firmanin_urettigi_markalar as $urettigiMarka){
                $kayitKontrol=  \App\UretilenMarka::where('adi',$urettigiMarka)->get();
                if(count($kayitKontrol) == 0){
                    $uretilenMarka->adi = $urettigiMarka;
                    $firma->uretilen_markalar()->save($uretilenMarka);
                }
            }
            if(count($request->faaliyet_sektorleri) > 1){
                foreach($request->faaliyet_sektorleri as $sektor){
                    $kayitKontrol = \App\FirmaSektor::where('firma_id',$firma->id)->where('sektor_id',$sektor)->get();
                    if(count($kayitKontrol) == 0){
                        $firma->sektorler()->attach($sektor);
                    }
                }
            }
            else{
                $kayitKontrol = \App\FirmaSektor::where('firma_id',$firma->id)->where('sektor_id',$request->faaliyet_sektorleri)->get();
                if(count($kayitKontrol) == 0){
                    $firma->sektorler()->attach($request->faaliyet_sektorleri);
                }
            }
            if(count($request->firmanin_sattigi_markalar) > 1){
                foreach($request->firmanin_sattigi_markalar as $markalar){
                    $satilan = new \App\FirmaSatilanMarka();
                    $satilan->firma_id = $firma->id;
                    $satilan->satilan_marka_adi = $markalar;
                    $satilan->save();
                }
            }else{
                $satilan = new \App\FirmaSatilanMarka();
                $satilan->firma_id = $firma->id;
                $satilan->satilan_marka_adi = $request->firmanin_sattigi_markalar;
                $satilan->save();
            }
            foreach($request->firma_faaliyet_turu as $faaliyetTur){
                $kayitKontrol = \App\FirmaFaaliyet::where('firma_id',$firma->id)->where('faaliyet_id',$faaliyetTur)->get();
                if(count($kayitKontrol) == 0){
                    $firma->faaliyetler()->attach($faaliyetTur);
                }
            }

           DB::commit();
            // all good
        } catch (\Exception $e) {
            $error="error";
            DB::rollback();
            return Response::json($error);
        }
        //return redirect('firmaProfili/'.$firma->id);
    }
    public function kaliteAdd(Request $request){

        DB::beginTransaction();

            try {
                $firma = Firma::find($request->id);
                $firma->kalite_belgeleri()->attach($request->kalite_belgeleri,['belge_no'=>$request->belge_no]);

               DB::commit();
                // all good
            } catch (\Exception $e) {
                $error="error";
                DB::rollback();
                return Response::json($error);
            }
        //return redirect('firmaProfili/'.$firma->id);
    }
    public function referansAdd(Request $request){

    DB::beginTransaction();

        try {
            $firma = Firma::find($request->id);
            $firma_referans = $firma->firma_referanslar ?: new \App\FirmaReferans();
                if ($firma->firma_referanslar) {
                    $firmaReferans = $firma->firma_referanslar()->where('id', '=', '$request->ref_id')->first() ? : new \App\FirmaReferans();
                } else {
                    $firmaReferans = $firma->firma_referanslar()->where('ref_turu', '=', '$request->ref_turu')->first() ? : new \App\FirmaReferans();
                }

            $firmaReferans->ref_turu=Str::title(strtolower($request->ref_turu));
            $firmaReferans->adi=Str::title(strtolower($request->ref_firma_adi));
            $firmaReferans->is_adi=Str::title(strtolower($request->yapılan_isin_adi));
            $firmaReferans->is_turu=$request->isin_turu;
            $firmaReferans->is_yili=$request->is_yili;
            $firmaReferans->calisma_suresi=Str::title(strtolower($request->calısma_suresi));
            $firmaReferans->yetkili_adi=Str::title(strtolower($request->yetkili_kisi_adi));
            $firmaReferans->yetkili_email=$request->yetkili_kisi_email;
            $firmaReferans->yetkili_telefon=Str::title(strtolower($request->yetkili_kisi_telefon));
            $firma->firma_referanslar()->save( $firmaReferans);

           DB::commit();
            // all good
        } catch (\Exception $e) {
            $error="error";
            DB::rollback();
            return Response::json($error);
        }
        //return redirect('firmaProfili/'.$firma->id);
    }
    public function referansUpdate(Request $request){
     DB::beginTransaction();

        try {

        $referans = \App\FirmaReferans::find($request->ref_id);
        $referans->ref_turu=Str::title(strtolower($request->ref_turu));
        $referans->adi=Str::title(strtolower($request->ref_firma_adi));
        $referans->is_adi=Str::title(strtolower($request->yapılan_isin_adi));
        $referans->is_turu=$request->isin_turu;
        $referans->is_yili=$request->is_yili;
        $referans->calisma_suresi=Str::title(strtolower($request->calısma_suresi));
        $referans->yetkili_adi=Str::title(strtolower($request->yetkili_kisi_adi));
        $referans->yetkili_email=$request->yetkili_kisi_email;
        $referans->yetkili_telefon=Str::title(strtolower($request->yetkili_kisi_telefon));
        $referans->save( );

           DB::commit();
            // all good
        } catch (\Exception $e) {
            $error="error";
            DB::rollback();
            return Response::json($error);
        }
        return redirect('firmaProfili/'.$referans->firma_id);
    }
     public function kaliteGuncelle(Request $request){
     DB::beginTransaction();

        try {
        $firma = \App\Firma::find($request->id);
        $firma->kalite_belgeleri()->attach($request->kalite_belgeleri,['belge_no'=>$request->belge_no]);
        $firma->save();


           DB::commit();
            // all good
        } catch (\Exception $e) {
            $error="error";
            DB::rollback();
            return Response::json($error);
        }

        //return redirect('firmaProfili/'.$kalite->firma_kalite_belgeleri->$firma_id);
    }
    public function brosurUpdate(Request $request,$id){
        $file = $request->file('yolu');

        // getting all of the post data
        $file = array('yolu' => $request->file('yolu'));
        // setting up rules
        $rules = array('yolu' => 'required|mimes:pdf|max:100000'); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        $brosur = \App\FirmaBrosur::find($id);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('firmaProfili/'.$brosur->firma_id)->withInput()->withErrors($validator);
        } else {
            // checking file is valid.
            if ($request->file('yolu')->isValid()) {
                $destinationPath = 'brosur'; // upload path
                $extension = $request->file('yolu')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111, 99999) . '.' . $extension; // renameing image


                $oldName = $brosur->yolu;
                $brosur->yolu=$fileName;
                $brosur->adi=Str::title(strtolower($request->brosur_adi));

                $brosur->save( );
                 $request->file('yolu')->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message
                Session::flash('success', 'Upload successfully');
                File::delete("brosur/$oldName");
                return Redirect::to('firmaProfili/'.$brosur->firma_id);
                //return  Redirect::route('commucations')->with('fileName', $fileName);
            } else {
                // sending back with error message.
                Session::flash('error', 'uploaded file is not valid');
                return Redirect::to('firmaProfili/'.$brosur->firma_id)->withInput()->withErrors($validator);
            }
        }
    }
    public function calisanGunleriAdd(Request $request){

     DB::beginTransaction();

        try {
        $firma = Firma::find($request->id);
         foreach($request->firma_departmanları as $departman){
            $kayitKontrol = \App\FirmaDepartman::where('firma_id',$firma->id)->where('departman_id',$departman)->get();
            if(count($kayitKontrol) == 0){
                $firma->departmanlar()->attach($departman);
            }
        }
        $firma_calisan = $firma->firma_calisma_bilgileri ?: new \App\FirmaCalismaBilgisi();
        $firma_calisan->calisma_gunleri_id=$request->calisma_gunleri;
        $firma_calisan->calisma_saatleri=Str::title(strtolower($request->calisma_saatleri));


        if(count($request->firma_calisma_profili)== 2){

             $firma_calisan->calisan_profili = 3;

        }
        else {
              foreach($request->firma_calisma_profili as $calisan){

               $firma_calisan->calisan_profili = $calisan;
              }

        }
        $firma_calisan->calisan_sayisi=Str::title(strtolower($request->calisma_sayisi));
        $firma->firma_calisma_bilgileri()->save( $firma_calisan);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            $error="error";
            DB::rollback();
            return Response::json($error);
        }
        //return redirect('firmaProfili/'.$firma->id);
    }
    public function bilgilendirmeTercihiAdd(Request $request){

    DB::beginTransaction();

        try {

            $firma = Firma::find($request->id);
            foreach($request->bilgilendirme_tercihi as $bilgilendirme){
                if($bilgilendirme == "Sms"){
                    $firma->sms=1;
                }
                elseif ($bilgilendirme == "Mail") {
                    $firma->mail=1;
                }
                elseif($bilgilendirme == "Telefon"){
                    $firma->telefon=1;
                }
                else{
                    $firma->sms=0;
                    $firma->mail=0;
                    $firma->telefon=0;
                }
            }
            $firma->save();

            DB::commit();
            // all good
        } catch (\Exception $e) {
            $error="error";
            DB::rollback();
            return Response::json($error);
        }
        //return redirect('firmaProfili/'.$firma->id);
    }
    public function uploadPdf(Request $request){
        $file = $request->file('yolu');
        // getting all of the post data
        $file = array('yolu' => $request->file('yolu'));
        // setting up rules
        $rules = array('yolu' => 'required|mimes:pdf|max:100000'); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('firmaProfili/'.$request->id)->withInput()->withErrors($validator);
        } else {
            // checking file is valid.
            if ($request->file('yolu')->isValid()) {
                $destinationPath = 'brosur'; // upload path
                $extension = $request->file('yolu')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111, 99999) . '.' . $extension; // renameing image

                $firma = Firma::find($request->id);
                $firma_brosur= new \App\FirmaBrosur();

                /*if ($firma->firma_brosurler() != " "){
                    $oldName=$firma->firma_brosurler()->first()->yolu ;

                }*/

                $firma_brosur->yolu = $fileName;
                $firma_brosur->adi=Str::title(strtolower($request->brosur_adi));
                $firma->firma_brosurler()->save($firma_brosur);

                $request->file('yolu')->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message
                Session::flash('success', 'Upload successfully');
                /*if ($firma->firma_brosurler){

                File::delete("brosur/$oldName");
                }*/
                return Redirect::to('firmaProfili/'.$firma->id);
                //return  Redirect::route('commucations')->with('fileName', $fileName);
            } else {
                // sending back with error message.
                Session::flash('error', 'uploaded file is not valid');
                return Redirect::to('firmaProfili/'.$firma->id)->withInput()->withErrors($validator);
            }
        }

     }

    public function deleteKalite(Request $request,$id){

         $Firmakaliter = \App\FirmaKaliteBelgesi::where('belge_id',$id)->where('firma_id',$request->firma_id)->get();
         foreach ($Firmakaliter as $Firmakalite){}
         $kalite = \App\FirmaKaliteBelgesi::find($Firmakalite->id);
         $kalite->delete();

        return redirect('firmaProfili/'.$request->firma_id);
    }
      public function deleteReferans(Request $request,$id){

         $referans = \App\FirmaReferans::find($id);

         $referans->delete();

        return redirect('firmaProfili/'.$request->firma_id);
    }
     public function deleteBrosur(Request $request,$id){

         $brosur = \App\FirmaBrosur::find($id);

         File::delete("brosur/$brosur->yolu");
         $brosur->delete();

        return redirect('firmaProfili/'.$request->firma_id);
    }


    //eski fonksiyonlar...suan kullanılmıyorlar
    public function firma(Request $request){
        $firma = new Firma();
        $firma->adi = $request->firmaAdi;
        $firma->save();

        foreach($request->sektor as $sektor)
            $firma->sektorler()->attach($sektor);
        return redirect('/');
    }
    public function index($id){
        $firmalar = Firma::find($id);
        $sektorler = Sektor::all();

        return view('firmaKaydet')->with('firmalar',$firmalar)->with('sektorler', $sektorler);
    }

}
