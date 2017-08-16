<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectTo = '/';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $belirleme = null, $token = null)
    {        
        if (is_null($token)) {
            return $this->getEmail();
        }
        $email = $request->input('email');

        $butonString = $belirleme == 1 ? "Şifre Belirle" : "Şifre Değiştir";

        if (property_exists($this, 'resetView')) {
            return view($this->resetView)->with(compact('token', 'email', 'butonString'));
        }

        if (view()->exists('auth.passwords.reset')) {
            return view('auth.passwords.reset')->with(compact('token', 'email', 'butonString'));
        }

        return view('passwords.auth.reset')->with(compact('token', 'email', 'butonString'));
    }
}
