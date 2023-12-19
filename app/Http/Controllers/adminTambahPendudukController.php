<?php

namespace App\Http\Controllers;

use App\Models\penduduk;
use Illuminate\Http\Request;

class adminTambahPendudukController extends Controller
{
    public function create()
    {
        return view('dashBoard.tambahPenduduk', [
            //pengisian berita
            "title" => "Tambah Penduduk"
        ]);
    }

    public function store(Request $request)
    {
        // dd('Metode Store diakses');
        $request->validate([
            'nama' => 'required|string',
            'nomor_kk' => 'required|string',
            'nik' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string',
            'status_perkawinan' => 'required|string',
            'pendidikan' => 'required|string',
            'pekerjaan' => 'required|string',
            'status_hubungan_kk' => 'required|string',
            'status_akun' => 'belum terdaftar|string'
        ]);

        dd($request->all());
        penduduk::create($request->all());

        return redirect('/dataPenduduk')->with('success', 'Tambah Penduduk Berhasil');
    }
}
