<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.login', [

            "title" => "Login",
            
        ]);
    }

}
