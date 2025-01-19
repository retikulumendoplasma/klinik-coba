<?php

namespace App\Http\Controllers;

use App\Models\resep_obat;
use App\Models\medical_reports;
use App\Models\medicines;
use App\Models\patients;
use App\Models\resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resep = resep::query()
            ->with(['medical_reports.patients']);

        if (request('cari')) {
            $resep->where(function ($query) {
                $query->whereHas('rekamMedis.patient', function ($subQuery) {
                    $subQuery->where('nama', 'like', '%' . request('cari') . '%'); // Cari berdasarkan nama pasien
                })->orWhereHas('rekamMedis', function ($subQuery) {
                    $subQuery->where('nomor_rekam_medis', 'like', '%' . request('cari') . '%'); // Cari berdasarkan nomor rekam medis
                });
            });
        }

        $carirm = $resep->get();

        return view('dashBoard.viewResep', [
            "title" => "Data resep",
            "dataResep" => $carirm
        ]);
    }
    
    public function detailResepPasien($id_resep)
{
    $resep = Resep::with(['medical_reports.patients', 'medical_reports.medical_staff'])
        ->where('id_resep', $id_resep)
        ->firstOrFail();

    $dataResep = resep_obat::with('medicines')
        ->where('id_resep', $id_resep)
        ->get();

    return view('dashBoard.detailResepPasien', [
        'resep' => $resep,
        'dataResep' => $dataResep,
    ]);
}


    // public function detailResepPasien($id_resep)
    // {
    //     $resep = Resep::with(['medicalReports.patients', 'medicalReports.medicalStaff', 'resepObat.medicines'])
    //                 ->findOrFail($id_resep);

    //     return view('dashBoard.detailResepPasien', [
    //         'title' => 'Detail Resep',
    //         'rekamMedis' => $resep->medicalReports,
    //         'dataResep' => $resep->resepObat, // Relasi ke tabel pivot resep_obat
    //     ]);
    // }


    // public function index()
    // {
    //     $resep = resep::with(['medical_reports.patients'])->get();

    //     // Debugging: Cek apakah data relasi ada
    //     dd($resep);

    //     return view('dashBoard.viewResep', [
    //         "title" => "Data resep",
    //         "dataResep" => $resep
    //     ]);
    // }
    
    public function tambahResep()
    {
        $rekamMedis = medical_reports::query()
            ->with(['patients', 'medical_staff']) // Relasi pasien dan staf medis
            ->whereDoesntHave('resep'); // Hanya ambil data yang tidak memiliki resep

        if (request('cari')) {
            $rekamMedis->where(function ($query) {
                $query->whereHas('patients', function ($subQuery) {
                    $subQuery->where('nama', 'like', '%' . request('cari') . '%');
                })->orWhere('nomor_rekam_medis', 'like', '%' . request('cari') . '%');
            });
        }

        $carirm = $rekamMedis->get();

        return view('dashBoard.tambahResep', [
            "title" => "Data resep",
            "dataRekamMedis" => $carirm
        ]);
    }

    // public function dataRekamMedisPasien($nomor_rekam_medis)
    // {
    //     // Ambil query dasar
    //     $rekamMedisQuery = medical_reports::with(['patients', 'medical_staff'])
    //         ->where('nomor_rekam_medis', $nomor_rekam_medis);

    //     // Filter pencarian berdasarkan keluhan atau nomor rekam medis (jika ada permintaan pencarian)
    //     if (request('cari')) {
    //         $rekamMedisQuery->where(function ($query) {
    //             $query->where('keluhan', 'like', '%' . request('cari') . '%')
    //                 ->orWhere('nomor_rekam_medis', 'like', '%' . request('cari') . '%');
    //         });
    //     }

    //     // Ambil data rekam medis berdasarkan query
    //     $rekamMedis = $rekamMedisQuery->get();

    //     // Ambil data pasien
    //     $patient = patients::where('nomor_rekam_medis', $nomor_rekam_medis)->first();

    //     // Jika tidak ada data pasien atau rekam medis
    //     if ($rekamMedis->isEmpty() || !$patient) {
    //         return redirect('/rekamMedis')->with('error', 'Data rekam medis tidak ditemukan untuk pasien ini.');
    //     }

    //     // Kirim data ke view
    //     return view('dashBoard.resep', [
    //         'title' => 'Data Rekam Medis Pasien',
    //         'dataRekamMedis' => $rekamMedis,
    //         'pasien' => $patient, // Kirim data pasien ke view
    //     ]);
    // }

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
     * @param  \App\Models\resep_obat  $resep_obat
     * @return \Illuminate\Http\Response
     */
    public function show(resep_obat $resep_obat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\resep_obat  $resep_obat
     * @return \Illuminate\Http\Response
     */
    public function edit(resep_obat $resep_obat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\resep_obat  $resep_obat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, resep_obat $resep_obat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\resep_obat  $resep_obat
     * @return \Illuminate\Http\Response
     */
    public function destroy(resep_obat $resep_obat)
    {
        //
    }

    public function formResep($id_rekam_medis)
    {
        // Ambil data rekam medis berdasarkan ID
        $rekamMedis = medical_reports::with(['patients', 'medical_staff'])->findOrFail($id_rekam_medis);

        // Ambil data obat dari tabel Obat
        $obat = medicines::all();

        // Kirim data ke view
        return view('dashBoard.formResep', [
            'rekamMedis' => $rekamMedis,
            'obat' => $obat
        ]);
    }

    public function storeResep(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_rekam_medis' => 'required|exists:medical_reports,id_rekam_medis',
            'obat' => 'required|array|min:1',
            'obat.*' => 'required|exists:medicines,id_obat', // Pastikan ID obat valid
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1', // Pastikan jumlah obat valid
        ]);

        // Ambil data obat sekaligus untuk efisiensi
        $medicines = medicines::whereIn('id_obat', $request->obat)->get()->keyBy('id_obat');

        // Validasi stok obat sebelum transaksi
        foreach ($request->obat as $obat_id) {
            $jumlah = $request->jumlah[$obat_id] ?? 0;

            if (!isset($medicines[$obat_id]) || $medicines[$obat_id]->stok < $jumlah) {
                return redirect()
                    ->route('rekamMedis')
                    ->with('error', "Stok obat {$medicines[$obat_id]->nama_obat} tidak mencukupi.");
            }
        }

        // Mulai transaksi
        DB::beginTransaction();
        try {
            // Menyimpan data resep ke tabel 'resep'
            $resep = new Resep();
            $resep->id_rekam_medis = $request->id_rekam_medis;
            $resep->tanggal_resep = now(); // Waktu saat ini
            $resep->save();

            // Menyimpan data obat yang dipilih ke tabel 'resep_obat'
            foreach ($request->obat as $obat_id) {
                $jumlah = $request->jumlah[$obat_id];

                // Cek jika entri sudah ada dalam `resep_obat`
                if (resep_obat::where('id_resep', $resep->id_resep)
                    ->where('id_obat', $obat_id)->exists()) {
                    continue; // Lewati jika data sudah ada
                }

                // Insert ke tabel resep_obat
                $resepObat = new resep_obat();
                $resepObat->id_resep = $resep->id_resep;
                $resepObat->id_obat = $obat_id;
                $resepObat->jumlah = $jumlah;
                $resepObat->save();

                // Update stok obat
                $medicine = $medicines[$obat_id];
                $medicine->stok -= $jumlah;
                $medicine->save();
            }

            // Commit transaksi jika semua berhasil
            DB::commit();

            // Redirect dengan pesan sukses
            return redirect()
                ->route('rekamMedis')
                ->with('success', 'Resep berhasil disimpan!');
        } catch (\Exception $e) {
            // Rollback transaksi jika ada kesalahan
            DB::rollback();

            // Logging error untuk debugging
            Log::error('Error saat menyimpan resep: ' . $e->getMessage());

            return redirect()
                ->route('resep')
                ->with('error', 'Terjadi kesalahan saat menyimpan resep: ' . $e->getMessage());
        }
    }






    public function search(Request $request)
    {
        $query = $request->get('q', '');

        $obat = medicines::where('nama_obat', 'LIKE', '%' . $query . '%')
                    ->select('id_obat', 'nama_obat')
                    ->get();

        return response()->json($obat);
    }

}
