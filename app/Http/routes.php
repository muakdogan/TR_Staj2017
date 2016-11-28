<?php
use App\Form;
use App\iller;
use App\ilceler;
use App\semtler;
use App\adresler;
use App\adres_turleri;
use App\Sektor;
use App\Firma;
use App\FirmaReferans;
use App\iletisim_bilgileri;
use App\Ilan;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Mail\Mailer;

Route::controllers([
   'password' => 'Auth\PasswordController',
]);
Route::get('/anasayfa', function () {
    return view('welcome');
});


Route::group(['middleware' => ['web']], function () {
    //Login Routes...
    Route::get('/admin/login','AdminAuth\AuthController@showLoginForm');
    Route::post('/admin/login','AdminAuth\AuthController@login');
    Route::get('/admin/logout','AdminAuth\AuthController@logout');

    // Registration Routes...
    Route::get('admin/register', 'AdminAuth\AuthController@showRegistrationForm');
    Route::post('admin/register', 'AdminAuth\AuthController@register');

    Route::post('admin/password/email','AdminAuth\PasswordController@sendResetLinkEmail');
    Route::post('admin/password/reset','AdminAuth\PasswordController@reset');
    Route::get('admin/password/reset/{token?}','AdminAuth\PasswordController@showResetForm');

    Route::get('/admin', 'AdminController@index');
    Route::post('/firmaOnay', 'AdminController@firmaOnay');
});

/*Route::get('/adminAnasayfa', function () {
$firmalar=Firma::all();
  return view('admin.dashboard')->with('firmalar',$firmalar);
});*/

Route::get('/', function () {
 
 return view('Anasayfa.temelAnasayfa');
});  

 Route::get('/firmaList', function () {
      
  return view('admin.firmaList');
 });
 
 
