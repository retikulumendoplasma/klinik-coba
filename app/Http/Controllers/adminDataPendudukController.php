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

    public function destroy($nik)
    {
        // Cari berita berdasarkan nik$nik
        $penduduk = penduduk::find($nik);

        // Hapus penduduk jika ditemukan
        if ($penduduk) {
            $penduduk->delete();
            return redirect('/dataPenduduk')->with('success', 'Berita berhasil dihapus.');
        } else {
            return redirect('/dataPenduduk')->with('error', 'Berita tidak ditemukan.');
    }
    }
}
