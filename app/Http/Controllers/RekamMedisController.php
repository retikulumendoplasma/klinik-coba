<?php

namespace App\Http\Controllers;

use App\Events\HapusPasien;
use App\Events\PasienBaruDitambahkan;
use App\Models\antrian;
use App\Models\medical_reports;
use App\Models\medical_staff;
use App\Models\medicines;
use App\Models\patients;
use App\Models\resep;
use App\Models\resep_obat;
use App\Models\tindakan;
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

        $dataRekamMedis = $rekamMedis->paginate(10); // Eksekusi query dan ambil hasilnya

    
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
        // Validasi input dari form
        $validated = $request->validate([
            'nomor_rekam_medis' => 'required|exists:patients,nomor_rekam_medis',
            'id_dokter' => 'required|exists:medical_staff,id_dokter',
            'subjective' => 'string',
            'objective' => 'string',
            'assesment' => 'string',
            'planning' => 'string',
        ]);
    
        // Menambahkan tanggal berobat ke data validasi
        $validated['tanggal_berobat'] = now();
    
        // Mengambil data pasien berdasarkan nomor rekam medis
        $patient = Patients::where('nomor_rekam_medis', $validated['nomor_rekam_medis'])->first();
    
        // Pastikan pasien ditemukan
        if (!$patient) {
            return redirect()->back()->with('error', 'Pasien tidak ditemukan.');
        }
    
        // Mencari antrian berdasarkan nomor rekam medis
        $antrian = DB::table('antrian')->where('nomor_rekam_medis', $validated['nomor_rekam_medis'])->first();
    
        // Pastikan antrian ditemukan
        if (!$antrian) {
            return redirect()->back()->with('error', 'Antrian tidak ditemukan.');
        }
    
        // Perbarui status antrian menjadi "Sedang dilayani"
        DB::table('antrian')->where('id_antrian', $antrian->id_antrian) // Gunakan id_antrian
        ->update(['status' => 'Sedang dilayani']); // Update status menjadi "Sedang dilayani"
    
        // Menyimpan rekam medis baru
        $rekamMedis = medical_reports::create($validated);
    
        // Redirect ke halaman detail rekam medis pasien
        return redirect()->route('detailRekamMedisPasien', ['id_rekam_medis' => $rekamMedis->id_rekam_medis])
            ->with('success', 'Rekam Medis berhasil ditambahkan!');
    }
    
    
    
    


    public function dataRekamMedisPasien($nomor_rekam_medis)
    {
        // Ambil query dasar
        $rekamMedisQuery = medical_reports::with(['patients', 'medical_staff', 'transaksi'])
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
        // Ambil data rekam medis dengan relasi terkait
        $rekamMedis = medical_reports::with(['patients', 'medical_staff'])
            ->where('id_rekam_medis', $id_rekam_medis)
            ->first();

        // Jika data tidak ditemukan
        if (!$rekamMedis) {
            return redirect('/rekamMedis')->with('error', 'Data rekam medis tidak ditemukan untuk pasien ini.');
        }

        // Pastikan data pasien terkait ada
        if (!$rekamMedis->patients) {
            return redirect('/rekamMedis')->with('error', 'Data pasien tidak ditemukan untuk rekam medis ini.');
        }

        // Ambil data resep terkait rekam medis
        $resep = resep::with('resep_obat.medicines')
            ->where('id_rekam_medis', $id_rekam_medis)
            ->first();

        // Ambil daftar obat yang terkait dengan resep, jika ada
        $dataResep = collect(); // Koleksi kosong
        if ($resep) {
            $dataResep = resep_obat::with('medicines')
                ->where('id_resep', $resep->id_resep)
                ->get();
        }

        // Ambil data tindakan terkait rekam medis
        $dataTindakan = tindakan::with('jenis_tindakan')
            ->where('id_rekam_medis', $id_rekam_medis)
            ->get();
    
        // Buat koleksi data tindakan dengan nama tindakan
        $listTindakan = $dataTindakan->map(function ($tindakan) {
            return [
                'id_tindakan' => $tindakan->id_tindakan,
                'nama_tindakan' => $tindakan->jenis_tindakan->nama_tindakan ?? '-', // Nama tindakan
            ];
        });

        // Kirim data ke view
        return view('dashBoard.detailRekamMedisPasien', [
            'title' => 'Data Rekam Medis Pasien',
            'rekamMedis' => $rekamMedis,
            'dataResep' => $dataResep,
            'listTindakan' => $listTindakan,
            'hasResep' => $rekamMedis->resep ? true : false, // Tambahan untuk cek resep
            'hasTindakan' => $rekamMedis->tindakan ? true : false, // Tambahan untuk cek tindakan
            'hasTransaksi' => $rekamMedis->transaksi ? true : false, // Tambahan untuk cek transaksi
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
            $idPasien = $rekamMedis->nomor_rekam_medis; // Ambil id pasien sebelum data dihapus
            $rekamMedis->delete(); // Hapus data

            // Redirect ke halaman rekam medis pasien yang sesuai
            return redirect("/rekamMedisPasien/{$idPasien}")->with('success', 'Data rekam medis berhasil dihapus.');
        } else {
            // Jika data tidak ditemukan, redirect ke halaman utama rekam medis
            return redirect('/rekamMedis')->with('error', 'Data rekam medis tidak ditemukan.');
        }
    }

}
