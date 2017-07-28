<?php

namespace App\Http\Controllers\Auth;

use App\Kullanici;
use Validator;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

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
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
}
