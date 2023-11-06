<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    //controller untuk menampilkan tampilan pada halaman berita
    public function index()
    {
        return view('berita', [
            //pengisian berita
            "title" => "Berita",
            //data berita sudah tersimpan dalam models berita
            "berita" => Berita::all()
        ]);
    }

    public function home()
    {
        return view('home', [
            "title" => "Home",
            //data berita sudah tersimpan dalam models berita
            "berita" => Berita::all()
        ]);
    }

    //controller untuk mengontrol slug tampilan detailberita
    public function tampil($slug)
    {
        return view('detailberita', [
            "title" => "Detail Berita",
            //data berita sudah tersimpan dalam models berita
            "detailberita" => Berita::find($slug)
        ]);
    }
}
