<?php

namespace App\Http\Controllers;

use App\Models\akun_user;
use App\Models\penduduk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
//use App\Http\Controllers\RegisterController;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register.register', [

            "title" => "Register",
            "active" => "register"

        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'email/nomor_hp' => 'required',
            'nik' => 'string',
            'password' => 'required|min:6'
        ]);

        $validatedData['is_admin'] = '0';
        $validatedData['password'] = bcrypt($validatedData['password']);

        // dd($validatedData);
        akun_user::create($validatedData);

        return redirect('/')->with('success', 'Registrasi Berhasil');
    }
}
