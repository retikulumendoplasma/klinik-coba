<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\aparatur;
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
                                    'title' => "Profil Desa",
                                    'aparatur' => aparatur::all(),
                                    ]);
    }

    public function kelolaTampil()
    {
        return view('/dashboard.kelolaProfilDesa', [
            "title" => "Kelola Profil Desa",
            //data profil desa sudah tersimpan dalam models berita
            "data" => aparatur::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/dashboard.tambahAparatur', [
            "title" => "Tambah Aparatur",
            //data profil desa sudah tersimpan dalam models berita
            "dataTender" => penduduk::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'foto' => 'image|file',
            'nip_nipd' => 'required|string',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'no_wa' => 'required',
            'jabatan' => 'required'
        ]);
        $validatedData['foto'] =  $request->file('foto')->store('foto');

        // dd($request->all());
        aparatur::create($validatedData);

        return redirect('kelolaProfilDesa')->with('success', 'Data aparatur berhasil ditambah');
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
     
     */
    public function edit(aparatur $aparatur)
    {
        return view('dashBoard.editProfilDesa', [
            "title" => "Edit Aparatur",
            "aparatur" => $aparatur,
            //data berita sudah tersimpan dalam models berita
            "dataaparatur" => aparatur::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,aparatur $aparatur)
    {
        $validatedData = $request->validate([
            'foto' => 'image|file',
            'nip_nipd' => 'required|string',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'no_wa' => 'required',
            'jabatan' => 'required'
        ]);
        if ($request->hasFile('foto')) {
            $validatedData['foto'] =  $request->file('foto')->store('foto');
        }
        

        // dd($request->all());
        aparatur::where('nip_nipd', $aparatur->nip_nipd)->update($validatedData);

        return redirect('kelolaProfilDesa')->with('success', 'Data aparatur berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nip_nipd)
    {
        $aparatur = aparatur::find($nip_nipd);

        // Hapus penduduk jika ditemukan
        if ($aparatur) {
            $aparatur->delete();
            return redirect('/kelolaProfilDesa')->with('success', 'Berita berhasil dihapus.');
        } else {
            return redirect('/kelolaProfilDesa')->with('error', 'Berita tidak ditemukan.');
    }
    }
}
