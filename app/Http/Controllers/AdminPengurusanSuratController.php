<?php

namespace App\Http\Controllers;

use App\Models\pengaju_surat;
use Illuminate\Http\Request;

class AdminPengurusanSuratController extends Controller
{
    public function tampildata()
    {
        return view('dashBoard.kelolaSurat', [
            //pengisian berita
            "title" => "Data Surat",
            //data berita sudah tersimpan dalam models berita
            "dataSurat" => pengaju_surat::all()
        ]);
    }
    public function lihat(pengaju_surat $surat)
    {
        return view('/dashBoard.viewsurat', [
            "title" => "Lihat surat",
            //data surat sudah tersimpan dalam models surat
            "data" => $surat
        ]);
    }
}
