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

    //controller untuk menampilkan berita terbuat pada halaman kelola berita
    public function data()
    {
        return view('dashBoard.kelolaBerita', [
            //pengisian berita
            "title" => "Kelola Berita",
            //data berita sudah tersimpan dalam models berita
            "kelolaberita" => berita::all()
        ]);
    }

    //controller untuk mengontrol tampilan viewBerita
    public function lihat(berita $berita)
    {
        return view('dashBoard.viewBerita', [
            "title" => "Lihat Berita",
            //data berita sudah tersimpan dalam models berita
            "viewberita" => $berita
        ]);
    }

    public function destroy($id)
    {
        // Cari berita berdasarkan ID
        $berita = berita::find($id);

        // Hapus berita jika ditemukan
        if ($berita) {
            $berita->delete();
            return redirect('/kelolaBerita')->with('success', 'Berita berhasil dihapus.');
        } else {
            return redirect('/kelolaBerita')->with('error', 'Berita tidak ditemukan.');
    }
    }


}
