<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\medical_staff;
use App\Models\patients;
use Illuminate\Http\Request;

class DataDokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalpenduduk = patients::count(); // Ganti dengan model dan tabel yang sesuai
        $totallakilaki = patients::where('jenis_kelamin', 'laki-laki')->count();
        $totalperempuan = patients::where('jenis_kelamin', 'perempuan')->count();
        $totalNomorKK = patients::distinct('nomor_kk')->count('nomor_kk');
        return view('profildesa', ['totalpenduduk' => $totalpenduduk,
                                    'totallakilaki' => $totallakilaki,
                                    'totalperempuan' => $totalperempuan,
                                    'totalNomorKK' => $totalNomorKK,
                                    'title' => "Profil Desa",
                                    'aparatur' => medical_staff::all(),
                                    ]);
    }

    public function kelolaTampil()
    {
        return view('/dashboard.kelolaDokter', [
            "title" => "Kelola Data Dokter",
            //data profil desa sudah tersimpan dalam models berita
            "data" => medical_staff::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/dashboard.tambahDokter', [
            "title" => "Tambah Dokter/Perawat",
            //data profil desa sudah tersimpan dalam models berita
            // "dataTender" => patients::all()
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
        $request->validate([
            // 'foto' => 'image|file',
            'nik' => 'required|string',
            'nama' => 'required',
            'alamat' => 'required',
            // 'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'telp_hp' => 'required',
            'role' => 'required'
        ]);
        // $validatedData['foto'] =  $request->file('foto')->store('foto');

        // dd($request->all());
        medical_staff::create($request->all());

        return redirect('/kelolaDokter')->with('success', 'Data Dokter/Perawat berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_dokter)
    {
        return view('/dashBoard.viewDokter', [
            "title" => "Detail Dokter/Perawat",
            "dokter" => medical_staff::find($id_dokter)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     
     */
    public function edit($id_dokter)
    {
        $dokter = medical_staff::find($id_dokter);

        if (!$dokter) {
            return redirect('/dataDokter')->with('error', 'Dokter/Perawat tidak ditemukan');
        }
        // Opsi status perkawinan
        // $jabatan_options = [
        //     '1' => 'Belum Menikah',
        //     '2' => 'Menikah',
        //     // Tambahkan opsi lainnya jika diperlukan
        // ]
        ;

        return view('dashBoard.editDokter', [
            "title" => "Edit Dokter",
            "dokter" => $dokter,
            // 'jabatan_options' => $jabatan_options
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_dokter)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'nik' => 'required|string',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'telp_hp' => 'required',
            'role' => 'required'
        ]);

        $dokter = medical_staff::find($id_dokter);
        if (!$dokter) {
            return redirect('/kelolaDokter')->with('error', 'Dokter/Perawat tidak ditemukan');
        }
        // dd($request->all());
        $dokter->update($validatedData);

        return redirect('/kelolaDokter')->with('success', 'Data Dokter/Perawat berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_dokter)
    {
        $dokter = medical_staff::find($id_dokter);

        // Hapus penduduk jika ditemukan
        if ($dokter) {
            $dokter->delete();
            return redirect('/kelolaDokter')->with('success', 'Data Dokter berhasil dihapus.');
        } else {
            return redirect('/kelolaDokter')->with('error', 'Berita tidak ditemukan.');
        }
    }

}
