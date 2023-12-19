<?php

namespace App\Http\Controllers;

use App\Models\penduduk;
use Illuminate\Http\Request;

class adminDataPendudukController extends Controller
{
    public function index()
    {
        return view('dashBoard.dataPenduduk', [
            //pengisian berita
            "title" => "Data Penduduk",
            //data berita sudah tersimpan dalam models berita
            "datapenduduk" => penduduk::all()
        ]);
    }
}
