<?php

namespace App\Http\Controllers;

use App\Models\medical_reports;
use App\Models\medical_staff;
use App\Models\patients;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rekamMedis = medical_reports::query()
            ->with(['patients', 'medical_staff']); // Gunakan relasi 'patients' dan 'medical_staff'

        if (request('cari')) {
            $rekamMedis->where(function ($query) {
                $query->whereHas('patients', function ($subQuery) {
                    $subQuery->where('nama', 'like', '%' . request('cari') . '%');
                })->orWhere('mr', 'like', '%' . request('cari') . '%'); // Cari berdasarkan nomor rekam medis
            });
        }

        $carirm = $rekamMedis->get();

        return view('dashBoard.rekamMedis', [
            "title" => "Data Rekam Medis",
            "dataRekamMedis" => $carirm
        ]);
    }
    
    public function formTambahRekamMedis()
    {
        // Ambil data pasien dan dokter
        $pasien = patients::all();
        $dokter = medical_staff::where('role', 'dokter')->get();

        // Ambil MR terakhir
        $lastMr = Medical_reports::latest('mr')->first();
        $newMr = $this->generateNewMr($lastMr ? $lastMr->mr : null);

        return view('dashBoard.tambahRekamMedis', [
            "title" => "Tambah Rekam Medis",
            "pasien" => $pasien,
            "dokter" => $dokter, // Ganti nama variabel dokter
            "newMr" => $newMr, // Kirim MR baru ke form
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

    public function searchPasien(Request $request)
    {
        $search = $request->input('q'); // Ambil query pencarian
        $patients = patients::where('nama', 'LIKE', "%$search%")
            ->select('id_pasien', 'nama') // Hanya ambil kolom yang dibutuhkan
            ->limit(10) // Batasi hasil pencarian
            ->get();

        return response()->json($patients);
    }
    
    public function storeTambahRekamMedis(Request $request)
    {
        $validated = $request->validate([
        'mr' => 'required|unique:medical_reports,mr|regex:/^\d{4}_\d{4}$/',
        'id_pasien' => 'required|exists:patients,id_pasien',
        'id_dokter' => 'required|exists:medical_staff,id_dokter',
        'keluhan' => 'required|string',
        'diagnosa' => 'required|string',
        'terapi' => 'required|string',
        ]);

        // Simpan rekam medis baru
        medical_reports::create($validated);

        return redirect('/rekamMedis')->with('success', 'Rekam Medis berhasil ditambahkan!');
    }

    public function dataRekamMedisPasien($id_pasien)
    {
        // Ambil query dasar
        $rekamMedisQuery = medical_reports::with(['patients', 'medical_staff'])
            ->where('id_pasien', $id_pasien);

        // Filter pencarian berdasarkan keluhan atau nomor rekam medis (jika ada permintaan pencarian)
        if (request('cari')) {
            $rekamMedisQuery->where(function ($query) {
                $query->where('keluhan', 'like', '%' . request('cari') . '%')
                    ->orWhere('mr', 'like', '%' . request('cari') . '%');
            });
        }

        // Ambil data rekam medis berdasarkan query
        $rekamMedis = $rekamMedisQuery->get();

        // Ambil data pasien
        $patient = patients::where('id_pasien', $id_pasien)->first();

        // Jika tidak ada data pasien atau rekam medis
        if ($rekamMedis->isEmpty() || !$patient) {
            return redirect('/rekamMedis')->with('error', 'Data rekam medis tidak ditemukan untuk pasien ini.');
        }

        // Kirim data ke view
        return view('dashBoard.rekamMedisPasien', [
            'title' => 'Data Rekam Medis Pasien',
            'dataRekamMedis' => $rekamMedis,
            'pasien' => $patient, // Kirim data pasien ke view
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
     * @param  \App\Models\rekam_medis  $rekam_medis
     * @return \Illuminate\Http\Response
     */
    public function show($mr)
    {
        $rm = medical_reports::find($mr);

        // Jika pasien tidak ditemukan, bisa mengarahkan atau menampilkan pesan error
        if (!$rm) {
            return redirect('/rekamMedis')->with('error', 'Rekam Medis tidak ditemukan');
        }

        return view('dashBoard.rekamMedis', [
            'title' => 'Rekam Medis',
            'rekammedis' => $rm
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rekam_medis  $rekam_medis
     * @return \Illuminate\Http\Response
     */
    public function edit(medical_reports $rekam_medis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\medical_reports  $rekam_medis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, medical_reports $rekam_medis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\medical_reports  $rekam_medis
     * @return \Illuminate\Http\Response
     */
    public function destroy($mr)
    {
        // Cari data berdasarkan kolom 'mr'
        $rekamMedis = medical_reports::where('mr', $mr)->first();

        if ($rekamMedis) {
            $rekamMedis->delete(); // Hapus data
            return redirect('/rekamMedis')->with('success', 'Data rekam medis berhasil dihapus.');
        } else {
            return redirect('/rekamMedis')->with('error', 'Data rekam medis tidak ditemukan.');
        }
    }

    public function destroyer($mr)
    {
        // Cari data berdasarkan kolom 'mr'
        $rekamMedis = medical_reports::where('mr', $mr)->first();

        if ($rekamMedis) {
            $idPasien = $rekamMedis->id_pasien; // Ambil id pasien sebelum data dihapus
            $rekamMedis->delete(); // Hapus data

            // Redirect ke halaman rekam medis pasien yang sesuai
            return redirect("/rekamMedisPasien/{$idPasien}")->with('success', 'Data rekam medis berhasil dihapus.');
        } else {
            // Jika data tidak ditemukan, redirect ke halaman utama rekam medis
            return redirect('/rekamMedis')->with('error', 'Data rekam medis tidak ditemukan.');
        }
    }

}
