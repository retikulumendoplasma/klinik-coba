<?php

namespace App\Http\Controllers;

use App\Models\pengaju_surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminPengurusanSuratController extends Controller
{
    public function tampildata()
    {
        $surat = pengaju_surat::query();
        $suratpending = pengaju_surat::query();
        $suratselesai = pengaju_surat::query();
    
        if (request('cari')) {
            $surat->where(function ($query) {
                $query->where('nama', 'like', '%' . request('cari') . '%')
                      ->orWhere('nik', 'like', '%' . request('cari') . '%');
            });
        }
        if (request('cari')) {
            $suratpending->where(function ($query) {
                $query->where('nama', 'like', '%' . request('cari') . '%')
                      ->orWhere('nik', 'like', '%' . request('cari') . '%');
            });
        }
        if (request('cari')) {
            $suratselesai->where(function ($query) {
                $query->where('nama', 'like', '%' . request('cari') . '%')
                      ->orWhere('nik', 'like', '%' . request('cari') . '%');
            });
        }
    
        $dataSuratProses = $surat->where('status_surat', 'Proses')->get();
        $dataSuratPending = $suratpending->where('status_surat', 'Pending')->get();
        $dataSuratSelesai = $suratselesai->where('status_surat', 'Selesai')->get();
    
        return view('dashBoard.kelolaSurat', [
            "title" => "Data Surat",
            "dataSuratProses" => $dataSuratProses,
            "dataSuratPending" => $dataSuratPending,
            "dataSuratSelesai" => $dataSuratSelesai,
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
