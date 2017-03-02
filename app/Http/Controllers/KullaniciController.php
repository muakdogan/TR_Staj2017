<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Password;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Firma;

class KullaniciController extends Controller
{
  use ResetsPasswords;

    protected $subject = "Your Account Password";

    public function __construct(Guard $auth, PasswordBroker $passwords)
    {
        $this->auth = $auth;
        $this->passwords = $passwords;
        // $this->subject = 'Your Account Password';
        $this->middleware('guest');
    }

    public function notify(Request $request, $id)
    {
        $firma = Firma::find($id);
           $roller=  App\Rol::all();
            
        
          $kullanici= new App\Kullanici();
          $kullanici->adi = Str::title(strtolower($request->adi));
          $kullanici->soyadi = Str::title(strtolower($request->soyadi));
          $kullanici->email = $request->email;
          $kullanici->save();
          
            $user = $kullanici->user ?: new App\User();
           
            $user->email = $request->email;
            
            $user->password =Hash::make('tamrekabet');

            $rol=$request->rol;

            $kullanici->users()->save($user);
             
            $firma->kullanicilar()->attach($kullanici,['rol_id'=>$rol]);
             
            $data = ['ad' => $request->adi, 'soyad' => $request->soyadi];
        
            dump( $this->passwords->sendResetLink(
                ['email' => $request->email]),
                function($message){
                    $message->subject('Your Account Password');
                }
            );
            return view('Kullanici.kullaniciIslemleri')->with('firma',$firma)->with('roller',$roller);
    }
    
}
