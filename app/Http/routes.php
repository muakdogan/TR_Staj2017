<?php
use App\Form;
use App\iller;
use App\Il;
use App\ilceler;
use App\semtler;
use App\adresler;
use App\adres_turleri;
use App\Sektor;
use App\Firma;
use App\FirmaReferans;
use App\iletisim_bilgileri;
use App\FirmaSatilanMarka;
use App\TicariBilgi;
use App\TicaretOdasi;
use App\Adres;
use App\Ilce;
use App\Semt;
use App\Ilan;
use App\Teklif;
use App\MaliBilgi;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Mail\Mailer;
use Barryvdh\Debugbar\Facade as Debugbar;

Route::get('/sessionKill', function () {
  Auth::logout();
  Session::flush();
  return Redirect::to('/');
});

Route::get('/DbTest', function () {
  if( DB::connection()->getDatabaseName() ){
    echo 'Connected Database : ',DB::connection()->getDatabaseName();
  }
});

Route::group(['middleware' => ['web']], function () {
  //Login Routes...

  //public/admin/login
  //public in altındaki klasörün içine yönlendiriyor
  Route::get('/admin/login','AdminAuth\AuthController@showLoginForm');


  Route::post('/admin/login','AdminAuth\AuthController@login');
  //Route::get('/admin/logout','AdminAuth\AuthController@logout');
  Route::get('/admin/logout','AdminAuth\AuthController@logout');
  // Registration Routes...
  Route::get('admin/register', 'AdminAuth\AuthController@showRegistrationForm');
  Route::post('admin/register', 'AdminAuth\AuthController@register');

  Route::post('admin/password/email','AdminAuth\PasswordController@sendResetLinkEmail');
  Route::post('admin/password/reset','AdminAuth\PasswordController@reset');
  Route::get('admin/password/reset/{token?}','AdminAuth\PasswordController@showResetForm');

  Route::get('/admin/dashboard', 'AdminController@index');
  Route::post('/admin/firmaOnay', 'AdminController@firmaOnay')->name('firmaOnaySubmit');//form submit butonu isimli rota istedi


});

Route::get('/password/reset/{belirleme}/{token?}','Auth\PasswordController@showResetForm');

