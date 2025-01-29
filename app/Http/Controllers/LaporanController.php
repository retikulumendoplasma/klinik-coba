<?php

namespace App\Http\Controllers;

use App\Charts\KunjunganPasienBulanan;
use App\Models\laporan;
use App\Models\medical_reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KunjunganPasienBulanan $chart)
    {
        $dataKunjunganPasien = $chart->build();
    
        $dataLaporan = DB::table('tindakan')
            ->select(
                DB::raw('DATE(tindakan.tanggal_tindakan) as tanggal'),
                DB::raw('COUNT(DISTINCT medical_reports.nomor_rekam_medis) as total_kunjungan'), // Total kunjungan pasien
                DB::raw('COUNT(tindakan.id_tindakan) as total_tindakan'), // Total tindakan
                DB::raw('SUM(jenis_tindakan.harga_tindakan) as total_harga_tindakan'), // Total harga tindakan
                DB::raw('SUM(transaksi.grand_total) as total_transaksi') // Total transaksi
            )
            ->leftJoin('jenis_tindakan', 'tindakan.id_jenis_tindakan', '=', 'jenis_tindakan.id_jenis_tindakan') // Join tabel jenis_tindakan
            ->leftJoin('medical_reports', 'tindakan.id_rekam_medis', '=', 'medical_reports.id_rekam_medis') // Join tabel rekam medis
            ->leftJoin('transaksi', 'medical_reports.id_rekam_medis', '=', 'transaksi.id_rekam_medis') // Join tabel transaksi
            ->groupBy('tanggal') // Kelompokkan berdasarkan tanggal
            ->orderBy('tanggal', 'ASC') // Urutkan berdasarkan tanggal
            ->get();
    
        return view('dashBoard.viewLaporan', [
            "title" => "Data Laporan",
            "chart" => $dataKunjunganPasien,
            'dataLaporan' => $dataLaporan,
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
