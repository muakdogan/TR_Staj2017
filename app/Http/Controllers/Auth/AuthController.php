<?php

namespace App\Http\Controllers\Auth;

use App\Factories\ActivationFactory;
use App\Kullanici;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Response;

//use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
            //auth/login?redirectTo='Firma.ilan.ilanAra';
             protected $redirectPath = '/';

            //protected $redirectTo = '/';

    protected $activationFactory;

    protected function authenticated(Request $request, Kullanici $user)
    {
        //set the session varibles after login - mete 8May17
        $request->session()->put('kullanici_id', $user->id);
        $request->session()->put('kullanici_adi', $user->adi . " " . $user->soyadi);
        //birden fazla firma olunca aşağısı değişecek
        $firma_id = $user->firmalar()->first()->id;
        $request->session()->put('firma_id', $firma_id);
        $request->session()->put('firma_adi', $user->firmalar()->first()->adi);
        $role_id = $user->get_role_id($firma_id);
        $request->session()->put('role_id', $user->get_role_id($firma_id));

        //Kullanıcının onayli field'ına bak, onaylı değilse login'e izin verme
        if (!$user->onayli) {
            $this->activationFactory->sendActivationMail($user);
            auth()->logout();
            Session::flush();
            return back()->with('activationWarning', true);
        }

        return redirect()->intended($this->redirectPath());
    }
    public function getLogout(){
        Auth::logout();
        Session::flush();
        return Redirect::to('/');
    }



    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(ActivationFactory $activationFactory)
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);

        $this->activationFactory = $activationFactory;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return \App\Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

    }

    public function activateUser($kullanici_id, $token)
    {
        if ($user = $this->activationFactory->activateUser($kullanici_id, $token)) {
            auth()->login($user);
            return redirect($this->redirectPath());
        }
        abort(404);
    }

    protected function formatValidationErrors(Validator $validator)
    {
      if ($validator->fails()) {
           return redirect('firmaKayit')
                       ->withErrors($validator)
                       ->withInput();
       }
      //  return $validator->errors()->all();
    }

    public function kayitForm(Request $request)
    {
        $ilceler = \App\Ilce::where('il_id', $request->il_id)->get();
        $semtler = \App\Semt::where('ilce_id', $request->ilce_id)->get();
        $vergi_iller = \App\VergiDairesi::where('il_id', $request->vergi_daire_il)->get();

        $faturaIlceler = \App\Ilce::where('il_id', $request->fatura_il_id)->get();
        $faturaSemtler = \App\Semt::where('ilce_id', $request->fatura_ilce_id)->get();



        $ilcelerString = "";
        foreach ($ilceler as $i)
        {
          $ilcelerString = $ilcelerString.$i->id.",";
        }


        $semtlerString = "";
        foreach ($semtler as $s)
        {
          $semtlerString = $semtlerString.$s->id.",";
        }

        $vergi_illerString = "";
        foreach ($vergi_iller as $v)
        {
          $vergi_illerString = $vergi_illerString.$v->id.",";
        }



        $faturaIlcelerString = "";
        foreach ($faturaIlceler as $fi)
        {
          $faturaIlcelerString = $faturaIlcelerString.$fi->id.",";
        }

        $faturaSemtlerString = "";
        foreach ($faturaSemtler as $fs)
        {
          $faturaSemtlerString = $faturaSemtlerString.$fs->id.",";
        }




        //Validation Helper By Özenç Çelik
        //unique:firmalar,adi =>  Database içerisindeki firmalar tablosunun adi sütununda unique olup olmadığını kontrol ediyor.
        //exists:iller,id => İller tablosunun id sütununda var olup olmadığını kontrol ediyor.
        //same:ilce->il_id => İlce satırının içerisindeki ,il_id sütunu ile aynı olup olmadığını kontrol ediyor.
        $this->validate($request, [
          'firma_adi' => 'required|unique:firmalar,adi|min:2',//unique:firmalar'ı bulmuyor
          'sektor_id' => 'required',//???????????????????????????????????????
          'telefon' => 'required|min:10|numeric',
          'il_id' => 'required|integer|exists:iller,id',
          'ilce_id' => 'required|integer|exists:ilceler,id|in:'.$ilcelerString,
          'semt_id' => 'required|integer|exists:semtler,id|in:'.$semtlerString,
          'firma_adres' => 'required',
          'adi' => 'required|string',
          'soyadi' => 'required|string',
          'unvan' => 'required|string',
          'telefonkisisel' => 'required|min:10|numeric',
          'email_giris' => 'required|email|unique:kullanicilar,email',
          'password' => 'required',
          'password_confirmation' => 'required|same:password',
          'fatura_tur' => 'required',
          'vergi_daire_il' => 'required|integer|exists:iller,id',
          'vergi_daire' => 'exists:vergi_daireleri,id|required|integer|in:'.$vergi_illerString,

        ],[
          //Error Messages
          'firma_adi.required' => 'Lütfen firma adını giriniz.',
          'firma_adi.unique' => 'Aynı isimli bir başka firma sistemimizde kayıtlıdır.',
          'firma_adi.max' => 'Firma adı 2 karakterden az olamaz.',

          'sektor_id.required' => 'En az 1 sektör seçmelisiniz.',

          'telefon.required'=> 'Lütfen telefon numarası giriniz.',
          'telefon.min'=> 'Telefon numarası 10 haneden az olamaz!!!',
          'telefon.numeric'=> 'Telefon numarasına sayısal değerler girmelisiniz.',

          'il_id.required'=> 'Lütfen il seçiniz.',
          'il_id.exists'=> 'Sistemimizde kayıtlı olmayan bir il seçtiniz.Lütfen tekrar deneyin',
          'il_id.integer'=> 'İl id si integer olması gerekiyor.',

          'ilce_id.required'=> 'Lütfen ilçe seçiniz.',
          'ilce_id.exists'=> 'Sistemimizde kayıtlı olmayan bir ilçe seçtiniz.Lütfen tekrar deneyin',
          'ilce_id.integer'=> 'İlçe id si integer olması gerekiyor.',
          'ilce_id.in'=> 'İl e ait olmayan bir ilçe seçtiniz.',

          'semt_id.required'=> 'Lütfen semt seçiniz.',
          'semt_id.exists'=> 'Sistemimizde kayıtlı olmayan bir semt seçtiniz.Lütfen tekrar deneyin',
          'semt_id.integer'=> 'Semt id si integer olması gerekiyor.',
          'semt_id.in' => 'İlçeye ait olamyan bir semt seçtiniz',

          'firma_adres.required'=> 'Lütfen firma adresi giriniz.',

          'adi.required' => 'Lütfen kullanıcı adını giriniz.',
          'adi.string' => 'Kulanıcı adı sadece harflerden oluşmalıdır!!!',

          'soyadi.required' => 'Lütfen kullanıcı soyadını giriniz.',
          'soyadi.string' => 'Kulanıcı soyadı sadece harflerden oluşmalıdır!!!',

          'unvan.required' => 'Lütfen ünvan giriniz.',
          'unvan.string' => 'Kulanıcı ünvani sadece harflerden oluşmalıdır!!!',

          'telefonkisisel.required'=> 'Lütfen telefon numarası giriniz.',
          'telefonkisisel.min'=> 'Telefon numarası 10 haneden az olamaz!!!',
          'telefonkisisel.numeric'=> 'Telefon numarasına sayısal değerler girmelisiniz.',

          'email_giris.required' => 'Lütfen email adresi giriniz.',
          'email_giris.email' => 'Geçersiz bir email adresi girdiniz.',
          'email_giris.unique' => 'Email sistemimizde kayıtlıdır. Lütfen farklı bir email giriniz',

          'password.required' => 'Lütfen kullanıcı şifrenizi giriniz.',

          'password_confirmation.required' => 'Lütfen kullanıcı şifrenizi giriniz.',
          'password_confirmation.same' => 'Giridiğiniz şifreler aynı değil',

          'fatura_tur.required' => 'Lütfen fatura türünü seçiniz(Kurumsal yada Bireysel).',

          'vergi_daire_il.required'=> 'Lütfen vergi dairesinin bulundğu ili seçiniz.',

          'vergi_daire_il.integer'=> 'Vergi Dairesi İl id si integer olması gerekiyor.',

          'vergi_daire.exists'=> 'Sistemimizde kayıtlı olmayan bir vergi dairesi seçtiniz.Lütfen tekrar deneyin',
          'vergi_daire.required'=> 'Lütfen vergi dairesi seçiniz.',
          'vergi_daire.integer'=> 'Vergi Dairesi id si integer olması gerekiyor.',
          'vergi_daire.in'=> 'İl i olmayan bir vergi dairesi seçemezsiniz'

        ]);
        if($request->fatura_tur == "kurumsal"){
          $this->validate($request, [
            'firma_unvan' => 'required|string',
            'vergi_no' => 'required|integer'
          ],[//Error Messages
            'firma_unvan.required' => 'Lütfen firma ünvanını giriniz.',
            'firma_unvan.string' => 'Firma ünvanı sadece harflerden oluşmalıdır!!!',

            'vergi_no.required' => 'Lütfen vergi numarasını giriniz.',
            'vergi_no.integer' => 'Vergi numarası sadece numaralardan oluşmaslıdır!!!'

          ]);
        }
        if($request->fatura_tur == "bireysel"){
          $this->validate($request, [
            'ad_soyad' => 'required|string',
            'tc_kimlik' => 'required'
          ],[//Error Messages
            'ad_soyad.required' => 'Lütfen kullanıcı adını ve soyadını giriniz.',
            'ad_soyad.string' => 'Kulanıcı adı ve soyadı sadece harflerden oluşmalıdır!!!',
          ]);
        }

        if ($request->adres_kopyalayici == null){//Firma Adresi ile Fatura Adresi aynı değil.

          //for fatura_il_id,fatura_ilce_id
          $fatura_ilce = \App\Ilce::find($request->fatura_ilce_id);
          $fatura_semt = \App\Semt::find($request->fatura_semt_id);

          $this->validate($request, [
            'fatura_adres' => 'required',
            'fatura_il_id' => 'required|integer|exists:iller,id',
            'fatura_ilce_id' => 'required|integer|exists:ilceler,id|in:'.$faturaIlcelerString,
            'fatura_semt_id' => 'required|integer|exists:semtler,id|in:'.$faturaSemtlerString
          ],[//Error Messages

            'fatura_adres.required' => 'Lütfen Fatura Adresi Giriniz.',

            'fatura_il_id.required'=> 'Lütfen il seçiniz.',
            'fatura_il_id.exists'=> 'Sistemimizde kayıtlı olmayan bir il seçtiniz.Lütfen tekrar deneyin',
            'fatura_il_id.integer'=> 'İl id si integer olması gerekiyor.',

            'fatura_ilce_id.required'=> 'Lütfen ilçe seçiniz.',
            'fatura_ilce_id.exists'=> 'Sistemimizde kayıtlı olmayan bir ilçe seçtiniz.Lütfen tekrar deneyin',
            'fatura_ilce_id.integer'=> 'İlçe id si integer olması gerekiyor.',
            'fatura_ilce_id.in'=> 'İle e ait olamyan bir ilçe seçemezsiniz',

            'fatura_semt_id.required'=> 'Lütfen semt seçiniz.',
            'fatura_semt_id.exists'=> 'Sistemimizde kayıtlı olmayan bir semt seçtiniz.Lütfen tekrar deneyin',
            'fatura_semt_id.integer'=> 'Semt id si integer olması gerekiyor.',
            'fatura_semt_id.in'=> 'İlçe ye ait olamyan bir semt seçemezsiniz'
          ]);
        }


        DB::beginTransaction();

        try {
            $firma= new \App\Firma();

            $firma->adi= Str::title(strtolower($request->firma_adi));
            $now = new \DateTime();
            $firma->olusturmaTarihi=$now;
            $firma->save();

            $iletisim = $firma->iletisim_bilgileri ?: new \App\IletisimBilgisi();
            $iletisim->telefon = $request->telefon;
            $iletisim->email = $request->email;
            $firma->iletisim_bilgileri()->save($iletisim);

            $adres = $firma->adresler()->where('tur_id', '=', '1')->first() ?: new  \App\Adres();
            $adres->il_id = $request->il_id;
            $adres->ilce_id = $request->ilce_id;
            $adres->semt_id = $request->semt_id;
            $adres->adres =Str::title(strtolower( $request->firma_adres));
            $tur = 1;
            $adres->tur_id = $tur;
            $firma->adresler()->save($adres);

            if ($request->adres_kopyalayici == null)
            {
                $fatura_adres = new \App\Adres();
                $fatura_adres->il_id = $request->fatura_il_id;
                $fatura_adres->ilce_id = $request->fatura_ilce_id;
                $fatura_adres->semt_id = $request->fatura_semt_id;
                $fatura_adres->adres = Str::title(strtolower( $request->fatura_adres));
                $fatura_adres->tur_id = 2;
                $firma->adresler()->save($fatura_adres);
            }
            else if ($request->adres_kopyalayici == "on")
            {
                $fatura_adres = new \App\Adres();
                $fatura_adres->il_id = $request->il_id;
                $fatura_adres->ilce_id = $request->ilce_id;
                $fatura_adres->semt_id = $request->semt_id;
                $fatura_adres->adres = Str::title(strtolower( $request->firma_adres));
                $fatura_adres->tur_id = 2;
                $firma->adresler()->save($fatura_adres);
            }

            $mali = new \App\MaliBilgi();

            if ($request->fatura_tur == "kurumsal")
            {
                $mali->unvani = $request->firma_unvan;
                $mali->vergi_numarasi = $request->vergi_no;
            }

            else if ($request->fatura_tur == "bireysel")
            {
                $mali->unvani = $request->ad_soyad;
                $mali->vergi_numarasi = $request->tc_kimlik;
            }

            $mali->vergi_dairesi_id = $request->vergi_daire;

            $firma->mali_bilgiler()->save($mali);

            $firma->sektorler()->attach($request->sektor_id);

            $kullanici= new \App\Kullanici();
            $kullanici->adi = Str::title(strtolower($request->adi));
            $kullanici->soyadi = Str::title(strtolower( $request->soyadi));
            $kullanici->email = $request->email_giris;
            $kullanici->password = Hash::make( $request->password);
            $kullanici->telefon = $request->telefonkisisel;
            $kullanici->save();

            $firma->kullanicilar()->attach($kullanici,['rol_id'=>1, 'unvan'=>Str::title(strtolower($request->unvan))]);

            /*$data = ['ad' => $request->adi, 'soyad' => $request->soyadi];

            Mail::send('auth.emails.mesaj', $data, function($message) use($data,$request)
            {

            $message->to($request->email, $data['ad'])
            ->subject('YENİ KAYIT OLMA İSTEĞİ!');

            });*/

            $this->activationFactory->sendActivationMail($kullanici);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json($e);

        }

    }
}
