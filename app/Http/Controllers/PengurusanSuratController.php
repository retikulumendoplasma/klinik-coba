<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penduduk;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class PengurusanSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function suratkurangmampu()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Mendapatkan nomor KK dari relasi dengan model Penduduk
        $nomorKK = $user->penduduk->nomor_kk;

        // Mendapatkan data Penduduk yang memiliki nomor KK yang sesuai dengan nomor KK user yang login
        $penduduk = Penduduk::where('nomor_kk', $nomorKK)->get();
        
        return view('suratkurangmampu', [
            //pengisian berita
            "title" => "Surat Keterangan Tidak Mampu",
            "penduduk" => $penduduk,
            // "nomorKK" => $nomorKK,
        ]);
    }

    public function suratkematian()
    {
        $user = Auth::user();
        $nomorKK = $user->penduduk->nomor_kk;
        $penduduk = Penduduk::where('nomor_kk', $nomorKK)->get();
        return view('suratkematian', [
            //pengisian berita
            "title" => "Surat Keterangan Meninggal Dunia",
            //data berita sudah tersimpan dalam models berita
            "penduduk" => $penduduk
        ]);
    }

    public function suratdomisili()
    {
        $user = Auth::user();
        $nomorKK = $user->penduduk->nomor_kk;
        $penduduk = Penduduk::where('nomor_kk', $nomorKK)->get();
        return view('suratdomisili', [
            //pengisian berita
            "title" => "Surat Keterangan Domisili",
            //data berita sudah tersimpan dalam models berita
            "penduduk" => $penduduk
        ]);
    }

    public function suratmenikah()
    {
        $user = Auth::user();
        $nomorKK = $user->penduduk->nomor_kk;
        $penduduk = Penduduk::where('nomor_kk', $nomorKK)->get();
        return view('suratmenikah', [
            //pengisian berita
            "title" => "Surat Keterangan Sudah/Belum Menikah",
            //data berita sudah tersimpan dalam models berita
            "penduduk" => $penduduk
        ]);
    }

    public function getPenduduk($nik)
    {
        $penduduk = Penduduk::find($nik);

        return Response::json([
            'nik' => $penduduk->nik,
            'tempat_lahir' => $penduduk->tempat_lahir,
            'tanggal_lahir' => $penduduk->tanggal_lahir,
            'jenis_kelamin' => $penduduk->jenis_kelamin,
            'status_perkawinan' => $penduduk->status_perkawinan,
            'agama' => $penduduk->agama,
            'pekerjaan' => $penduduk->pekerjaan,
            'alamat' => $penduduk->alamat,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
