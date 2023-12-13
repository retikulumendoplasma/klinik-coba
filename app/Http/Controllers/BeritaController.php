<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\berita;

class BeritaController extends Controller
{
    //controller untuk menampilkan tampilan pada halaman berita
    public function index()
    {
        return view('berita', [
            //pengisian berita
            "title" => "berita",
            //data berita sudah tersimpan dalam models berita
            "berita" => berita::all()
        ]);
    }

    public function home()
    {
        return view('home', [
            "title" => "Home",
            //data berita sudah tersimpan dalam models berita
            "berita" => berita::all()
        ]);
    }

    //controller untuk mengontrol slug tampilan detailberita
    public function tampil($id)
    {
        return view('detailberita', [
            "title" => "Detail Berita",
            //data berita sudah tersimpan dalam models berita
            "detailberita" => Berita::find($id)
        ]);
    }
}