Route::get('/admin/kalemlerTablolari',['middleware' => 'admin' , function () {
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

Route::get('/findChildrenTree/{sektor_id}', function ($sektor_id) {
  $id = Input::get('id');
  $kalemler = DB::select( DB::raw("SELECT adi as 'title',id as 'key',
    (SELECT (CASE WHEN COUNT(*) > 0 THEN 'true' END) from kalemler as k2 where k1.id= k2.parent_id)  as folder,
    (SELECT (CASE WHEN COUNT(*) > 0 THEN 'true' END) from kalemler as k3 where k1.id= k3.parent_id)  as lazy, is_aktif
    FROM kalemler as k1
    where k1.parent_id = '$id' AND sektor_id= '$sektor_id'"  ));

    return Response::json($kalemler);

  });

  Route::get('/getSektorler', function (Request $request) {

              $mal_turu= Input::get('mal_turu');
              if($mal_turu!=3){
                $sektorler = \App\Sektor::where('kalem_turu', '=', $mal_turu)->orWhere('kalem_turu','=',4)->get();
                DebugBar::info("if");
              }
              else{

                $sektorler = \App\Sektor::where('kalem_turu', '=', $mal_turu)->get();
                DebugBar::info("else");
              }
              DebugBar::info($sektorler);
              return Response::json($sektorler);

   });

  Route::get('/admin/tablesControl',['middleware' => 'admin' , function () {
    return view('admin.genproduction.projects');
  }]);//admin.index

  Route::get('/admin/api/v1/admins/{id?}', 'Admins@index');
  Route::post('/admin/api/v1/admins', 'Admins@store');
  Route::post('/admin/api/v1/admins/{id}', 'Admins@update');
  Route::delete('/admin/api/v1/admins/{id}', 'Admins@destroy');

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

Route::get('/admin/firmaList', 'AdminController@firmaList');

Route::get('/firmaListeOnaylı',function (){

  $onayli = DB::table('firmalar')
  ->where('onay', 1)->orderBy('olusturmaTarihi', 'desc') ->paginate(2, ['*'], '2pagination');

  return Response::json(View::make('admin.firmaListOnayli',array('onayli'=> $onayli))->render());
});

Route::get('/admin/yorumList', 'AdminController@yorumList');

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

Route::get('/admin/yorumOnay/{id}/{yorum_kul_id}', 'AdminController@yorumOnay');

Route::get('/kullaniciIslemleri', 'KullaniciController@kullaniciIslemleri');
Route::get('/kullaniciBilgileri', 'KullaniciController@kullaniciBilgileri');
Route::post('/kullaniciBilgileriUpdate/{id}/{kul_id}','KullaniciController@kullaniciBilgileriUpdate');

Route::post('/kullaniciBilgileriSifre/{id}/{user_id}', function (Request $request,$id,$user_id) {
  $firma = Firma::find($id);

  $user= App\User::find($user_id);
  $user->email = $request->email;
  $user->password =Hash::make( $request->sifre);

  return view('Kullanici.kullaniciBilgileri')->with('firma',$firma);
});
Route::post('/kullaniciIslemleriEkle/{id}', 'KullaniciController@kullaniciIslemleriEkle');
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
  $kullanici = DB::table('kullanicilar')
  ->join('firma_kullanicilar', 'kullanicilar.id', '=', 'firma_kullanicilar.kullanici_id')
  ->select('kullanicilar.*', 'firma_kullanicilar.rol_id', 'firma_kullanicilar.unvan')
  ->where('kullanicilar.id', $kullanici_id)->first();

  return Response::json($kullanici);
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
Route::get('/firmaDetay/{firma_id}', 'FirmaController@firmaDetay');
Route::get('/davetEdildigim', 'IlanController@davetEdildigimIlanlar');

Route::get('/image/{id}', ['middleware'=>'auth',function ($id) {
  $firmas = Firma::find($id);
  return view('firmas.upload')->with('firmas', $firmas);
}]);

// 'FirmaController@firmaKayitFormValidator',
Route::get('/firmaKayit', function () {
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


  return view('Firma.genFirmaKayit')->with('iller', $iller)->with('sektorler',$sektorler)->with('iller_query',$iller_query);
  // Önceki Hali "Firma.firmaKayit" Güncel Hali "Firma.genFirmaKayit"
});

Route::get('/yeniFirmaKaydet' ,function () {
  $kullanici_id=  App\Kullanici::find(session()->get('kullanici_id'));
  $iller = App\Il::all();
  $sektorler= App\Sektor::all();
  return view('Firma.yeniFirmaKaydet')->with('iller', $iller)->with('sektorler',$sektorler)->with('kullanici_id',$kullanici_id);
});

Route::get('/firmaIslemleri/{id}',['middleware'=>'auth', function ($id) {
  $firma = Firma::find($id);

  if (Gate::denies('show', $firma)) {
    return Redirect::to('/');
  }
  $davetEdilIlanlar = App\BelirliIstekli::where('firma_id',$firma->id)->get();
  $ilanlarFirma = $firma->ilanlar()->orderBy('yayin_tarihi','desc')->limit('5')->get();
  $teklifler= Teklif::where('firma_id',$firma->id)->limit(5)->get();
  $tekliflerCount= DB::table('teklifler')->where('firma_id',$firma->id)->count();

  return view('Firma.firmaIslemleri')->with('firma',$firma)->with('davetEdilIlanlar', $davetEdilIlanlar)
          ->with('ilanlarFirma', $ilanlarFirma)->with('teklifler', $teklifler)->with('tekliflerCount', $tekliflerCount);
}]);



Route::post('/ilanAra', 'IlanController@showIlan');
Route::get('/ilanAra', 'IlanController@showIlan');
Route::get('/ilanAra/{page}', 'IlanController@showIlan');

Route::post('/firmaHavuzu', 'FirmaController@showFirmalar');
Route::get('/firmaHavuzu', 'FirmaController@showFirmalar');
Route::get('/firmaHavuzu/{page}', 'FirmaController@showFirmalar');
Route::get('/onayliTedarikciEkle',  'FirmaController@onayliTedarikciEkle'); /// Tüm firmalar Sekmesinin Controlleri fonksiyonu
Route::get('/onayliTedarikciCikar',  'FirmaController@onayliTedarikciCikar'); /// Tüm firmalar Sekmesinin Controlleri fonksiyonu
Route::get('/onayliTedarikcilerim',  'FirmaController@onayliTedarikcilerim'); /// onayli firmalar sekmesinin controller fonksiyonu

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

Route::post('/form', 'Auth\AuthController@kayitForm');

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

Route::get('ilanlarim/{firma_id}', 'IlanController@ilanlarim');

Route::get('basvurularim/{firma_id}', 'IlanController@basvurularim');

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

Route::get('/onayli/','IlanController@getOnayliTedarikciler');

Route::get('/belirli/','IlanController@getBelirliFirmalar');

Route::get('/basvuruControl/',function (){
  $firma_id = session()->get('firma_id');
  $ilan_id = Input::get('ilan_id');
  $sektorler =  \App\FirmaSektor::where('firma_sektorler.firma_id', '=',session()->get('firma_id'))
  ->select('sektor_id');
  $sektorler = $sektorler->get()->toArray();
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
    $kullanici = App\Kullanici::find(session()->get('kullanici_id'));

    return view('Firma.ilan.ilanDetay')->with('firma', $firma)->with('ilan', $ilan)
            ->with('birimler',$birimler)->with('teklifler',$teklifler);
  }]);

  Route::get('/ilanOlustur/{firma_id}', 'IlanController@ilanOlustur');

  Route::post('/ilanOlusturEkle/{firma_id}', 'IlanController@ilanOlusturEkle');

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
  Route::get('/firmaProfili', 'FirmaController@showFirma');
  Route::get('/uyelikBilgileri', 'FirmaController@uyelikBilgileri');
  Route::get('/firma/{ref_id?}',function($ref_id){
    $referans=  FirmaReferans::find($ref_id);
    return Response::json($referans);

  });
  Route::get('/firmabrosur/{brosur_id?}',function($brosur_id){
    $brosur= App\FirmaBrosur::find($brosur_id);
    return Response::json($brosur);
  });

    Route::get('/ilanDuzenle/{firmaID}/{ilanID}', 'IlanController@ilanDuzenle');
    Route::post('/ilanDuzenle/{firmaID}/{ilanID}', 'IlanController@ilanDuzenleSubmit');

  //firma ilan route... /////////////////////////////////////////////////

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
  Route::post('/yorumPuan/{yorum_firma_id}/{yorum_yapilan_firma_id}/{ilan_id}/{kullanici_id}' ,function ($yorum_firma_id,$yorum_yapilan_firma_id,$ilan_id,$kullanici_id,Request $request) {
    $now = new \DateTime();

    $ilan = Ilan::find($ilan_id);
    $ilan->statu = 1;
    $ilan->save();

    $puan = new App\Puanlama();
    $puan->firma_id=$yorum_yapilan_firma_id;
    $puan->ilan_id=$ilan_id;
    $puan->yorum_yapan_firma_id=$yorum_firma_id;
    $puan->yorum_yapan_kullanici_id=$kullanici_id;
    $puan->kriter1 = $request->puan1;
    $puan->kriter2=$request->puan2;
    $puan->kriter3=$request->puan3;
    $puan->kriter4=$request->puan4;
    $puan->tarih=$now;
    $puan->save();

    $yorum_yapilan_firma = Firma::find($yorum_yapilan_firma_id);
    $yorum_yapilan_firma->puanlariGuncelle();
    $yorum_yapilan_firma->save();

    $yorum = new App\Yorum();
    $yorum->firma_id=$yorum_yapilan_firma_id;
    $yorum->ilan_id=$ilan_id;
    $yorum->yorum_yapan_firma_id=$yorum_firma_id;
    $yorum->yorum_yapan_kullanici_id=$kullanici_id;
    $yorum->yorum = $request->yorum;
    $yorum->tarih=$now;
    $yorum->save();
    return Redirect::back()->with($yorum_firma_id);

  });


Route::get('kismiRekabet/{firmaID}/{ilanID}' ,'KismiRekabetService@kismiRekabetService');

Route::get('teklifGor/{id}/{ilanid}' ,'IlanController@teklifGor');
Route::get('ilaniPasifEt' ,'IlanController@ilaniPasifEt');
Route::get('ilaniAktifEt' ,'IlanController@ilaniAktifEt');

  ///////////////////////////////Kısmi Açık REkabet Kazanan ///////////
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
          $firma_id = session()->get('firma_id');
          $ilanSahibi=0;
          if($firma_id == $ilan->firmalar->id){
              $ilanSahibi=1;
          }
            $teklifler = $ilan->teklif_hareketler()->whereRaw('tarih IN (select MAX(tarih) FROM teklif_hareketler GROUP BY teklif_id)')->get();

            $minFiyat = $ilan->minFiyat();
            $kazanK = null;
            if($ilan->kismi_fiyat == 0){
                $kazananKapali = App\KismiKapaliKazanan::where("ilan_id",$ilan->id)->get(); /////ilanın kazananı var mı kontrolü
                $kisKazanCount=0;

                foreach($kazananKapali as $kazanK){
                    $kisKazanCount=1;
                }
            }
            else{
                $kazananKapali = App\KismiAcikKazanan::where("ilan_id",$ilan->id)->get(); /////ilanın kazananı var mı kontrolü
                $kisKazanCount=0;
                foreach($kazananKapali as $kazanK){
                    $kisKazanCount=1;
                }
            }
            return View::make('Firma.ilan.rekabet',array('teklifler'=> $teklifler,'ilanSahibi'=> $ilanSahibi,'ilan'=>$ilan,'minFiyat'=>$minFiyat,'kazanK'=>$kazanK,'kisKazanCount'=>$kisKazanCount))->render();

        });

Route::post('/teklifGonder/{firma_id}/{ilan_id}/{kullanici_id}', 'IlanController@teklifGonder');
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

Route::get('kullanici/onay/{kullanici_id}/{token}', 'Auth\AuthController@activateUser')->name('kullanici.onay');
