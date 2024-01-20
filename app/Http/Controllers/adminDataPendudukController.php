<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\penduduk;
use Illuminate\Http\Request;

class adminDataPendudukController extends Controller
{
    public function index()
    {
        $penduduk = penduduk::query();
        if (request('cari')) {
            $penduduk->where(function ($query) {
                $query->where('nama', 'like', '%' . request('cari') . '%')
                      ->orWhere('nik', 'like', '%' . request('cari') . '%');
            });
        }

        $caripenduduk = $penduduk->get();

        return view('dashBoard.dataPenduduk', [
            //pengisian berita
            "title" => "Data Penduduk",
            //data berita sudah tersimpan dalam models berita
            "datapenduduk" => $caripenduduk
        ]);
    }

    public function destroy($nik)
    {
        // Cari berita berdasarkan nik$nik
        $penduduk = penduduk::find($nik);

        // Hapus penduduk jika ditemukan
        if ($penduduk) {
            $penduduk->delete();
            return redirect('/dataPenduduk')->with('success', 'Berita berhasil dihapus.');
        } else {
            return redirect('/dataPenduduk')->with('error', 'Berita tidak ditemukan.');
        }
    }

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
        $validatedData = $request->validate([
            'nomor_kk' => 'required|string',
            'nik' => 'required|string',
            'nama' => 'required|string',
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
            'status_akun' => ['string', Rule::in(['belum_terdaftar'])],
        ]);

        // dd($request->all());
        penduduk::create($request->all());

        return redirect('/dataPenduduk')->with('success', 'Tambah Penduduk Berhasil');
    }

    public function edit(penduduk $penduduk)
    {
        $status_perkawinan_options = [
            '1' => 'Menikah',
            '2' => 'Belum Menikah',
            // tambahkan opsi lainnya jika diperlukan
        ];

        return view('dashBoard.editPenduduk', [
            "title" => "Edit Penduduk",
            "penduduk" => $penduduk,
            "status_perkawinan_options" => $status_perkawinan_options,
            //data berita sudah tersimpan dalam models berita
            "dataPenduduk" => penduduk::all()
        ]);
    }

    public function update(Request $request, penduduk $penduduk)
    {
        // dd('Metode Store diakses');
        $validatedData = $request->validate([
            'nomor_kk' => 'required|string',
            'nik' => 'required|string',
            'nama' => 'required|string',
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
            'status_akun' => ['string', Rule::in(['belum_terdaftar'])],
        ]);

        // dd($request->all());
        penduduk::where('nik', $penduduk->nik)->update($validatedData);

        return redirect('/dataPenduduk')->with('success', 'Tambah Penduduk Berhasil');
    }

    public function show(penduduk $penduduk)
    {
        return view('/dashBoard.viewdataPenduduk', [
            "title" => "Tambah Penduduk",
            "penduduk" => $penduduk
        ]);
    }
}
