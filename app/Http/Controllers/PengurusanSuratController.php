<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penduduk;
use App\Models\pengaju_surat;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
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
        // Validasi data input
        $validatedData = $request->validate([
            'jenis_surat' => 'required|string',
            'nik' => 'required|string',
            'nomor_hp' => 'required|string',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg',
            'foto_kk' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        // Ambil data penduduk berdasarkan NIK
        $penduduk = Penduduk::where('nik', $validatedData['nik'])->first();
        
        if (!$penduduk) {
            return redirect()->back()->with('error', 'NIK tidak ditemukan dalam database penduduk.');
        }

        // Menyimpan file foto
        $validatedData['foto_ktp'] = $request->file('foto_ktp')->store('foto_ktp');
        $validatedData['foto_kk'] = $request->file('foto_kk')->store('foto_kk');
        $validatedData['tanggal_pengajuan'] = Carbon::now()->toDateString();

        // Menambahkan data nama dan data penduduk lainnya ke dalam data pengajuan surat
        $validatedData['nama'] = $penduduk->nama;
        $validatedData['tempat_lahir'] = $penduduk->tempat_lahir;
        $validatedData['tanggal_lahir'] = $penduduk->tanggal_lahir;
        $validatedData['jenis_kelamin'] = $penduduk->jenis_kelamin;
        $validatedData['status_perkawinan'] = $penduduk->status_perkawinan;
        $validatedData['agama'] = $penduduk->agama;
        $validatedData['pekerjaan'] = $penduduk->pekerjaan;
        $validatedData['alamat'] = $penduduk->alamat;
        $validatedData['nomor_kk'] = $penduduk->nomor_kk;

        // Cek apakah surat sudah pernah diajukan untuk jenis surat dan NIK yang sama
        $existingSurat = pengaju_surat::where('nik', $validatedData['nik'])
                                    ->where('jenis_surat', $validatedData['jenis_surat'])
                                    ->first();

        // Jika ada foto pendukung, simpan foto tersebut
        if ($request->file('foto_pendukung')) {
            $validatedData['foto_pendukung'] = $request->file('foto_pendukung')->store('foto_pendukung');
        }

        // Jika surat sudah pernah diajukan dan status surat tidak selesai atau ditolak
        if ($existingSurat && ($existingSurat->status_surat != 'Selesai' && $existingSurat->status_surat != 'Ditolak')) {
            return redirect()->back()->with('error', 'Anda sudah mengajukan pembuatan surat ini sebelumnya.');
        }

        // Menyimpan data pengajuan surat ke database
        $pengaju = pengaju_surat::create($validatedData);

        // Mengarahkan ke halaman setelah pengajuan berhasil
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

    public function cari()
    {
        $user = Auth::user();

        // Mendapatkan nomor KK dari relasi dengan model Penduduk
        $nomorKK = $user->penduduk->nomor_kk;

        // Mendapatkan data Penduduk yang memiliki nomor KK yang sesuai dengan nomor KK user yang login
        // $dataSurat = pengaju_surat::where('nomor_kk', $nomorKK)->get();
        // return view('pengajuanSurat', [
        //     "title" => "Pengajuan surat",
        //     //data surat sudah tersimpan dalam models surat
        //     "dataSurat" => $dataSurat
        // ]);

        $surat = pengaju_surat::where('nomor_kk', $nomorKK);
        $suratpending = pengaju_surat::query();
        $suratselesai = pengaju_surat::query();
        $suratditolak = pengaju_surat::query();
    
        // Filter berdasarkan NIK atau nama
        if (request('cari')) {
            $surat->where(function ($query) {
                $query->where('nama', 'like', '%' . request('cari') . '%')
                      ->orWhere('nik', 'like', '%' . request('cari') . '%');
            });
        }
    
        // Filter berdasarkan tanggal_pengajuan
        if (request('tanggal_pengajuan')) {
            $surat->whereDate('tanggal_pengajuan', request('tanggal_pengajuan'));
        }
    
        // Filter berdasarkan jenis_surat
        if (request('jenis_surat')) {
            $surat->where('jenis_surat', request('jenis_surat'));
        }

        $dataSurat = $surat->get();
    
        return view('pengajuanSurat', [
            "title" => "Data Surat",
            "dataSurat" => $dataSurat,
        ]);
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
