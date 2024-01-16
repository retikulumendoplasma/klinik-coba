<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penduduk;
use App\Models\pengaju_surat;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'nama' => $penduduk->nama,
            'nomor_kk' => $penduduk->nomor_kk,
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
        $validatedData = $request->validate([
            'jenis_surat' => 'required|string',
            'nik' => 'required|string',
            'nomor_kk' => 'required|string',
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string',
            'status_perkawinan' => 'required|string',
            'pekerjaan' => 'required|string',
            'foto_ktp' => 'image|file',
            'foto_kk' => 'image|file',
        ]);

        $validatedData['foto_ktp'] = $request->file('foto_ktp')->store('foto_ktp');
        $validatedData['foto_kk'] = $request->file('foto_kk')->store('foto_kk');

        // pengecekan surat sudah pernah dikirim
        $existingSurat = pengaju_surat::where('nik', $validatedData['nik'])
                                        ->where('jenis_surat', $validatedData['jenis_surat'])
                                        ->first();


        if ($request->file('foto_pendukung')) {
            $validatedData['foto_pendukung'] = $request->file('foto_pendukung')->store('foto_pendukung');
        }

        if ($existingSurat && $existingSurat->status_surat != 'Selesai') {
            return redirect()->back()->with('error', 'Anda sudah mengajukan pembuatan surat ini sebelumnya.');
        }
       
        // dd($request->all());
        $pengaju = pengaju_surat::create($validatedData);

        return redirect('berhasilurussurat/'.$pengaju->id)->with('success', 'Pengajuan Surat Berhasil Diajukan');
    }

    public function berhasil($pengaju)
    {
        $datasurat = pengaju_surat::find($pengaju);
        return view('berhasilurussurat', [
            "title" => "Berhasil",
            //data surat sudah tersimpan dalam models surat
            "datasurat" => $datasurat
        ]);
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
