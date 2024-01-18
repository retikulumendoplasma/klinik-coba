<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\laporan_keuangan;
use Illuminate\Validation\Rule;

class KeuanganDesaController extends Controller
{
    public function rencana()
    {
        // $dataLaporan = laporan_keuangan::all()->sortByDesc('tahun_laporan');
        $dataLaporan = laporan_keuangan::where('jenis_laporan', 'Rencana Anggaran')->orderBy('tahun_laporan', 'desc')->get();
        return view('rencanaanggaran',[
            "title" => "Rencana anggaran",
            "dataLaporan" => $dataLaporan,
        ]);
    }
    // public function viewPdf($filename)
    // {
    //     $path = storage_path('app/public/file_laporan/' . $filename);

    //     return response()->file($path, ['Content-Type' => 'application/pdf']);
    // }

    public function laporan()
    {
        // $dataLaporan = laporan_keuangan::all()->sortByDesc('tahun_laporan');
        $dataLaporan = laporan_keuangan::where('jenis_laporan', 'Laporan Keuangan')->orderBy('tahun_laporan', 'desc')->get();
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
            'file_laporan' => 'required|file|mimes:pdf,docx',
            'tahun_laporan' => 'required|string',
        ]);
        $validatedData['file_laporan'] = $request->file('file_laporan')->store('file_laporan');

        laporan_keuangan::create($validatedData);


        return redirect('/dataKeuangan')->with('success', 'Tambah Data Berhasil');
    }

    public function delete(laporan_keuangan $laporan)
    {
        if ($laporan) {
            $laporan->delete();
            return redirect('/dataKeuangan')->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect('/dataKeuangan')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function edit(laporan_keuangan $laporan)
    {
        return view('dashBoard.editKeuangan', [
            
            "title" => "Edit data keuangan",
            "laporan" => $laporan,
            "dataLaporan" => laporan_keuangan::all()

        ]);
    }

    public function update(Request $request, laporan_keuangan $laporan)
    {
        $validatedData = $request->validate([
            'jenis_laporan' => 'required|string',
            'file_laporan' => 'required|string',
            'tahun_laporan' => 'required|string',
        ]);
        // dd($request->all());
        laporan_keuangan::where('id', $laporan->id)->update($validatedData);
        return redirect('/dataKeuangan')->with('success', 'Edit Data Berhasil');
    }
}
