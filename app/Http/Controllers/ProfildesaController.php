<?php

namespace App\Http\Controllers;

use App\Models\penduduk;
use Illuminate\Http\Request;

class ProfildesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalpenduduk = penduduk::count(); // Ganti dengan model dan tabel yang sesuai
        $totallakilaki = Penduduk::where('jenis_kelamin', 'laki-laki')->count();
        $totalperempuan = Penduduk::where('jenis_kelamin', 'perempuan')->count();
        $totalNomorKK = Penduduk::distinct('nomor_kk')->count('nomor_kk');
        return view('profildesa', ['totalpenduduk' => $totalpenduduk,
                                    'totallakilaki' => $totallakilaki,
                                    'totalperempuan' => $totalperempuan,
                                    'totalNomorKK' => $totalNomorKK,
                                    'title' => "Profil Desa"
                                    ]);
    }

    public function kelolaTampil()
    {
        return view('/dashboard.kelolaProfilDesa', [
            "title" => "Kelola Profil Desa",
            //data profil desa sudah tersimpan dalam models berita
            "dataTender" => penduduk::all()
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
