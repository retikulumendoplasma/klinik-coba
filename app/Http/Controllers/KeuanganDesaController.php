<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\laporan_keuangan;
use Illuminate\Validation\Rule;

class KeuanganDesaController extends Controller
{
    public function rencana()
    {
        $dataLaporan = laporan_keuangan::all()->sortByDesc('tahun_laporan');
        return view('rencanaanggaran',[
            "title" => "Rencana anggaran",
            "dataLaporan" => $dataLaporan,
        ]);
    }

    public function laporan()
    {
        $dataLaporan = laporan_keuangan::all()->sortByDesc('tahun_laporan');
        
        return view('laporankeuangan',[
            "title" => "Laporan Keuangan",
            "dataLaporan" => $dataLaporan,
        ]);
    }

    public function index()
    {
        return view('dashBoard.dataKeuangan', [
            "title" => "Data Keuangan",
            "dataLaporan" => laporan_keuangan::all(),
        ]);
    }

    public function create()
    {
        return view('dashBoard.buatLaporan', [
            
            "title" => "Buat Laporan",
        ]);
    }

    public function store(Request $request)
    {
        // dd('Metode Store diakses');
        $validatedData = $request->validate([
            'jenis_laporan' => 'required|string',
            'file_laporan' => 'required|string',
            'tahun_laporan' => 'required|string',
        ]);

        laporan_keuangan::create($request->all());


        return redirect('/dataKeuangan')->with('success', 'Tambah Data Berhasil');
    }
}
