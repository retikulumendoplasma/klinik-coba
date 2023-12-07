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
            'nik' => [
                'required',
                Rule::exists('penduduk','nik')->where(function($query) {
                    $query->where('status_akun', '!=', 'terdaftar');
                }),
            ],
            'password' => 'required|min:6'
        ]);

        $penduduk = penduduk::where('nik', $request->nik)->first();

        $validatedData['password'] = bcrypt($validatedData['password']);

        akun_user::create($validatedData);
        $penduduk->update(['status_akun' => 'terdaftar', 'nik' => $penduduk->nik]);

        return redirect('/login')->with('success', 'Registrasi Berhasil');
    }
}
