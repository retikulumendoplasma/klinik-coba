<?php

namespace App\Http\Controllers;

use App\Charts\KunjunganPasienBulanan;
use App\Models\laporan;
use App\Models\medical_reports;
use Carbon\Carbon;
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

    public function laporanHarian($tanggal)
    {
        // Query untuk mendapatkan data laporan harian
        $dataTransaksi = DB::table('medical_reports as mr')
            ->join('patients as p', 'mr.nomor_rekam_medis', '=', 'p.nomor_rekam_medis')
            ->join('transaksi as tr', 'mr.id_rekam_medis', '=', 'tr.id_rekam_medis')
            ->select(
                'p.nomor_rekam_medis',
                'p.nama as nama_pasien',
                'tr.total_biaya_obat',
                'tr.total_biaya_tindakan',
                'tr.grand_total'
            )
            ->whereDate('tr.tanggal_transaksi', '=', $tanggal)
            ->get();

        // Hitung grand total untuk footer
        $grandTotal = $dataTransaksi->sum('grand_total');

        // Kembalikan data ke view
        return view('dashBoard.laporanHarian', [
            'tanggal' => $tanggal,
            'dataTransaksi' => $dataTransaksi,
            'grandTotal' => $grandTotal,
        ]);
    }

    public function laporanBulanan(Request $request, KunjunganPasienBulanan $chart)
    {
        $dataKunjunganPasien = $chart->build();
    
        // Pastikan nilai bulan dan tahun ada
        $bulan = $request->input('bulan', Carbon::now()->format('m'));
        $tahun = $request->input('tahun', Carbon::now()->format('Y'));
    
        // Pastikan query dijalankan sesuai bulan dan tahun yang benar
        $laporanBulanan = DB::table('medical_reports as mr')
            ->join('patients as p', 'mr.nomor_rekam_medis', '=', 'p.nomor_rekam_medis')
            ->join('transaksi as tr', 'mr.id_rekam_medis', '=', 'tr.id_rekam_medis')
            ->selectRaw("
                DATE(mr.tanggal_berobat) as tanggal_laporan,
                COUNT(DISTINCT mr.id_rekam_medis) as total_kunjungan,
                COALESCE(SUM(tr.total_biaya_obat), 0) as total_biaya_obat,
                COALESCE(SUM(tr.total_biaya_tindakan), 0) as total_biaya_tindakan,
                COALESCE(SUM(tr.grand_total), 0) as total_pemasukan
            ")
            ->whereMonth('mr.tanggal_berobat', '=', $bulan)
            ->whereYear('mr.tanggal_berobat', '=', $tahun)
            ->groupBy(DB::raw('DATE(mr.tanggal_berobat)'))
            ->orderBy(DB::raw('DATE(mr.tanggal_berobat)'))  // Perbaikan di sini
            ->get();
    
        // Total keseluruhan
        $totalKeseluruhan = [
            'total_kunjungan' => $laporanBulanan->sum('total_kunjungan'),
            'total_biaya_obat' => $laporanBulanan->sum('total_biaya_obat'),
            'total_biaya_tindakan' => $laporanBulanan->sum('total_biaya_tindakan'),
            'total_pemasukan' => $laporanBulanan->sum('total_pemasukan'),
        ];
    
        // Kirim data ke view
        return view('dashBoard.viewLaporan', [
            'bulan' => Carbon::create()->month($bulan)->translatedFormat('F'),
            'tahun' => $tahun,
            'laporanBulanan' => $laporanBulanan,
            'totalKeseluruhan' => $totalKeseluruhan,
            'filter_bulan' => $bulan,
            'filter_tahun' => $tahun,
            "chart" => $dataKunjunganPasien,
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
