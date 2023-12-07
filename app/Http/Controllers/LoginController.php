<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use App\Http\Controllers\LoginController;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.login', [

            "title" => "Login",
            
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email/nomor_hp' => 'required',
            'password' => 'required'
        ]);

        if(Auth::guard('akun_user')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'email/nomor hp atau password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
