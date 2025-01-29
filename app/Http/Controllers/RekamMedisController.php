<?php

namespace App\Http\Controllers;

use App\Models\medical_reports;
use App\Models\medical_staff;
use App\Models\medicines;
use App\Models\patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Subquery untuk mendapatkan data unik
        $subquery = medical_reports::query()
            ->selectRaw('
                nomor_rekam_medis,
                MAX(id_rekam_medis) AS id_rekam_medis
            ')
            ->groupBy('nomor_rekam_medis');
    
        // Gabungkan subquery dengan tabel patients menggunakan Eloquent
        $rekamMedis = medical_reports::query()
            ->fromSub($subquery, 'subquery') // Alias untuk subquery
            ->join('patients', 'subquery.nomor_rekam_medis', '=', 'patients.nomor_rekam_medis')
            ->select(
                'subquery.nomor_rekam_medis',
                'subquery.id_rekam_medis',
                'patients.nama AS nama_pasien',
                'patients.alamat AS alamat_pasien', // Tambahkan kolom alamat
                'patients.nomor_hp AS nomor_hp_pasien' // Tambahkan kolom nomor HP
            );
    
        // Filter pencarian
        if (request('cari')) {
            $rekamMedis->where(function ($query) {
                $query->where('patients.nama', 'like', '%' . request('cari') . '%')
                      ->orWhere('subquery.nomor_rekam_medis', 'like', '%' . request('cari') . '%');
            });
        }
    
        // Eksekusi query dan ambil data
        $dataRekamMedis = $rekamMedis->get();
    
        return view('dashBoard.rekamMedis', [
            "title" => "Data Rekam Medis",
            "dataRekamMedis" => $dataRekamMedis
        ]);
    }
    
    public function indexV2()
    {
        $rekamMedis = patients::query(); // Menggunakan query builder

        // Filter pencarian
        if (request('cari')) {
            $rekamMedis->where(function ($query) {
                $query->where('nama', 'like', '%' . request('cari') . '%')
                    ->orWhere('nomor_rekam_medis', 'like', '%' . request('cari') . '%');
            });
        }

        $dataRekamMedis = $rekamMedis->get(); // Eksekusi query dan ambil hasilnya

    
        return view('dashBoard.rekamMedis', [
            "title" => "Data Rekam Medis",
            "dataRekamMedis" => $dataRekamMedis
        ]);
    }
    

    public function formTambahRekamMedis()
    {
        // Ambil data pasien dan dokter
        $pasien = patients::all();
        $dokter = medical_staff::where('role', 'dokter')->get();
        
        // dd($obat);
        return view('dashBoard.tambahRekamMedis', [
            "title" => "Tambah Rekam Medis",
            "pasien" => $pasien,
            "dokter" => $dokter,
        ]);
    }
    
    public function formTambahRekamMedisPasienTertuju($nomor_rekam_medis)
    {
        // Ambil data pasien dan dokter
        $pasien = patients::where('nomor_rekam_medis', $nomor_rekam_medis)->first();

        // Jika pasien tidak ditemukan, redirect kembali dengan pesan error
        if (!$pasien) {
            return redirect()->back()->with('error', 'Pasien tidak ditemukan.');
        }

        $dokter = medical_staff::where('role', 'dokter')->get();

        // dd($obat);
        return view('dashBoard.tambahRekamMedisPasienTertuju', [
            "title" => "Tambah Rekam Medis " . e($pasien->nama),
            "pasien" => $pasien,
            "dokter" => $dokter,
        ]);
    }

    public function searchPasien(Request $request)
    {
        $search = $request->input('q'); // Ambil query pencarian
        $patients = patients::where('nama', 'LIKE', "%$search%")
            ->select('nomor_rekam_medis', 'nama') // Hanya ambil kolom yang dibutuhkan
            ->limit(10) // Batasi hasil pencarian
            ->get();

        return response()->json($patients);
    }
    
    public function storeTambahRekamMedis(Request $request)
    {
        $validated = $request->validate([
            'nomor_rekam_medis' => 'required|exists:patients,nomor_rekam_medis',
            'id_dokter' => 'required|exists:medical_staff,id_dokter',
            'subjective' => 'string',
            'objective' => 'string',
            'assesment' => 'string',
            'planning' => 'string',
        ]);

        // Tambah tanggal berobat
        $validated['tanggal_berobat'] = now();

        // Simpan rekam medis baru
        $rekamMedis = medical_reports::create($validated);

        // Redirect ke formResep dengan ID rekam medis

        return redirect()->route('detailRekamMedisPasien', ['id_rekam_medis' => $rekamMedis->id_rekam_medis])
            ->with('success', 'Rekam Medis berhasil ditambahkan!');
    }


    public function dataRekamMedisPasien($nomor_rekam_medis)
    {
        // Ambil query dasar
        $rekamMedisQuery = medical_reports::with(['patients', 'medical_staff'])
            ->where('nomor_rekam_medis', $nomor_rekam_medis);

        // Filter pencarian berdasarkan subjective atau nomor rekam medis (jika ada permintaan pencarian)
        if (request('cari')) {
            $rekamMedisQuery->where(function ($query) {
                $query->where('subjective', 'like', '%' . request('cari') . '%')
                    ->orWhere('nomor_rekam_medis', 'like', '%' . request('cari') . '%');
            });
        }

        // Ambil data rekam medis berdasarkan query
        $rekamMedis = $rekamMedisQuery->get();

        // Ambil data pasien
        $patient = patients::where('nomor_rekam_medis', $nomor_rekam_medis)->first();

        // Kirim data ke view
        return view('dashBoard.rekamMedisPasien', [
            'title' => 'Data Rekam Medis Pasien',
            'dataRekamMedis' => $rekamMedis,
            'pasien' => $patient, // Kirim data pasien ke view
        ]);
    }

    public function detailRekamMedisPasien($id_rekam_medis)
    {
        // Ambil query dasar
        $rekamMedis = medical_reports::with(['patients', 'medical_staff'])
            ->where('id_rekam_medis', $id_rekam_medis)
            ->first();

        // Jika tidak ada data pasien atau rekam medis
        if (!$rekamMedis) {
            return redirect('/rekamMedis')->with('error', 'Data rekam medis tidak ditemukan untuk pasien ini.');
        }

        return view('dashBoard.detailRekamMedisPasien', [
            'title' => 'Data Rekam Medis Pasien',
            "rekamMedis" => $rekamMedis,
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
        // if (!$rm) {
        //     return redirect('/rekamMedis')->with('error', 'Rekam Medis tidak ditemukan');
        // }

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
    public function edit($id_rekam_medis)
    {
        $rekam_medis = medical_reports::with(['patients', 'medical_staff'])
            ->where('id_rekam_medis', $id_rekam_medis)
            ->first();

        return view('dashBoard.editRekamMedisPasien', [
            "title" => "Edit rekam medis",
            "rekamMedis" => $rekam_medis,
            // 'jabatan_options' => $jabatan_options
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\medical_reports  $rekam_medis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_rekam_medis)
    {
        // Validasi input
        $validatedData = $request->validate([
            'subjective' => 'nullable|string',
            'objective' => 'nullable|string',
            'assesment' => 'nullable|string',
            'planning' => 'nullable|string',
        ]);
    
        // Cari data rekam medis
        $rekam_medis = medical_reports::with(['patients', 'medical_staff'])
            ->where('id_rekam_medis', $id_rekam_medis)
            ->first();
    
        // Jika data tidak ditemukan
        if (!$rekam_medis) {
            return redirect('/rekamMedis')->with('error', 'Data Rekam Medis tidak ditemukan');
        }
    
        // Update data rekam medis
        $rekam_medis->update($validatedData);
    
        // Redirect ke halaman pasien berdasarkan nomor rekam medis
        return redirect()->route('rekamMedisPasien', ['nomor_rekam_medis' => $rekam_medis->patients->nomor_rekam_medis])
            ->with('success', 'Data Rekam Medis berhasil diperbaharui');
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\medical_reports  $rekam_medis
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_rekam_medis)
    {
        // Cari data berdasarkan kolom 'id_rekam_medis'
        $rekamMedis = medical_reports::where('id_rekam_medis', $id_rekam_medis)->first();

        if ($rekamMedis) {
            $rekamMedis->delete(); // Hapus data
            return redirect('/rekamMedis')->with('success', 'Data rekam medis berhasil dihapus.');
        } else {
            return redirect('/rekamMedis')->with('error', 'Data rekam medis tidak ditemukan.');
        }
    }

    public function destroyer($id_rekam_medis)
    {
        // Cari data berdasarkan kolom 'id_rekam_medis'
        $rekamMedis = medical_reports::where('id_rekam_medis', $id_rekam_medis)->first();

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
