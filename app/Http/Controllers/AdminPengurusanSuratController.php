<?php

namespace App\Http\Controllers;

use App\Models\pengaju_surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        return view('/dashBoard.viewSurat', [
            "title" => "Lihat surat",
            //data surat sudah tersimpan dalam models surat
            "data" => $surat
        ]);
    }

    public function terimasurat($id)
    {
        // Temukan surat berdasarkan ID
        $surat = pengaju_surat::find($id);

        // Ubah status_pengajuan menjadi 'diterima'
        $surat->status_surat = 'Selesai';
        $surat->save();

        // Redirect atau kembali ke halaman yang diinginkan
        return redirect()->back()->with('success', 'Proposal berhasil disetujui');
    }
    
    public function tolaksurat($id)
    {
            // Temukan proposal berdasarkan $id dan lakukan tindakan penolakan
        $surat = pengaju_surat::find($id);

        // Lakukan validasi apakah surat ditemukan atau tidak
        if (!$surat) {
            // surat tidak ditemukan, mungkin hendak melakukan redirect atau memberikan pesan error
            return redirect()->back()->with('error', 'surat tidak ditemukan.');
        }

        // Lakukan tindakan penolakan disini
        $surat->delete(); // Atau lakukan tindakan penolakan sesuai kebutuhan

        // Redirect atau berikan pesan sukses
        return redirect()->back()->with('success', 'surat berhasil ditolak.');
    }

    public function statusPengajuan()
    {
        $user = Auth::user();

        // Mendapatkan nomor KK dari relasi dengan model Penduduk
        $nomorKK = $user->penduduk->nomor_kk;

        // Mendapatkan data Penduduk yang memiliki nomor KK yang sesuai dengan nomor KK user yang login
        $dataSurat = pengaju_surat::where('nomor_kk', $nomorKK)->get();
        return view('pengajuanSurat', [
            "title" => "Pengajuan surat",
            //data surat sudah tersimpan dalam models surat
            "dataSurat" => $dataSurat
        ]);
    }

}
