<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\patients;
use Illuminate\Http\Request;

class AdminDataPasienController extends Controller
{
    public function index()
    {
        $pasien = patients::query();
        if (request('cari')) {
            $pasien->where(function ($query) {
                $query->where('nama', 'like', '%' . request('cari') . '%')
                      ->orWhere('alamat', 'like', '%' . request('cari') . '%');
            });
        }

        $caripasien = $pasien->get();

        return view('dashBoard.dataPasien', [
            "title" => "Data pasien",
            "datapasien" => $caripasien
        ]);
    }

    public function destroy($nik)
    {
        // Cari berita berdasarkan nik$nik
        $pasien = patients::find($nik);

        // Hapus pasien jika ditemukan
        if ($pasien) {
            $pasien->delete();
            return redirect('/dataPasien')->with('success', 'Data Pasien berhasil dihapus.');
        } else {
            return redirect('/dataPasien')->with('error', 'Data Pasien tidak ditemukan.');
        }
    }


    public function create()
    {
        $lastMr = patients::latest('nomor_rekam_medis')->first();
        $newMr = $this->generateNewMr($lastMr ? $lastMr->nomor_rekam_medis : null);
        
        return view('dashBoard.tambahPasien', [
            //pengisian berita
            "title" => "Tambah Pasien",
            "newMr" => $newMr,
        ]);
    }
    
    private function generateNewMr($lastMr)
    {
        $currentYear = date('Y');
        if ($lastMr && strpos($lastMr, $currentYear) === 0) {
            // Jika MR tahun ini sudah ada, increment nomor terakhir
            $lastNumber = (int)substr($lastMr, 5);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada MR untuk tahun ini, mulai dari 0001
            $newNumber = '0001';
        }

        return "{$currentYear}_{$newNumber}";
    }

    public function store(Request $request)
    {
        // dd('Metode Store diakses');
        $request->validate([
            'nomor_rekam_medis' => 'required|unique:patients,nomor_rekam_medis|regex:/^\d{4}_\d{4}$/',
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string',
            'status_perkawinan' => 'required|string',
            'pekerjaan' => 'required|string',
        ]);

        // dd($request->all());
        patients::create($request->all());

        return redirect('/dataPasien')->with('success', 'Pasien berhasil ditambahkan');
    }

    public function edit($id_pasien)
    {
        // Ambil data pasien berdasarkan id_pasien
        $pasien = patients::find($id_pasien);

        // Jika pasien tidak ditemukan, arahkan kembali dengan pesan error
        if (!$pasien) {
            return redirect('/dataPasien')->with('error', 'Pasien tidak ditemukan');
        }

        // Opsi status perkawinan
        $status_perkawinan_options = [
            '1' => 'Belum Menikah',
            '2' => 'Menikah',
            // Tambahkan opsi lainnya jika diperlukan
        ];

        // Mengirim data pasien yang akan diedit ke view
        return view('dashBoard.editPasien', [
            'title' => 'Edit Pasien',
            'patients' => $pasien,
            'status_perkawinan_options' => $status_perkawinan_options
        ]);
    }

public function update(Request $request, $id_pasien)
{
    // Validasi data yang diterima dari form
    $validatedData = $request->validate([
        'nama' => 'required|string',
        'tempat_lahir' => 'required|string',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|string',
        'alamat' => 'required|string',
        'nomor_hp' => 'required|string',
        'status_perkawinan' => 'required|string',
        'pekerjaan' => 'required|string',
    ]);

    // Cari pasien berdasarkan id_pasien
    $pasien = patients::find($id_pasien);

    // Jika pasien tidak ditemukan, redirect dengan pesan error
    if (!$pasien) {
        return redirect('/dataPasien')->with('error', 'Pasien tidak ditemukan');
    }

    // Update data pasien
    $pasien->update($validatedData);

    // Redirect kembali ke halaman data pasien dengan pesan sukses
    return redirect('/dataPasien')->with('success', 'Update Data Pasien Berhasil');
}


    // public function show(patients $pasien)
    // {
    //     // dd($pasien);
    //     return view('/dashBoard.viewdataPenduduk', [
    //         "title" => "Data Pasien",
    //         "patients" => $pasien
    //     ]);
    // }
    public function show($id_pasien)
    {
        // Ambil data pasien berdasarkan id_pasien
        $pasien = patients::find($id_pasien);

        // Jika pasien tidak ditemukan, bisa mengarahkan atau menampilkan pesan error
        if (!$pasien) {
            return redirect('/dataPasien')->with('error', 'Pasien tidak ditemukan');
        }

        // Kirim data pasien ke view
        return view('dashBoard.viewdataPasien', [
            'title' => 'Data Pasien',
            'patients' => $pasien
        ]);
    }
}
