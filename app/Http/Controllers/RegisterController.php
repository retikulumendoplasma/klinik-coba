<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\RegisterController;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register.register', [

            "title" => "Register",

        ]);
    }
}
