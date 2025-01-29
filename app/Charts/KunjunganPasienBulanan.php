<?php

namespace App\Charts;

use App\Models\medical_reports;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class KunjunganPasienBulanan
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // Ambil data rekam medis per bulan menggunakan tanggal_berobat
        $data = DB::table('medical_reports')
        ->select(DB::raw('MONTH(tanggal_berobat) as month'), DB::raw('COUNT(*) as total'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Konversi data ke array untuk grafik
        $labels = $data->pluck('month')->map(function ($month) {
            return date('F', mktime(0, 0, 0, $month, 10)); // Ubah angka bulan jadi nama bulan
        })->toArray();
        $values = $data->pluck('total')->toArray();

        // Buat grafik menggunakan Larapex Charts
        return $this->chart->lineChart()
            ->setTitle('Laporan Pasien Bulanan')
            ->setSubtitle('Jumlah Pasien per Bulan')
            ->addData('Pasien', $values)
            ->setXAxis($labels);
    }
}
