<?php

namespace App\Http\Controllers;

use App\Models\laporan;
use App\Models\medical_reports;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    
        return view('dashBoard.viewLaporan', [
            "title" => "Data Rekam Medis",
            "dataRekamMedis" => $dataRekamMedis
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
     * @param  \App\Models\laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show(laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(laporan $laporan)
    {
        //
    }
}
