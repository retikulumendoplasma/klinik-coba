<?php

namespace App\Http\Controllers;

use App\Models\pengaju_surat;
use App\Models\pengaju_proposal_tender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminPengurusanSuratController extends Controller
{
    public function adminhome()
    {
        $suratmasuk = pengaju_surat::where('status_surat', 'Pending')->count();
        $proposalmasuk = pengaju_proposal_tender::where('status_pengajuan', 'Pending')->count();
        return view('dashboard.beranda', [
            "title" => "Dashboard Admin",
            "suratmasuk" => $suratmasuk,
            "proposalmasuk" => $proposalmasuk
        ]);
    }

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

        // Ubah status_pengajuan menjadi 'Proses'
        $surat->status_surat = 'Proses';
        $surat->save();

        // Redirect atau kembali ke halaman yang diinginkan
        return redirect()->back()->with('success', 'Surat diproses');
    }

    public function selesai($id)
    {
        // Temukan surat berdasarkan ID
        $surat = pengaju_surat::find($id);

        // Ubah status_pengajuan menjadi 'Selesai'
        $surat->status_surat = 'Selesai';
        $surat->save();

        // Redirect atau kembali ke halaman yang diinginkan
        return redirect()->back()->with('success', ' surat telah selesai');
    }
    
    public function tolaksurat(Request $request, $id)
    {
        $request->validate([
            'tolak_surat' => 'required',
        ]);
    
        // Ambil surat berdasarkan ID
        $surat = pengaju_surat::find($id);
    
        // Simpan pesan penolakan
        $surat->update([
            'status_surat' => 'Ditolak',
            'tolak_surat' => $request->tolak_surat,
        ]);
    
        return redirect()->back()->with('success', 'Surat ditolak dan pesan penolakan berhasil disimpan.');
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