Route::get('/firmaOnay/{id}', function ($id) {
 
    $firmas = Firma::find($id);
    $firmas->onay="onay";
    $firmas->save();
    
  return view('admin.firmaList');
 });                    

    Route::get('/firmalist', ['middleware'=>'auth' ,function () {
        $firmalar = Firma::paginate(2);
        return view('Firma.firmalar')->with('firmalar', $firmalar);
    }]);
  
  
    Route::get('/image/{id}', ['middleware'=>'auth',function ($id) {
        $firmas = Firma::find($id);
        return view('firmas.upload')->with('firmas', $firmas);
    }]);
   
    Route::get('/firmaKayit' ,function () {
        $iller = App\Il::all();
        $sektorler= App\Sektor::all();
        return view('Firma.firmaKayit')->with('iller', $iller)->with('sektorler',$sektorler);
    });
    
     Route::get('/yeniFirmaKaydet/{id}' ,function ($id) {
        $kullanici=  App\Kullanici::all();
         $kullanici_id=  App\Kullanici::find($id);
        $iller = App\Il::all();
        $sektorler= App\Sektor::all();
        return view('Firma.yeniFirmaKaydet')->with('iller', $iller)->with('sektorler',$sektorler)->with('kullanici',$kullanici)->with('kullanici_id',$kullanici_id);
    });
    
    Route::get('/firmaIslemleri/{id}',['middleware'=>'auth', function ($id) {
        $firma = Firma::find($id);
        
        if (Gate::denies('show', $firma)) {
              return Redirect::to('/');
        }
        return view('Firma.firmaIslemleri')->with('firma',$firma);
    }]);
    
    Route::get('/ilanAra', 'IlanController@showIlan');
    Route::get('/ilanAra/{page}', 'IlanController@showIlan');
    
    Route::get('/kullaniciFirma',function () {
         
               $kullanici_id=Input::get('kullanici_id');
                $kullaniciFirma=  \App\Kullanici::find($kullanici_id);
               
                
                 $querys = DB::table('firma_kullanicilar')
                ->where( 'firma_kullanicilar.kullanici_id', '=',  $kullanici_id)
               ->join('firmalar', 'firma_kullanicilar.firma_id', '=', 'firmalar.id')
                ->select('firmalar.adi');
               
                 $querys=$querys->get();
               return Response::json($querys);
     });

     Route::get('/il',function(){
        $il_id = Input::get('data');
        $il = \App\Il::find($il_id);
        return Response::json($il);
        
    });
    Route::get('/odeme',function(){
        $odeme_id= Input::get('data');
        $odeme = \App\OdemeTuru::find($odeme_id);
        return Response::json($odeme);
        
    });
    Route::get('/sektor',function(){
        $sektor_id= Input::get('data');
        $sektor =  \App\Sektor::find($sektor_id);
        return Response::json($sektor);
        
    });
    Route::post('/getIlan',function () {
       $querys = DB::table('ilanlar')
                ->join('firmalar', 'ilanlar.firma_id', '=', 'firmalar.id')
                ->join('adresler', 'adresler.firma_id', '=', 'firmalar.id')
                ->join('iller', 'adresler.il_id', '=', 'iller.id')
                ->select('ilanlar.adi as ilanadi', 'ilanlar.*','firmalar.id as firmaid', 'firmalar.*','adresler.id as adresid','adresler.*','iller.adi as iladi');  
         /*$il_id = Input::get('il');
         $bas_tar = Input::get('bas_tar');
         $bit_tar = Input::get('bit_tar');   */
       $opts = isset($_POST['filterOpts'])? $_POST['filterOpts'] : array('');
       $options=json_decode($opts);
       foreach ($options as $option){
            if($option['sektorler'] != NULL){
               $querys->whereIn('firma_sektor',$option['sektorler']);
            }   

       }

        $querys=$querys->get();  
        return Response::json($querys);

    });

   Route::post('/form', function (Request $request) {

            $firma= new Firma();

            $firma->adi=$request->adi;
            $now = new \DateTime();
            $firma->olusturmaTarihi=$now;
            $firma->save();

            $iletisim = $firma->iletisim_bilgileri ?: new App\IletisimBilgisi();
            $iletisim->telefon = $request->telefon;
            $firma->iletisim_bilgileri()->save($iletisim);    

            $adres = $firma->adresler()->where('tur_id', '=', '1')->first() ?: new  App\Adres();
            $adres->il_id = $request->il_id;
            $adres->ilce_id = $request->ilce_id;
            $adres->semt_id = $request->semt_id;
            $adres->adres = $request->adres;
            $tur = 1;
            $adres->tur_id = $tur;
            $firma->adresler()->save($adres);

            $firma->sektorler()->attach($request->sektor_id);


          $kullanici= new App\Kullanici();
          $kullanici->adi = $request->adi;
          $kullanici->soyadi = $request->soyadi;
          $kullanici->email = $request->email;
          $kullanici->unvani = $request->unvan;
          $kullanici->telefon = $request->telefonkisisel;

          $kullanici->save(); 

            $user = $kullanici->user ?: new App\User();
            $user->name = $request->kullanici_adi;
            $user->email = $request->email;

        $user->password =Hash::make( $request->password);



        $kullanici->users()->save($user);

        $firma->kullanicilar()->attach($kullanici);
        
                $data = ['ad' => $request->adi, 'soyad' => $request->soyadi];

                Mail::send('auth.emails.mesaj', $data, function($message) use($data,$request) 
                {
                   
                    $message->to($request->email, $data['ad'])
                    ->subject('YENİ KAYIT OLMA İSTEĞİ!');
                   
                });
          return redirect('/');
    });
    
     Route::post('/yeniFirma/{id}', function (Request $request,$id) {
         
            $kullanici= App\Kullanici::find($id);
            
            $firma= new Firma();
            $firma->adi=$request->adi;
            $now = new \DateTime();
            $firma->olusturmaTarihi=$now;
            $firma->save();

            $iletisim = $firma->iletisim_bilgileri ?: new App\IletisimBilgisi();
            $iletisim->telefon = $request->telefon;
            $firma->iletisim_bilgileri()->save($iletisim);    

            $adres = $firma->adresler()->where('tur_id', '=', '1')->first() ?: new  App\Adres();
            $adres->il_id = $request->il_id;
            $adres->ilce_id = $request->ilce_id;
            $adres->semt_id = $request->semt_id;
            $adres->adres = $request->adres;
            $tur = 1;
            $adres->tur_id = $tur;
            $firma->adresler()->save($adres);

            $firma->sektorler()->attach($request->sektor_id);

            $kullanici->firmalar()->attach($firma);
            
            $data = ['ad' => $kullanici->adi, 'soyad' => $kullanici->soyadi];

                Mail::send('auth.emails.mesaj', $data, function($message) use($data,$id) 
                {
                    $kullanici= App\Kullanici::find($id);
                    $message->to($kullanici->users->email, $data['ad'])
                    ->subject('YENİ FİRMA EKLEME İSTEĞİ!');
                   
                });
            

        return redirect('/'); 
    });
    
    
   Route::get('ilanlarim/{id}' ,function ($id) {
        $firma = Firma::find($id);
     
        return view('Firma.ilan.ilanlarim')->with('firma', $firma);
        
    });
     Route::get('basvurularim/{id}/' ,function ($id) {
        $firma = Firma::find($id);
        $teklifler=  \App\Teklif::all();
        //$kullanici = App\Kullanici::find($kul_id); 
        $detaylar = App\MalTeklif::all();
        return view('Firma.ilan.basvurularim')->with('firma', $firma)->with('teklifler', $teklifler)->with('detaylar', $detaylar);
        
    });
     Route::get('/basvuruDetay/',function (){
         
               
               //$kullanici =  \App\Kullanici::find($kul_id);
              $teklif_id = Input::get('teklif_id');
               
                 $detaylar = DB::table('mal_teklifler')
                        ->join('firma_kullanicilar', 'firma_kullanicilar.id', '=', 'mal_teklifler.firma_kullanicilar_id')
                        ->join('users', 'users.kullanici_id', '=', 'firma_kullanicilar.kullanici_id')
                        ->where( 'mal_teklifler.teklif_id', '=', $teklif_id)
                        ->select('mal_teklifler.*');  
                        
                $detaylar=$detaylar->get();
               return Response::json($detaylar);
               
               
                  
                        
     });
   

   Route::get('ilanTeklifVer/{id}/{ilan_id}'  ,function ($id,$ilan_id) {
        $firma = Firma::find($id);
        $ilan = Ilan::find($ilan_id);
        $birimler=  \App\Birim::all();
       
        return view('Firma.ilan.ilanTeklifVer')->with('firma', $firma)->with('ilan', $ilan)->with('birimler',$birimler);
           

    });
    
    //firma profil route...
    Route::post('firmaProfili/uploadImage/{id}', 'FirmaController@uploadImage');
    Route::post('firmaProfili/deleteImage/{id}', 'FirmaController@deleteImage');
    Route::post('firmaProfili/iletisimAdd/{id}', 'FirmaController@iletisimAdd');
    Route::post('firmaProfili/tanitim/{id}', 'FirmaController@tanitimAdd');
    Route::post('firmaProfili/malibilgi/{id}', 'FirmaController@maliBilgiAdd');
    Route::post('firmaProfili/ticaribilgi/{id}', 'FirmaController@ticariBilgiAdd');
    Route::post('firmaProfili/kalite/{id}', 'FirmaController@kaliteAdd');
    Route::post('firmaProfili/kaliteGuncelle/{id}', 'FirmaController@kaliteGuncelle');
    Route::post('firmaProfili/referans/{id}', 'FirmaController@referansAdd');
    Route::post('firmaProfili/firmaCalisan/{id}', 'FirmaController@calisanGunleriAdd');
    Route::post('firmaProfili/bilgilendirmeTercihi/{id}', 'FirmaController@bilgilendirmeTercihiAdd');
    Route::post('firmaProfili/firmaBrosur/{id}', 'FirmaController@uploadPdf');
    Route::post('firmaProfili/firmaBrosurGuncelle/{id}', 'FirmaController@brosurUpdate');
    Route::post('firmaProfili/referansUpdate/{id}', 'FirmaController@referansUpdate');
    Route::delete('firmaProfili/kaliteSil/{id}', 'FirmaController@deleteKalite');
    Route::delete('firmaProfili/referansSil/{id}', 'FirmaController@deleteReferans');
    Route::delete('firmaProfili/brosurSil/{id}', 'FirmaController@deleteBrosur');
    Route::get('/firmaProfili/{id}', 'FirmaController@showFirma');
    Route::get('/firma/{ref_id?}',function($ref_id){
        $referans=  FirmaReferans::find($ref_id);
        return Response::json($referans);

    });
    Route::get('/firmabrosur/{brosur_id?}',function($brosur_id){
    $brosur= App\FirmaBrosur::find($brosur_id);
    return Response::json($brosur);

    });

    //firma ilan route...
    Route::get('/firmaIlanOlustur/{id}/{ilanid}', 'FirmaIlanController@showFirmaIlan');
    Route::get('/ilanEkle/{id}/{ilan_id}', 'FirmaIlanController@showFirmaIlanEkle');
    
    
    
    Route::post('firmaIlanOlustur/firmaBilgilerim/{id}', 'FirmaIlanController@firmaBilgilerimAdd');
    
    Route::post('firmaIlanOlustur/ilanBilgileri/{id}', 'FirmaIlanController@ilanAdd');
    Route::post('firmaIlanOlustur/ilanBilgileriUpdate/{id}/{ilan_id}', 'FirmaIlanController@ilanUpdate');
    
    Route::post('firmaIlanOlustur/fiyatlandırmaBilgileri/{id}/{ilan_id}', 'FirmaIlanController@fiyatlandırmaBilgileriAdd');
    Route::post('firmaIlanOlustur/fiyatlandırmaBilgileriUpdate/{id}/{ilanid}', 'FirmaIlanController@fiyatlandırmaBilgileriUpdate');
    
    
    Route::post('kalemlerListesiMal/{id}', 'FirmaIlanController@kalemlerListesiMalEkle');
    Route::post('kalemlerListesiHizmet/{id}', 'FirmaIlanController@kalemlerListesiHizmetEkle');
    Route::post('kalemlerListesiGoturu/{id}', 'FirmaIlanController@kalemlerListesiGoturuEkle');
    Route::post('kalemlerListesiYapim/{id}', 'FirmaIlanController@kalemlerListesiYapimİsiEkle');
    
    Route::post('kalemlerListesiMalUpdate/{id}', 'FirmaIlanController@kalemlerListesiMalUpdateEkle');
    Route::post('kalemlerListesiHizmetUpdate/{id}', 'FirmaIlanController@kalemlerListesiHizmetUpdateEkle');
    Route::post('kalemlerListesiGoturuUpdate/{id}', 'FirmaIlanController@kalemlerListesiGoturuUpdatEkle');
    Route::post('kalemlerListesiYapimİsiUpdate/{id}', 'FirmaIlanController@kalemlerListesiYapimİsiUpdateEkle');
    
    Route::delete('mal/{id}', 'FirmaIlanController@deleteMalEkle');
    Route::delete('hizmet/{id}', 'FirmaIlanController@deleteHizmetEkle');
    Route::delete('goturu/{id}', 'FirmaIlanController@deleteGoturuEkle');
    Route::delete('yapim/{id}', 'FirmaIlanController@deleteYapimEkle');
    
    
    Route::post('firmaIlanOlustur/firmateknik/{id}', 'FirmaIlanController@firmaTeknik');
    Route::post('firmaIlanOlustur/kalemlerListesiMal/{id}', 'FirmaIlanController@kalemlerListesiMal');
    Route::post('firmaIlanOlustur/kalemlerListesiHizmet/{id}', 'FirmaIlanController@kalemlerListesiHizmet');
    Route::post('firmaIlanOlustur/kalemlerListesiGoturu/{id}', 'FirmaIlanController@kalemlerListesiGoturu');
    Route::post('firmaIlanOlustur/kalemlerListesiYapim/{id}', 'FirmaIlanController@kalemlerListesiYapimİsi');
    
    Route::post('firmaIlanOlustur/kalemlerListesiMalUpdate/{id}', 'FirmaIlanController@kalemlerListesiMalUpdate');
    Route::post('firmaIlanOlustur/kalemlerListesiHizmetUpdate/{id}', 'FirmaIlanController@kalemlerListesiHizmetUpdate');
    Route::post('firmaIlanOlustur/kalemlerListesiGoturuUpdate/{id}', 'FirmaIlanController@kalemlerListesiGoturuUpdate');
    Route::post('firmaIlanOlustur/kalemlerListesiYapimİsiUpdate/{id}', 'FirmaIlanController@kalemlerListesiYapimİsiUpdate');
    
    Route::delete('firmaIlanOlustur/mal/{id}', 'FirmaIlanController@deleteMal');
    Route::delete('firmaIlanOlustur/hizmet/{id}', 'FirmaIlanController@deleteHizmet');
    Route::delete('firmaIlanOlustur/goturu/{id}', 'FirmaIlanController@deleteGoturu');
    Route::delete('firmaIlanOlustur/yapim/{id}', 'FirmaIlanController@deleteYapim');
    
    Route::get('/firmaMal/{ilan_mal_id?}',function($ilan_mal_id){
            $mal=  App\IlanMal::find($ilan_mal_id);
            return Response::json($mal);

    });
    Route::get('/firmaHizmet/{ilan_hizmet_id?}',function($ilan_hizmet_id){
            $hizmet= App\IlanHizmet::find($ilan_hizmet_id);
            return Response::json($hizmet);

    });
    Route::get('/firmaGoturuBedel/{ilan_goturu_bedel_id?}',function($ilan_goturu_bedel_id){
            $goturu= App\IlanGoturuBedel::find($ilan_goturu_bedel_id);
            return Response::json($goturu);

    });
    Route::get('/firmaYapimİsi/{ilan_yapim_isi_id?}',function($ilan_yapim_isi_id){
            $yapim= App\IlanYapimIsi::find($ilan_yapim_isi_id);
            return Response::json($yapim);

    });
 /////////////////////////Teklif Ara ///////////////////////////////////   
