<?php

namespace App\Http\Controllers\Auth;

use App\Factories\ActivationFactory;
use App\Kullanici;
use Validator;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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

    public function kayitForm(Request $request)
    {

        $this->validate($request, [
          'firma_adi' => 'required|max:255',
          'sektor_id[]' => 'required'

        ]);




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
            else if ($request->adres_kopyalayici == "kopyala")
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
