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
use App\FirmaSatilanMarka;
use App\Ilan;
use App\Teklif;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Mail\Mailer;


/*Route::get('/anasayfa', function () {
return view('welcome');
//Admin Welcome sayfası kullanılmamaktadır.
});-,*/
Route::get('/sessionKill', function () {
  Auth::logout();
  Session::flush();
  return Redirect::to('/');

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
Route::get('/kalemlerTablolari',['middleware' => 'admin' , function () {
  return view('admin.kalemlerTablolari');

}]);

//Route::resource('kullaniciLog', 'ActivityController');
/*Route::get('/kullaniciLog', function () {

$latestActivities = Activity::with('user')->latest()->limit(100)->get();
return view('admin.kullaniciLog', array('latestActivities' => $latestActivities));
});*/
Route::post('/updateTree', function () {
  $id = Input::get('id');
  $value = Input::get('value');
  $type = Input::get('type');
  $kalem = App\Kalem::find($id);

  if( $type == "checkbox"){
    $kalem->is_aktif = $value;
  }
  else if($type == "updateName"){
    $kalem->adi = $value;
  }
  else if($type == "updateNaceKodu"){
    $kalem->nace_kodu = $value;
  }

  $kalem->save();
});
Route::get('/findChildrenTree', function () {
  $id = Input::get('id');
  $kalemler = DB::select( DB::raw("SELECT adi as 'title',id as 'key',
    (SELECT (CASE WHEN COUNT(*) > 0 THEN 'true' END) from kalemler as k2 where k1.id= k2.parent_id)  as folder,
    (SELECT (CASE WHEN COUNT(*) > 0 THEN 'true' END) from kalemler as k3 where k1.id= k3.parent_id)  as lazy, is_aktif, nace_kodu
    FROM kalemler as k1
    where k1.parent_id = '$id'" ));

    return Response::json($kalemler);

  });
  Route::get('/tablesControl',['middleware' => 'admin' , function () {
    return view('admin.index');
  }]);

  Route::get('/api/v1/admins/{id?}', 'Admins@index');
  Route::post('/api/v1/admins', 'Admins@store');
  Route::post('/api/v1/admins/{id}', 'Admins@update');
  Route::delete('/api/v1/admins/{id}', 'Admins@destroy');

  /*Route::get('/adminAnasayfa', function () {
  $firmalar=Firma::all();
  return view('admin.dashboard')->with('firmalar',$firmalar);
});*/
Route::post('/doluluk_orani/{id}', function (Request $request,$id) {
  $doluluk_orani = Input::get('doluluk_orani');
  $firma = Firma::find($id);
  $firma ->doluluk_orani=$doluluk_orani;
  $firma ->save();
  return Response::json($firma);

});
Route::get('/', function () {

  return view('Anasayfa.temelAnasayfa');
});

Route::get('/firmaList', function () {

  $onay = DB::table('firmalar')
  ->where('onay', 0)->orderBy('olusturmaTarihi', 'desc') ->paginate(2, ['*'], '1pagination');

  $onayli = DB::table('firmalar')
  ->where('onay', 1)->orderBy('olusturmaTarihi', 'desc') ->paginate(2, ['*'], '2pagination');

  return View::make('admin.firmaList')-> with('onay',$onay)-> with('onayli',$onayli);

});
Route::get('/firmaListeleme',function (){

  $onay = DB::table('firmalar')
  ->where('onay', 0)->orderBy('olusturmaTarihi', 'desc') ->paginate(2, ['*'], '1pagination');

  return Response::json(View::make('admin.firmaListTable',array('onay'=> $onay))->render());

});
Route::get('/firmaListeOnaylı',function (){

  $onayli = DB::table('firmalar')
  ->where('onay', 1)->orderBy('olusturmaTarihi', 'desc') ->paginate(2, ['*'], '2pagination');

  return Response::json(View::make('admin.firmaListOnayli',array('onayli'=> $onayli))->render());
});
Route::get('/yorumList', function () {

  return view('admin.yorumList');
});
Route::POST('/firmaDavet', function () {

  $davetEdilenFirma = Input::get('isim');

  $mail_adres = Input::get('mailAdres');
  $kontrol = App\Kullanici::where('email',$mail_adres);
  $firma_id = Input::get('firma_id');
  $firma = Firma::find($firma_id);

  if(count($kontrol) == 0){
    $data = ['firma_adi' => $davetEdilenFirma, 'davet_eden_firma' => $firma->adi];
    Mail::send('auth.emails.firmaDavet', $data, function($message) use($data,$mail_adres)
    {
      $message->to($mail_adres, $data['davet_eden_firma'])
      ->subject('FİRMANIZ DAVET EDİLDİ!');

    });
    $mesaj = "Başarıyla Davet Edildi";
  }
  else{
    $mesaj =  "Bu Firma Sistemimizde Kayıtlıdır.";
  }
  return Response::json($mesaj);
});

Route::get('/firmaOnay/{id}', function ($id) {

  $firmas = Firma::find($id);
  $firmas->onay=1;
  $firma_kul = App\FirmaKullanici::where('firma_id',$id)->get();
  foreach ($firma_kul as $firmaKul){

  }

  $firmaOnay=  \App\Kullanici::find($firmaKul->kullanici_id);

  $data = ['ad' => $firmaOnay->adi, 'soyad' => $firmaOnay->soyadi];

  Mail::send('auth.emails.yorum_mesaj', $data, function($message) use($data,$firmaOnay)
  {
    $message->to($firmaOnay->email, $data['ad'])
    ->subject('FİRMANIZ ONAYLANDI!');

  });
  $firmas->save();
  return view('admin.firmaList');
});

Route::get('/yorumOnay/{id}/{yorum_kul_id}', function ($id,$yorum_kul_id) {

  $yorumlar = App\Yorum::find($id);
  $yorumlar->onay=1;

  $yorum_kul = App\Kullanici::find($yorum_kul_id);

  $data = ['ad' => $yorum_kul->adi, 'soyad' => $yorum_kul->soyadi];

  Mail::send('auth.emails.yorum_mesaj', $data, function($message) use($data,$yorum_kul)
  {
    $message->to($yorum_kul->email, $data['ad'])
    ->subject('YORUMUNUZ YAYINLANDI!');

  });
  $yorumlar->save();
  return view('admin.yorumList');
});
Route::get('/kullaniciIslemleri/{id}', function ($id) {
  $firma = Firma::find($id);
  $roller=  App\Rol::all();

  return view('Kullanici.kullaniciIslemleri')->with('firma',$firma)->with('roller',$roller);

});
Route::get('/kullaniciBilgileri/{id}', function ($id) {
  $firma = Firma::find($id);
  return view('Kullanici.kullaniciBilgileri')->with('firma',$firma);
});
Route::post('/kullaniciBilgileriUpdate/{id}/{kul_id}', function (Request $request,$id,$kul_id) {
  $firma = Firma::find($id);
  $kullanici= App\Kullanici::find($kul_id);
  $kullanici->adi = Str::title(strtolower($request->adi));
  $kullanici->soyadi = Str::title(strtolower($request->soyadi));
  $kullanici->email = $request->email;
  $kullanici->telefon = $request->telefon;
  $kullanici->save();

  $user = DB::table('users')
  ->where( 'users.kullanici_id', '=',  $kul_id);
  $user->name=$request->kul_adi;
  $user->save();

  return view('Kullanici.kullaniciBilgileri')->with('firma',$firma);
});

Route::post('/kullaniciBilgileriSifre/{id}/{user_id}', function (Request $request,$id,$user_id) {
  $firma = Firma::find($id);

  $user= App\User::find($user_id);
  $user->email = $request->email;
  $user->password =Hash::make( $request->sifre);

  return view('Kullanici.kullaniciBilgileri')->with('firma',$firma);
});
Route::post('/kullaniciIslemleriEkle/{id}', function (Request $request,$id) {

  DB::beginTransaction();

  try {
    $firma = Firma::find($id);
    $roller=  App\Rol::all();

    $kullanici= new App\Kullanici();
    $kullanici->adi = Str::title(strtolower($request->adi));
    $kullanici->soyadi = Str::title(strtolower($request->soyadi));
    $kullanici->email = $request->email;
    $kullanici->save();

    $user = $kullanici->users ?: new App\User();
    $user->email = $request->email;
    $user->password =Hash::make('tamrekabet');

    $kullanici->users()->save($user);
    $rol=$request->rol;
    $unvan=$request->unvan;
    $firma->kullanicilar()->attach($kullanici,['rol_id'=>$rol,'unvan'=>$unvan]);

    //$firma->kullanicilar()->attach($kullanici,['unvan'=>$unvan]);

    $data = ['ad' => $request->adi, 'soyad' => $request->soyadi];

    Mail::send('auth.emails.password', $data, function($message) use($data,$request)
    {
      $message->to($request->email, $data['ad'],$request->to)
      ->subject('YENİ KAYIT OLMA İSTEĞİ!');
    });
    DB::commit();
    // all good
  } catch (\Exception $e) {
    $error="error";
    DB::rollback();
    return Response::json($error);
  }
  //return Redirect::to('/kullaniciIslemleri/'.$firma->id);


});
Route::post('/kullaniciIslemleriUpdate/{id}/{kul_id}', function (Request $request,$id,$kul_id) {
  DB::beginTransaction();

  try {
    $firma = Firma::find($id);
    $roller=  App\Rol::all();
    $kullanici= App\Kullanici::find($kul_id);

    $kullanici->adi = Str::title(strtolower($request->adi));
    $kullanici->soyadi = Str::title(strtolower($request->soyadi));
    $kullanici->email = $request->email;
    $kullanici->save();

    $user = $kullanici->users ?: new App\User();
    $user->email = $request->email;
    $user->password =Hash::make('tamrekabet');

    $kullanici->users()->save($user);

    $firmaKullanicilar = App\FirmaKullanici::where('kullanici_id', '=',  $kul_id)
    ->where('firma_id', '=',$id)->first();

    $firmaKullanicilar->rol_id =$request->rol;
    $firmaKullanicilar->unvan=$request->unvan;
    $firmaKullanicilar->save();
    DB::commit();
    // all good
  } catch (\Exception $e) {
    $error="error";
    DB::rollback();
    return Response::json($error);
  }
  //return Redirect::to('/kullaniciIslemleri/'.$firma->id);

});
Route::get('/kullanici/{kullanici_id?}',function($kullanici_id){
  $kul= App\Kullanici::find($kullanici_id);
  return Response::json($kul);
});
Route::delete('/kullaniciDelete/{id}/{firma_id}',function($id,$firma_id,Request $request){
  $firma = Firma::find($firma_id);
  $roller=  App\Rol::all();
  $kul= App\Kullanici::find($id);
  $user = DB::table('users')
  ->where( 'users.kullanici_id', '=',  $id);

  $user->delete();
  $kul->delete();

  return Redirect::to('/kullaniciIslemleri/'.$firma_id);

});


Route::get('/firmalist', ['middleware'=>'auth' ,function () {
  $firmalar = Firma::paginate(2);
  return view('Firma.firmalar')->with('firmalar', $firmalar);
}]);
Route::get('/firmaDetay/{firmaid}', function ($firmaid) {
    $firma=Firma::find($firmaid);
    $puanlar = App\Puanlama::where('firma_id','=',$firma->id)
        ->select(array(DB::raw("avg(kriter1)as ortalama1, avg(kriter2) as ortalama2,avg(kriter3) as ortalama3,avg(kriter4) as ortalama4")))
        ->get();
   $puanlar = $puanlar->toArray();
    if (!$firma->ticari_bilgiler) {
         $firma->ticari_bilgiler = new TicariBilgi();
         $firma->ticari_bilgiler->ticaret_odalari = new TicaretOdasi();
         $firma->ticari_bilgiler->sektorler = new Sektor();
     }
    $yorumlar = App\Yorum::where('firma_id','=',$firma->id)->orderBy('tarih','DESC')->get();
    $toplamYorum =App\Yorum::where('firma_id','=',$firma->id)->count();
    $satilanMarka = FirmaSatilanMarka::where('firma_id', '=', $firma->id)->get();
    $firmaAdres = $firma->adresler()->where('tur_id', '=', '1')->first();
    if (!$firma->iletisim_bilgileri)
        $firma->iletisim_bilgileri = new IletisimBilgisi();
    if (!$firmaAdres) {
        $firmaAdres = new Adres();
        $firmaAdres->iller = new Il();
        $firmaAdres->ilceler = new Ilce();
        $firmaAdres->semtler = new Semt();
    }
    if (!$firma->mali_bilgiler) {
        $firma->mali_bilgiler = new App\MaliBilgi();
    }
    $firmaFatura = $firma->adresler()->where('tur_id', '=', '2')->first();
    if (!$firma->mali_bilgiler) {
        $firma->mali_bilgiler = new App\MaliBilgi();
        $firma->mali_bilgiler->vergi_daireleri = new App\VergiDairesi();
        $firma->sirket_turleri = new App\SirketTuru();
    }
    if (!$firmaFatura) {
        $firmaFatura = new Adres();
        $firmaFatura->iller = new Il();
        $firmaFatura->ilceler = new Ilce();
        $firmaFatura->semtler = new Semt();
    }
    $sirketTurleri=  \App\SirketTuru::all();
    $uretilenMarka = DB::table('uretilen_markalar')->where('firma_id', '=', $firma->id)->get();   
    if (!$firma->kalite_belgeleri) {
        $firma->firma_kalite_belgeleri = new App\FirmaKaliteBelgesi();
    }
    $kaliteBelge = DB::table('firma_kalite_belgeleri')->where('firma_id', $firma->id)->count();   
    if (!$firma->firma_referanslar) {
        $firma->firma_referanslar = new App\FirmaReferans();
    } else {
        $firmaReferanslar = $firma->firma_referanslar()->orderBy('ref_turu', 'desc')->orderBy('is_yili', 'desc')->get();
    }

    $referans = DB::table('firma_referanslar')->where('firma_id', $firma->id)->count();
     if (!$firma->firma_brosurler) {
        $firma->firma_brosurler = new App\FirmaBrosur();
    }
    $brosur = DB::table('firma_brosurler')->where('firma_id', $firma->id)->count();
    
    if (!$firma->firma_calisma_bilgileri) {
        $firma->firma_calisma_bilgileri = new App\FirmaCalismaBilgisi();
        $calismaGunu = '';
    } else
        $calismaGunu = $firma->firma_calisma_bilgileri->calisma_gunleri->adi;

    $calisan = DB::table('firma_calisma_bilgileri')->where('firma_id', $firma->id)->count();
    
   
    
     return view('Firma.firmaDetay')->with('firma', $firma)->with('puanlar', $puanlar)->with('yorumlar', $yorumlar)
          ->with('toplamYorum', $toplamYorum)->with('satilanMarka', $satilanMarka)->with('firmaAdres', $firmaAdres)->with('firmaFatura', $firmaFatura)
          ->with('sirketTurleri', $sirketTurleri)->with('uretilenMarka', $uretilenMarka)->with('kaliteBelge', $kaliteBelge)->with('firmaReferanslar', $firmaReferanslar)
          ->with('referans', $referans)->with('brosur', $brosur)->with('calisan', $calisan)
          ->with('calismaGunu', $calismaGunu)->with('puanlar', $puanlar);
  
  
});
Route::get('/davetEdildigim/{firmaid}', function ($firmaid) {
  $firma=Firma::find($firmaid);
  return view('Firma.ilan.davetEdildigimIlanlar')->with('firma', $firma);
});

Route::get('/image/{id}', ['middleware'=>'auth',function ($id) {
  $firmas = Firma::find($id);
  return view('firmas.upload')->with('firmas', $firmas);
}]);

Route::get('/firmaKayit' ,function () {
  $iller = App\Il::all();
 
  $iller_query= DB::select(DB::raw("SELECT *
                                FROM  `iller`
                                WHERE adi = 'İstanbul'
                                OR adi =  'İzmir'
                                OR adi =  'Ankara'
                                UNION
                                SELECT *
                                FROM iller"));
   $sektorler=DB::table('sektorler')->orderBy('adi','ASC')->get();  
  
  
  return view('Firma.firmaKayit')->with('iller', $iller)->with('sektorler',$sektorler)->with('iller_query',$iller_query);
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
  $davetEdilIlanlar = App\BelirlIstekli::where('firma_id',$firma->id)->get();
  $ilanlarFirma = $firma->ilanlar()->orderBy('yayin_tarihi','desc')->limit('5')->get();
  $teklifler= DB::table('teklifler')->where('firma_id',$firma->id)->limit(5)->get(); 
  $tekliflerCount= DB::table('teklifler')->where('firma_id',$firma->id)->count();
  
  return view('Firma.firmaIslemleri')->with('firma',$firma)->with('davetEdilIlanlar', $davetEdilIlanlar)
          ->with('ilanlarFirma', $ilanlarFirma)->with('teklifler', $teklifler)->with('tekliflerCount', $tekliflerCount);
}]);

Route::post('/ilanAra', 'IlanController@showIlan');
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
  DB::beginTransaction();

  try {
    $firma= new Firma();

    $firma->adi=Str::title(strtolower($request->firma_adi));
    $now = new \DateTime();
    $firma->olusturmaTarihi=$now;
    $firma->save();

    $iletisim = $firma->iletisim_bilgileri ?: new App\IletisimBilgisi();
    $iletisim->telefon = $request->telefon;
    $iletisim->email = $request->email;
    $firma->iletisim_bilgileri()->save($iletisim);

    $adres = $firma->adresler()->where('tur_id', '=', '1')->first() ?: new  App\Adres();
    $adres->il_id = $request->il_id;
    $adres->ilce_id = $request->ilce_id;
    $adres->semt_id = $request->semt_id;
    $adres->adres =Str::title(strtolower( $request->adres));
    $tur = 1;
    $adres->tur_id = $tur;
    $firma->adresler()->save($adres);

    $firma->sektorler()->attach($request->sektor_id);

    $kullanici= new App\Kullanici();
    $kullanici->adi = Str::title(strtolower($request->adi));
    $kullanici->soyadi =Str::title(strtolower( $request->soyadi));
    $kullanici->email = $request->email_giris;
    $kullanici->password =Hash::make( $request->password);
    $kullanici->telefon = $request->telefonkisisel;
    $kullanici->save();

    $firma->kullanicilar()->attach($kullanici,['rol_id'=>1, 'unvan'=>Str::title(strtolower($request->unvan))]);

    $data = ['ad' => $request->adi, 'soyad' => $request->soyadi];

    Mail::send('auth.emails.mesaj', $data, function($message) use($data,$request)
    {

      $message->to($request->email, $data['ad'])
      ->subject('YENİ KAYIT OLMA İSTEĞİ!');

    });
    DB::commit();
    // all good
  } catch (\Exception $e) {
    $error="error";
    DB::rollback();
    return Response::json($error);

  }



});

Route::post('/yeniFirma/{id}', function (Request $request,$id) {

  DB::beginTransaction();

  try {

    $kullanici= App\Kullanici::find($id);

    $firma= new Firma();
    $firma->adi=Str::title(strtolower($request->adi));
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
    $adres->adres =Str::title(strtolower( $request->adres));
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

    DB::commit();
    // all good
  } catch (\Exception $e) {
    $error="error";
    DB::rollback();
    return Response::json($error);
  }
  //return redirect('/');
});


Route::get('ilanlarim/{id}' ,function ($id) {
  $firma = Firma::find($id);
  if (Gate::denies('show', $firma)) {
    return Redirect::to('/');
  }
  return view('Firma.ilan.ilanlarim')->with('firma', $firma);

});
Route::get('basvurularim/{id}' ,function ($id) {
  $firma = Firma::find($id);
  if (Gate::denies('show', $firma)) {
    return Redirect::to('/');
  }
  $teklifler=  \App\Teklif::all();
  //$kullanici = App\Kullanici::find($kul_id);
  $detaylar = App\MalTeklif::all();
  return view('Firma.ilan.basvurularim')->with('firma', $firma)->with('teklifler', $teklifler)->with('detaylar', $detaylar);

});

Route::get('/basvuruDetay/',function (){
  $teklifler =  \App\Teklif::all();

  $teklif_id = Input::get('teklif_id');
  foreach($teklifler as $teklif){
    if($teklif->ilanlar->ilan_turu==1){
      $detaylar = DB::table('mal_teklifler')
      ->join('ilan_mallar', 'ilan_mallar.id', '=', 'mal_teklifler.ilan_mal_id')
      ->join('ilanlar', 'ilanlar.id', '=', 'ilan_mallar.ilan_id')
      ->join('birimler', 'birimler.id', '=', 'ilan_mallar.birim_id')
      ->where( 'mal_teklifler.teklif_id', '=', $teklif_id)
      ->select('ilan_mallar.*','ilanlar.adi as ilanadi','birimler.adi as birimadi');

      $detaylar=$detaylar->get();
    }
    else if($teklif->ilanlar->ilan_turu==2){
      $detaylar = DB::table('hizmet_teklifler')
      ->join('ilan_hizmetler', 'ilan_hizmetler.id', '=', 'hizmet_teklifler.ilan_hizmet_id')
      ->join('ilanlar', 'ilanlar.id', '=', 'ilan_hizmetler.ilan_id')
      ->join('birimler', 'birimler.id', '=', 'ilan_hizmetler.fiyat_standardi_birim_id')
      //->join('birimler', 'birimler.id', '=', 'ilan_hizmetler.miktar_birim_id')
      ->where( 'hizmet_teklifler.teklif_id', '=', $teklif_id)
      ->select('ilan_hizmetler.*','ilanlar.adi as ilanadi','birimler.adi as fiyat_standardi_birim_adi');

      $detaylar=$detaylar->get();
    }
    else if($teklif->ilanlar->ilan_turu=='Götürü Bedel'){
      $detaylar = DB::table('goturu_bedeller_teklifler')
      ->join('ilan_goturu_bedeller', 'ilan_goturu_bedeller.id', '=', 'goturu_bedeller_teklifler.ilan_goturu_bedel_id')
      ->join('ilanlar', 'ilanlar.id', '=', 'ilan_goturu_bedeller.ilan_id')
      ->where( 'goturu_bedeller_teklifler.teklif_id', '=', $teklif_id)
      ->select('ilan_goturu_bedeller.*','ilanlar.adi as ilanadi');

      $detaylar=$detaylar->get();

    }
    else if($teklif->ilanlar->ilan_turu==3){
      $detaylar = DB::table('yapim_isi_teklifler')
      ->join('ilan_yapim_isileri', 'ilan_yapim_isileri.id', '=', 'yapim_isi_teklifler.ilan_yapim_isi_id')
      ->join('ilanlar', 'ilanlar.id', '=', 'ilan_yapim_isleri.ilan_id')
      ->join('birimler', 'birimler.id', '=', 'ilan_yapim_isleri.birim_id')
      ->where( 'yapim_isi_teklifler.teklif_id', '=', $teklif_id)
      ->select('ilan_yapim_isleri.*','ilanlar.adi as ilanadi','birimler.adi as birimadi');

      $detaylar=$detaylar->get();
    }
  }
  return Response::json($detaylar);
});

Route::get('/belirli/',function (){
  $sektorBelirli = Input::get('sektorBelirli');

  $sektorControl = DB::table('firmalar')
  ->join('firma_sektorler', 'firmalar.id', '=', 'firma_sektorler.firma_id')
  ->where('firma_sektorler.sektor_id', '=',$sektorBelirli)
  ->select('firmalar.adi')
  ->orderBy('adi','asc');

  $sektorControl = $sektorControl->get();

  return Response::json($sektorControl);
});

Route::get('/basvuruControl/',function (){
  $firma_id = session()->get('firma_id');
  $ilan_id = Input::get('ilan_id');

  $sektorler =  \App\FirmaSektor::where('firma_sektorler.firma_id', '=',session()->get('firma_id'))
  ->select('sektor_id');
  $sektorler = $sektorler->get()->toArray();
  //$sektorler = $sektorler->to_array();
  $basvuruControl = DB::table('teklifler')
  ->join('firmalar', 'firmalar.id', '=', 'teklifler.firma_id')
  ->join('ilanlar', 'ilanlar.id', '=', 'teklifler.ilan_id')
  ->whereIn('ilanlar.ilan_sektor', $sektorler)
  ->where('teklifler.ilan_id', '=', $ilan_id)
  ->where('teklifler.firma_id', '=', $firma_id);
  $basvuruControl = $basvuruControl->count();
  
  
  return Response::json($basvuruControl);

});

Route::get('/IlanFirmaControl/',function (){
  $firma_adi = session()->get('firma_adi');
  $ilan_id = Input::get('ilan_id');

  $basvuruControl = DB::table('firmalar')
  ->join('ilanlar', 'ilanlar.firma_id', '=', 'firmalar.id')
  ->where('ilanlar.id', '=', $ilan_id)
  ->where('firmalar.adi', '=', $firma_adi);

  $basvuruControl = $basvuruControl->count();
  return Response::json($basvuruControl);

});
Route::get('/emailControl/',function (){
  $email = Input::get('email');
  $emailControl = DB::table('users')
  ->where('email', '=', $email);

  $emailControl = $emailControl->count();
  return Response::json($emailControl);
});
Route::get('/email_girisControl/',function (){
  $email_giris = Input::get('email_giris');
  $email_girisControl = DB::table('kullanicilar')
  ->where('email', '=', $email_giris);

  $email_girisControl = $email_girisControl->count();
  return Response::json($email_girisControl);
});

Route::get('ilanTeklifVer/{ilan_id}',['middleware'=>'auth' ,function ($ilan_id) {
  $firma = Firma::find(session()->get('firma_id'));
  $ilan = Ilan::find($ilan_id);
  $birimler=  \App\Birim::all();
  $teklifler= DB::select(DB::raw("SELECT *
    FROM teklif_hareketler th1
    JOIN (
      SELECT teklif_id, MAX( tarih ) tarih
      FROM teklifler t, teklif_hareketler th
      WHERE t.id = th.teklif_id
      AND t.ilan_id ='$ilan_id'
      GROUP BY th.teklif_id
    )th2 ON th1.teklif_id = th2.teklif_id
    AND th1.tarih = th2.tarih
    ORDER BY kdv_dahil_fiyat ASC "));

    return view('Firma.ilan.ilanDetay')->with('firma', $firma)->with('ilan', $ilan)->with('birimler',$birimler)->with('teklifler',$teklifler);
  }]);

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

  //firma ilan route... /////////////////////////////////////////////////
  Route::get('/ilanEkle/{id}/{ilan_id}', 'FirmaIlanController@showFirmaIlanEkle');

  Route::post('firmaIlanOlustur/ilanBilgileri/{id}', 'FirmaIlanController@ilanAdd');
  Route::post('firmaIlanOlustur/ilanBilgileri/{id}/{ilan_id}', 'FirmaIlanController@ilanUpdate');

  Route::post('kalemlerListesiMal/{id}', 'FirmaIlanController@kalemlerListesiMalEkle');
  Route::post('kalemlerListesiHizmet/{id}', 'FirmaIlanController@kalemlerListesiHizmetEkle');
  Route::post('kalemlerListesiGoturu/{id}', 'FirmaIlanController@kalemlerListesiGoturuEkle');
  Route::post('kalemlerListesiYapim/{id}', 'FirmaIlanController@kalemlerListesiYapimİsiEkle');

  Route::post('kalemlerListesiMalUpdate/{id}', 'FirmaIlanController@kalemlerListesiMalUpdate');
  Route::post('kalemlerListesiHizmetUpdate/{id}', 'FirmaIlanController@kalemlerListesiHizmetUpdate');
  Route::post('kalemlerListesiGoturuUpdate/{id}', 'FirmaIlanController@kalemlerListesiGoturuUpdat');
  Route::post('kalemlerListesiYapimİsiUpdate/{id}', 'FirmaIlanController@kalemlerListesiYapimİsiUpdate');

  Route::delete('mal/{id}', 'FirmaIlanController@deleteMalEkle');
  Route::delete('hizmet/{id}', 'FirmaIlanController@deleteHizmetEkle');
  Route::delete('goturu/{id}', 'FirmaIlanController@deleteGoturuEkle');
  Route::delete('yapim/{id}', 'FirmaIlanController@deleteYapimEkle');


  Route::post('firmaIlanOlustur/firmateknik/{id}', 'FirmaIlanController@firmaTeknik');
  Route::post('firmaIlanOlustur/kalemlerListesiMal/{id}', 'FirmaIlanController@kalemlerListesiMalEkle');
  Route::post('firmaIlanOlustur/kalemlerListesiHizmet/{id}', 'FirmaIlanController@kalemlerListesiHizmetEkle');
  Route::post('firmaIlanOlustur/kalemlerListesiGoturu/{id}', 'FirmaIlanController@kalemlerListesiGoturuEkle');
  Route::post('firmaIlanOlustur/kalemlerListesiYapim/{id}', 'FirmaIlanController@kalemlerListesiYapimİsiEkle');

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
  /////////////////////////////////////SET SESSION//////////////////////
  Route::get('/set_session' ,function () {

    $firmaId = Input::get('role');
    $firmaAdi = Firma::find($firmaId);
    Session::set('firma_id', $firmaId);
    Session::set('firma_adi', $firmaAdi->adi);

    return;
  });
  //////////////////////////////////////Puan Yorum //////////////////////
  Route::post('/yorumPuan/{yorum_firma_id}/{yorum_yapilan_firma}/{ilan_id}/{kullanici_id}' ,function ($yorum_firma_id,$yorum_yapilan_firma,$ilan_id,$kullanici_id,Request $request) {
    $now = new \DateTime();

    $ilan = Ilan::find($ilan_id);
    $ilan->statu = 1;
    $ilan->save();

    $puan = new App\Puanlama();
    $puan->firma_id=$yorum_yapilan_firma;
    $puan->ilan_id=$ilan_id;
    $puan->yorum_yapan_firma_id=$yorum_firma_id;
    $puan->yorum_yapan_kullanici_id=$kullanici_id;
    $puan->kriter1 = $request->puan1;
    $puan->kriter2=$request->puan2;
    $puan->kriter3=$request->puan3;
    $puan->kriter4=$request->puan4;
    $puan->tarih=$now;
    $puan->save();

    $yorum = new App\Yorum();
    $yorum->firma_id=$yorum_yapilan_firma;
    $yorum->ilan_id=$ilan_id;
    $yorum->yorum_yapan_firma_id=$yorum_firma_id;
    $yorum->yorum_yapan_kullanici_id=$kullanici_id;
    $yorum->yorum = $request->yorum;
    $yorum->tarih=$now;
    $yorum->save();
    return Redirect::back()->with($yorum_firma_id);

  });

  //////////////////////////////////////teklifGor//////////////////////
  Route::get('teklifGor/{id}/{ilanid}' ,['middleware'=>'auth' ,function ($id,$ilan_id) {
    $firma = Firma::find($id);
    $ilan = Ilan::find($ilan_id);
    $teklifler= DB::select(DB::raw("SELECT *
      FROM teklif_hareketler th1
      JOIN (
        SELECT teklif_id, MAX( tarih ) tarih
        FROM teklifler t, teklif_hareketler th
        WHERE t.id = th.teklif_id
        AND t.ilan_id ='$ilan_id'
        GROUP BY th.teklif_id
      )th2 ON th1.teklif_id = th2.teklif_id
      AND th1.tarih = th2.tarih
      ORDER BY kdv_dahil_fiyat ASC "));

      return view('Firma.ilan.ilanDetay')->with('firma', $firma)->with('ilan',$ilan)->with('teklifler',$teklifler);

    }]);
    ///////////////////////////////Kısmi Açık REkabet Kazanan //////////////////////////////////////
    Route::post('KismiAcikRekabetKazanan' ,function () {

      $ilan_id = Input::get('ilan_id');
      $ilan = App\Ilan::find($ilan_id);
      $kazanan_firma_id = Input::get('kazananFirmaId');

      if($ilan->ilan_turu == 1 && $ilan->sozlesme_turu == 0){
        $kalemler = $ilan->ilan_mallar;
      }elseif($ilan->ilan_turu == 2 && $ilan->sozlesme_turu == 0){
        $kalemler = $ilan->ilan_hizmetler;
      }elseif($ilan->ilan_turu == 3){
        $kalemler = $ilan->ilan_yapim_isleri;
      }else{
        $kalemler = $ilan->ilan_goturu_bedeller;
      }
      $kalemIdArray = Array();
      foreach ($kalemler as $kalem){
        if($ilan->ilan_turu == 1 && $ilan->sozlesme_turu == 0){
          $kazanan_fiyat = DB::select(DB::raw("SELECT *
            FROM teklifler t, mal_teklifler mt
            WHERE t.id = mt.teklif_id
            AND t.firma_id ='$kazanan_firma_id'
            AND t.ilan_id ='$ilan_id'
            AND mt.ilan_mal_id = '$kalem->id';
            ORDER BY tarih DESC
            LIMIT 1"));
          }elseif($ilan->ilan_turu == 2 && $ilan->sozlesme_turu == 0){
            $kazanan_fiyat = DB::select(DB::raw("SELECT *
              FROM teklifler t, hizmet_teklifler ht
              WHERE t.id = ht.teklif_id
              AND t.firma_id ='$kazanan_firma_id'
              AND t.ilan_id ='$ilan_id'
              AND ht.ilan_hizmet_id = '$kalem->id';
              ORDER BY tarih DESC
              LIMIT 1"));
            }elseif($ilan->ilan_turu == 3){
              $kazanan_fiyat = DB::select(DB::raw("SELECT *
                FROM teklifler t, yapim_isi_teklifler yt
                WHERE t.id = yt.teklif_id
                AND t.firma_id ='$kazanan_firma_id'
                AND t.ilan_id ='$ilan_id'
                AND yt.ilan_yapim_isleri_id = '$kalem->id';
                ORDER BY tarih DESC
                LIMIT 1"));
              }
              $kalemIdArray[]=$kalem->id;
              $kismiKazanan = new App\KismiAcikKazanan();
              $kismiKazanan->ilan_id =$ilan_id ;
              $kismiKazanan->kalem_id = $kalem->id;
              $kismiKazanan->kazanan_fiyat = $kznFiyat->kdv_dahil_fiyat;
              $kismiKazanan->kazanan_firma_id = $kazanan_firma_id;
              $kismiKazanan->save();
            }

            return Response::json($kalemIdArray);
          });
          /////////////////////////////////////Kısmi Açık Kazanan ///////////////////////////////////
          Route::post('KismiAcikKazanan' ,function () {

            $ilan_id = Input::get('ilan_id');
            $ilan = App\Ilan::find($ilan_id);
            $kazanan_firma_id = Input::get('kazananFirmaId');
            $kazanan_fiyat = Input::get('kazanan_fiyat');
            $kalem_id = Input::get('kalem_id');

            $kismiKazanan = new App\KismiAcikKazanan();
            $kismiKazanan->ilan_id =$ilan_id ;
            $kismiKazanan->kalem_id = $kalem_id;
            $kismiKazanan->kazanan_fiyat = $kazanan_fiyat;
            $kismiKazanan->kazanan_firma_id = $kazanan_firma_id;

            $kismiKazanan->save();
            return Response::json($kismiKazanan);
          });
          /////////////////////////////////////Kısmi Kapalı Kazanan ///////////////////////////////////
          Route::post('KismiKapaliKazanan' ,function () {
            $ilan_id = Input::get('ilan_id');
            $kazanan_firma_id = Input::get('kazananFirmaId');
            $kazanan_fiyat = Input::get('kazananFiyat');

            $kismiKazanan = new App\KismiKapaliKazanan();
            $kismiKazanan->ilan_id =$ilan_id ;
            $kismiKazanan->kazanan_fiyat =  $kazanan_fiyat;
            $kismiKazanan->kazanan_firma_id = $kazanan_firma_id;

            $kismiKazanan->save();
            return Response::json($kismiKazanan);
          });
          ///////////////////////////////////// Rekabet //////////////////////////////////////
          Route::get('rekabet/{ilan_id}' ,function ($ilanid) {
            $ilan = App\Ilan::find($ilanid);
            $teklifler= DB::select(DB::raw("SELECT *
              FROM teklif_hareketler th1
              JOIN (
                SELECT teklif_id, MAX( tarih ) tarih
                FROM teklifler t, teklif_hareketler th
                WHERE t.id = th.teklif_id
                AND t.ilan_id ='$ilanid'
                GROUP BY th.teklif_id
              )th2 ON th1.teklif_id = th2.teklif_id
              AND th1.tarih = th2.tarih
              ORDER BY kdv_dahil_fiyat ASC "));
              return Response::json(View::make('Firma.ilan.rekabet',array('teklifler'=> $teklifler,'ilan'=>$ilan))->render());


            });
            /////////////////////////////////////teklif Gönder /////////////////////////////////
            Route::post('/teklifGonder/{firma_id}/{ilan_id}/{kullanici_id}' ,function ($firma_id,$ilan_id,$kullanici_id,Request $request) {


              DB::beginTransaction();

              try {
                $now = new Carbon();

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
                    $ilan_goturu_teklifler->kdv_dahil_fiyat = $arrayFiyat[$i] * ($ilan_goturu->miktar)*(1+$arrayKdv[$i]/100);
                    $ilan_goturu_teklifler->kdv_orani = $arrayKdv[$i];
                    $ilan_goturu_teklifler->kdv_haric_fiyat=$arrayFiyat[$i];
                    $ilan_goturu_teklifler->tarih= $now;
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
                $firma_kullanici = DB::table('firma_kullanicilar')->where('kullanici_id',$kullanici_id)->where('firma_id',$firma_id)->get();
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
                // all good
              } catch (\Exception $e) {
                $error="error";
                DB::rollback();
                return Response::json($error);
              }
              //return Redirect::to('firmaIslemleri/'.$firma_id);

            });
            ////////////////////////ilan detay ///////////////////////////
            Route::get('ilanDetay', function () {
              $ilan_id = Input::get('ilan_id');
              $ilan = Ilan::find($ilan_id);
              return Response::json($ilan);
            });

            Route::get('/ajax-subcat', function (Request $request) {

              $il_id = Input::get('il_id');
              $ilceler = \App\Ilce::where('il_id', '=', $il_id)->get();
              return Response::json($ilceler);
            });
            Route::get('/ajax-subcatt', function () {
              $ilce_id = Input::get('ilce_id');
              $semtler = \App\Semt::where('ilce_id', '=', $ilce_id)->get();
              return Response::json($semtler);
            });
            Route::get('/vergi_daireleri', function (Request $request) {

              $il_id = Input::get('il_id');
              $vergi_daireleri = \App\VergiDairesi::where('il_id', '=', $il_id)->get();
              return Response::json($vergi_daireleri);
            });
            Route::get('/ticaret_odalari', function (Request $request) {

              $il_id = Input::get('il_id');
              $ticaret_odalari = \App\TicaretOdasi::where('il_id', '=', $il_id)->get();
              return Response::json($ticaret_odalari);
            });

            Route::auth();