Route::get('teklifAra' ,function () {
    
    $ilan_id = Input::get('ilan_id');
    $firma_id = Input::get('firma_id');
    $teklifler = App\Teklif::all()->where('ilan_id', $ilan_id)->where('firma_id', id)->get();
    response($teklifler);
        
        
    }); 
//////////////////////////////////////teklifGor//////////////////////
    Route::get('teklifGor/{id}/{ilanid}' ,function ($id,$ilanid) {
        $firma = Firma::find($id);
        $ilan = Ilan::find($ilanid);
        return view('Firma.ilan.teklifGor')->with('firma', $firma)->with('ilan',$ilan);
        
    }); 
/////////////////////////////////////teklif Gönder /////////////////////////////////
    Route::post('/teklifGonder/{firma_id}/{ilan_id}' ,function ($firma_id,$ilan_id,Request $request) {
        
        $now = new \DateTime();
        
        $ilan=  Ilan::find($ilan_id);
        
        $teklif = new \App\Teklif;
        $teklif->firma_id =$firma_id;
        $teklif->ilan_id = $ilan_id;
        $teklif->save();
        $kdvsizFiyatToplam=0;
         $arrayFiyat = Array();
        $array = Array();
        $arrayKdv = Array();
        
        foreach($request->kdv as $kdv){
            $arrayKdv[] = $kdv;
        }
        foreach($request->fiyat as $kdvliFiyat){
            $array[] = $kdvliFiyat;
        }
        if($ilan->ilan_mallar() != null){
            foreach($request->ilan_mal_id as $fiyat){
                $arrayFiyat[] = $request->$fiyat;
                $kdvsizFiyatToplam = $kdvsizFiyatToplam + $request->$fiyat;
            }
            $i=0;
            foreach($request->ilan_mal_id as $id){
                $ilan_mal= \App\IlanMal::find($id);
                $ilan_mal_teklifler = new App\MalTeklif;
                $ilan_mal_teklifler-> ilan_mal_id = $ilan_mal->id;
                $ilan_mal_teklifler-> teklif_id = $teklif->id;
                $ilan_mal_teklifler->kdv_orani = $arrayKdv[$i];
                $ilan_mal_teklifler->kdv_haric_fiyat=$arrayFiyat[$i];
                $ilan_mal_teklifler->kdv_dahil_fiyat=$array[$i];
                $ilan_mal_teklifler->tarih= $now;
                $ilan_mal_teklifler->para_birimleri_id=$ilan->para_birimi_id;
                $ilan_mal_teklifler->save();
                $i++;
            }
        }elseif ($ilan->ilan_hizmetler() != null) {
            foreach($request->ilan_hizmet_id as $fiyat){
                $arrayFiyat[] = $request->$fiyat;
                $kdvsizFiyatToplam = $kdvsizFiyatToplam + $request->$fiyat;
            }
            $i=0;
            foreach($request->ilan_hizmet_id as $id){
                $ilan_hizmet= \App\IlanHizmet::find($id);
                $ilan_hizmet_teklifler = new App\HizmetTeklif;
                $ilan_hizmet_teklifler-> ilan_mal_id = $ilan_hizmet->id;
                $ilan_hizmet_teklifler-> teklif_id = $teklif->id;
                $ilan_hizmet_teklifler->kdv_orani = $arrayKdv[$i];
                $ilan_hizmet_teklifler->kdv_haric_fiyat=$arrayFiyat[$i];
                $ilan_hizmet_teklifler->kdv_dahil_fiyat=$array[$i];
                $ilan_hizmet_teklifler->tarih= $now;
                $ilan_hizmet_teklifler->para_birimleri_id=$ilan->para_birimi_id;
                $ilan_hizmet_teklifler->save();
                $i++;
            }
        
        }elseif($ilan->goturu_bedeller() != null){
            foreach($request->goturu_bedel_id as $fiyat){
                $arrayFiyat[] = $request->$fiyat;
                $kdvsizFiyatToplam = $kdvsizFiyatToplam + $request->$fiyat;
            }
            $i=0;
            foreach($request->ilan_goturu_bedel_id as $id){
                $ilan_goturu = \App\IlanGoturuBedel::find($id);
                $ilan_goturu_teklifler = new App\GoturuBedelTeklif;
                $ilan_goturu_teklifler-> ilan_mal_id = $ilan_goturu->id;
                $ilan_goturu_teklifler-> teklif_id = $teklif->id;
                $ilan_goturu_teklifler->kdv_orani = $arrayKdv[$i];
                $ilan_goturu_teklifler->kdv_haric_fiyat=$arrayFiyat[$i];
                $ilan_goturu_teklifler->kdv_dahil_fiyat=$array[$i];
                $ilan_goturu_teklifler->tarih= $now;
                $ilan_goturu_teklifler->para_birimleri_id=$ilan->para_birimi_id;
                $ilan_goturu_teklifler->save();
                $i++;
            }
            
        }else{
            foreach($request->yapim_isi_id as $fiyat){
                $arrayFiyat[] = $request->$fiyat;
                $kdvsizFiyatToplam = $kdvsizFiyatToplam + $request->$fiyat;
            }
            $i=0;
            foreach($request->yapim_isi_id as $id){
                $ilan_yapim = \App\IlanYapimIsi::find($id);
                $ilan_yapim_teklifler = new App\YapimIsiTeklif;
                $ilan_yapim_teklifler-> ilan_mal_id = $ilan_yapim->id;
                $ilan_yapim_teklifler-> teklif_id = $teklif->id;
                $ilan_yapim_teklifler->kdv_orani = $arrayKdv[$i];
                $ilan_yapim_teklifler->kdv_haric_fiyat=$arrayFiyat[$i];
                $ilan_yapim_teklifler->kdv_dahil_fiyat=$array[$i];
                $ilan_yapim_teklifler->tarih= $now;
                $ilan_yapim_teklifler->para_birimleri_id=$ilan->para_birimi_id;
                $ilan_yapim_teklifler->save();
                $i++;
            }
        }
        $teklifHareket = new App\TeklifHareket;
        $teklifHareket->kdv_haric_fiyat=$kdvsizFiyatToplam;
        $teklifHareket->kdv_dahil_fiyat=$request->toplamFiyat;
        $teklifHareket->para_birimleri_id=$ilan->para_birimi_id;
        $teklifHareket->tarih = $now;
        $teklif->teklif_hareketler()->save($teklifHareket);
        
       return Redirect::to('firmaIslemleri/'.$firma_id);
            
    }); 



Route::get('/ajax-subcat', function (Request $request) {
    
    $il_id = Input::get('il_id');
    
    //$il_id=1
    $ilceler = \App\Ilce::where('il_id', '=', $il_id)->get();
    return Response::json($ilceler);
});
Route::get('/ajax-subcatt', function () {
    $ilce_id = Input::get('ilce_id');
    $semtler = \App\Semt::where('ilce_id', '=', $ilce_id)->get();
    return Response::json($semtler);
});
 Route::auth();


