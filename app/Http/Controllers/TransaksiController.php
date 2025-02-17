<?php


namespace App\Http\Controllers;

use App\Events\TransaksiBaru;
use App\Models\billing_report;
use App\Models\medical_reports;
use App\Models\resep;
use App\Models\resep_obat;
use App\Models\tindakan;
use App\Models\transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use mike42\Escpos\EscposImage;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil semua data transaksi
        $transaksiList = Transaksi::with('medical_reports.patients')
        ->orderBy('tanggal_transaksi', 'desc')
        ->get();
    
        return view('dashBoard.listTransaksi', compact('transaksiList'));
    }
    

    public function viewTransaksi()
    {
        $rekamMedis = medical_reports::where(function ($query) {
                $query->whereHas('resep') // Rekam medis yang memiliki resep
                      ->orWhereHas('tindakan'); // Rekam medis yang memiliki tindakan
            })
            ->whereDoesntHave('transaksi') // Rekam medis yang tidak memiliki transaksi
            ->with(['resep', 'tindakan', 'patients', 'medical_staff']) // Load relasi terkait
            ->get();
    
        return view('dashBoard.viewTransaksi', [
            "title" => "Data Transaksi",
            "dataTransaksi" => $rekamMedis
        ]);
    }
    
    

    public function formTransaksi($id_rekam_medis)
    {
        // Ambil data rekam medis beserta informasi pasien dan staf medis
        $rekamMedis = medical_reports::with(['patients', 'medical_staff'])
            ->where('id_rekam_medis', $id_rekam_medis)
            ->firstOrFail();
    
        // Ambil data resep terkait rekam medis
        $resep = resep::with('resep_obat.medicines')
            ->where('id_rekam_medis', $id_rekam_medis)
            ->first();
    
        // Ambil daftar obat yang terkait dengan resep, jika ada
        $totalBiayaObat = 0; // Total biaya obat
        $uang = 0; // Total biaya obat
        $kembalian = 0; // Total biaya obat
        $dataResep = collect(); // Koleksi kosong
        if ($resep) {
            $dataResep = resep_obat::with('medicines')
                ->where('id_resep', $resep->id_resep)
                ->get();
    
            // Hitung total biaya obat dengan logika satuan
            $totalBiayaObat = $dataResep->sum(function ($item) {
                $hargaJual = $item->medicines->harga_jual ?? 0; // Harga jual obat
                if ($item->satuan === 'papan') {
                    $hargaJual *= 10; // Kalikan harga jika satuan adalah 'papan'
                }
                return $hargaJual * $item->jumlah; // Harga jual (sudah disesuaikan) * jumlah
            });
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
                'biaya' => $tindakan->harga_tindakan ?? 0, // Harga tindakan
            ];
        });
    
        // Hitung total biaya tindakan
        $totalBiayaTindakan = $listTindakan->sum('biaya');
    
        // Hitung total keseluruhan biaya (tindakan + obat)
        $totalBiaya = $totalBiayaObat + $totalBiayaTindakan;
    
        return view('dashBoard.formTransaksi', [
            'rekamMedis' => $rekamMedis,
            'resep' => $resep ?? null, // Fallback ke null jika tidak ada resep
            'dataResep' => $dataResep,
            'listTindakan' => $listTindakan, // Data tindakan
            'totalBiayaTindakan' => $totalBiayaTindakan, // Total biaya tindakan
            'totalBiayaObat' => $totalBiayaObat, // Total biaya obat
            'totalBiaya' => $totalBiaya, // Total biaya keseluruhan (tindakan + obat)
            'uangPasien' => $uang, 
            'kembalianPasien' => $kembalian, 
        ]);
    }

    public function updateTotalBiaya(Request $request)
    {
        // Ambil data dari request
        $totalBiayaObat = str_replace('.', '', $request->totalBiayaObat); // Hilangkan format
        $totalBiayaTindakan = str_replace('.', '', $request->totalBiayaTindakan);

        // Simpan data ke database (sesuaikan tabel jika perlu)
        // Contoh: menyimpan ke tabel transaksi
        transaksi::updateOrCreate(
            ['id' => 1], // Ganti dengan kondisi sesuai kebutuhan
            [
                'total_biaya_obat' => $totalBiayaObat,
                'total_biaya_tindakan' => $totalBiayaTindakan,
                'grand_total' => $totalBiayaObat + $totalBiayaTindakan,
            ]
        );

        return redirect()->back()->with('success', 'Total biaya berhasil diperbarui.');
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
    
    public function storeTransaksi(Request $request)
    {
        // Format dan ubah input
        $request->merge([
            'total_biaya_obat' => (int) str_replace('.', '', $request->total_biaya_obat),
            'total_biaya_tindakan' => (int) str_replace('.', '', $request->total_biaya_tindakan),
            'bayar' => (int) str_replace('.', '', $request->bayar),
            'kembalian' => (int) str_replace('.', '', $request->kembalian),
            'grand_total' => (int) str_replace('.', '', $request->grand_total),
        ]);
    
        // Validasi input
        $request->validate([
            'id_rekam_medis' => 'required|exists:medical_reports,id_rekam_medis',
            'total_biaya_obat' => 'required|integer',
            'total_biaya_tindakan' => 'required|integer',
            'bayar' => 'required|integer',
            'kembalian' => 'required|integer',
            'grand_total' => 'required|integer',
        ]);
    
        try {
            // Simpan transaksi ke database dan ambil ID transaksi yang baru
            $id_transaksi = DB::table('transaksi')->insertGetId([
                'id_rekam_medis' => $request->id_rekam_medis,
                'total_biaya_obat' => $request->total_biaya_obat,
                'total_biaya_tindakan' => $request->total_biaya_tindakan,
                'bayar' => $request->bayar,
                'kembalian' => $request->kembalian,
                'grand_total' => $request->grand_total,
                'tanggal_transaksi' => now(),
            ]);
    
            // Cari nomor rekam medis dari medical_reports
            $medicalReport = DB::table('medical_reports')
                ->where('id_rekam_medis', $request->id_rekam_medis)
                ->first();
    
            if (!$medicalReport) {
                return redirect('/')->withErrors(['error' => 'Rekam medis tidak ditemukan.']);
            }
    
            // Cari antrian berdasarkan nomor rekam medis (dari tabel patients yang memiliki nomor_rekam_medis)
            $antrian = DB::table('antrian')
                ->where('nomor_rekam_medis', $medicalReport->nomor_rekam_medis)
                ->first();
    
            if ($antrian) {
                // Update status antrian menjadi 'Selesai'
                DB::table('antrian')
                    ->where('nomor_rekam_medis', $medicalReport->nomor_rekam_medis)
                    ->update(['status' => 'Selesai']);
            } else {
                // Jika antrian tidak ditemukan
                return redirect('/')->withErrors(['error' => 'Nomor rekam medis tidak ditemukan dalam antrian.']);
            }
    
            // Redirect ke halaman cetak struk dengan ID transaksi
            return redirect()->route('cetakBayar', ['id_transaksi' => $id_transaksi])
                ->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangani error
            return redirect('/')->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\billing_report  $billing_report
     * @return \Illuminate\Http\Response
     */
    public function show(billing_report $billing_report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\billing_report  $billing_report
     * @return \Illuminate\Http\Response
     */
    public function edit(billing_report $billing_report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\billing_report  $billing_report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, billing_report $billing_report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\billing_report  $billing_report
     * @return \Illuminate\Http\Response
     */
    public function destroy(billing_report $billing_report)
    {
        //
    }

    public function printStruk($id)
    {
        $transaksi = Transaksi::with('medical_reports.patients')
            ->where('id_transaksi', $id)
            ->firstOrFail();

        return view('dashBoard.struk', compact('transaksi'));
    }

    public function cetakStruk(Request $request, $id_transaksi)
    {
        $transaksi = Transaksi::with('medical_reports.patients')->find($id_transaksi);

        if ($transaksi) {
            // Setup printer
            $profile = CapabilityProfile::load("RP326");
            $connector = new WindowsPrintConnector("POS-58"); // Ganti dengan nama printer Anda
            $printer = new Printer($connector, $profile);

            // **Tambahkan Logo**
            $logoPath = public_path('public\img\logo2.2.png'); // Path ke file logo
            if (file_exists($logoPath)) {
                $logo = EscposImage::load($logoPath, false);
                $printer->bitImage($logo); // Cetak logo
            }

            // Cetak header
            $printer->setEmphasis(true);
            $printer->text("           KLINIK THT\n");
            $printer->text("    TAMTAMA MEDICAL CENTER\n");
            $printer->setEmphasis(false);
            $printer->text("\n");
            $printer->text("Jl. TAMTAMA 10, BINJAI\n");
            $printer->text("Telp: (061)8823303 / 08126024237\n");

            // Garis pemisah
            $printer->text("--------------------------------\n");

            // Teks Transaksi
            $printer->setEmphasis(true);
            $printer->text("TRANSAKSI\n");
            $printer->setEmphasis(false);

            // Garis pemisah
            $printer->text("--------------------------------\n");

            // Detail Transaksi
            $printer->text("Nama Pasien      : " . $transaksi->medical_reports->patients->nama . "\n");
            $printer->text("Tanggal Berobat  : " . Carbon::parse($transaksi->medical_reports->tanggal_berobat)->format('d-m-Y') . "\n");
            $printer->text("Nomor Rekam Medis: " . $transaksi->medical_reports->patients->nomor_rekam_medis . "\n");

            // Garis pemisah
            $printer->text("--------------------------------\n");

            $printer->text("Total Biaya Obat\n");
            $printer->text("              : Rp " . number_format($transaksi->total_biaya_obat, 0, ',', '.') . "\n");
            if ($transaksi->total_biaya_tindakan < 1) {
                $printer->text("Total Biaya Tindakan\n");
                $printer->text("              : GRATIS\n");
            }
            else {
                $printer->text("Total Biaya Tindakan\n");
                $printer->text("              : Rp " . number_format($transaksi->total_biaya_tindakan, 0, ',', '.') . "\n");
            }
            

            // Garis pemisah
            $printer->text("--------------------------------\n");

            // Grand Total
            $printer->setEmphasis(true);
            $printer->text("Grand Total\n");
            $printer->text("              : Rp " . number_format($transaksi->grand_total, 0, ',', '.') . "\n");
            $printer->setEmphasis(false);

            // Garis pemisah
            $printer->text("--------------------------------\n");

            $printer->text("Bayar\n");
            $printer->text("              : Rp " . number_format($transaksi->bayar, 0, ',', '.') . "\n");

            $printer->setEmphasis(true);
            $printer->text("Kembalian\n");
            $printer->text("              : Rp " . number_format($transaksi->kembalian, 0, ',', '.') . "\n");
            $printer->setEmphasis(false);

            // Garis pemisah
            $printer->text("--------------------------------\n");

            // Pesan Terima Kasih
            $printer->text("Terima kasih semoga lekas sembuh\n");
                                         
            // Potong struk
            $printer->cut();
            $printer->close();
        
            // Setelah pencetakan selesai, tampilkan struk di browser dan tutup tab setelah pencetakan
            return view('cetak-struk', compact('transaksi'));
        } else {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan!');
        }
    }

    public function cetakBayar(Request $request,$id_transaksi)
    {
        $transaksi = Transaksi::with('medical_reports.patients')->find($id_transaksi);

        if ($transaksi) {
            // Setup printer
            $profile = CapabilityProfile::load("RP326");
            $connector = new WindowsPrintConnector("POS-58"); // Ganti dengan nama printer Anda
            $printer = new Printer($connector, $profile);

            // **Tambahkan Logo**
            $logoPath = public_path('public\img\logo2.2.png'); // Path ke file logo
            if (file_exists($logoPath)) {
                $logo = EscposImage::load($logoPath, false);
                $printer->bitImage($logo); // Cetak logo
            }

            // Cetak header
            $printer->setEmphasis(true);
            $printer->text("           KLINIK THT\n");
            $printer->text("    TAMTAMA MEDICAL CENTER\n");
            $printer->setEmphasis(false);
            $printer->text("\n");
            $printer->text("Jl. TAMTAMA 10, BINJAI\n");
            $printer->text("Telp: (061)8823303 / 08126024237\n");

            // Garis pemisah
            $printer->text("--------------------------------\n");

            // Teks Transaksi
            $printer->setEmphasis(true);
            $printer->text("TRANSAKSI\n");
            $printer->setEmphasis(false);

            // Garis pemisah
            $printer->text("--------------------------------\n");

            // Detail Transaksi
            $printer->text("Nama Pasien      : " . $transaksi->medical_reports->patients->nama . "\n");
            $printer->text("Tanggal Berobat  : " . Carbon::parse($transaksi->medical_reports->tanggal_berobat)->format('d-m-Y') . "\n");
            $printer->text("Nomor Rekam Medis: " . $transaksi->medical_reports->patients->nomor_rekam_medis . "\n");

            // Garis pemisah
            $printer->text("--------------------------------\n");

            $printer->text("Total Biaya Obat\n");
            $printer->text("              : Rp " . number_format($transaksi->total_biaya_obat, 0, ',', '.') . "\n");
            if ($transaksi->total_biaya_tindakan < 1) {
                $printer->text("Total Biaya Tindakan\n");
                $printer->text("              : GRATIS\n");
            }
            else {
                $printer->text("Total Biaya Tindakan\n");
                $printer->text("              : Rp " . number_format($transaksi->total_biaya_tindakan, 0, ',', '.') . "\n");
            }
            

            // Garis pemisah
            $printer->text("--------------------------------\n");

            // Grand Total
            $printer->setEmphasis(true);
            $printer->text("Grand Total\n");
            $printer->text("              : Rp " . number_format($transaksi->grand_total, 0, ',', '.') . "\n");
            $printer->setEmphasis(false);

            $printer->text("--------------------------------\n");

            $printer->text("Bayar\n");
            $printer->text("              : Rp " . number_format($transaksi->bayar, 0, ',', '.') . "\n");

            $printer->setEmphasis(true);
            $printer->text("Kembalian\n");
            $printer->text("              : Rp " . number_format($transaksi->kembalian, 0, ',', '.') . "\n");
            $printer->setEmphasis(false);


            // Garis pemisah
            $printer->text("--------------------------------\n");

            // Pesan Terima Kasih
            $printer->text("Terima kasih semoga lekas sembuh\n");
                                         
            // Potong struk
            $printer->cut();
            $printer->close();
        
            // Setelah pencetakan selesai, tampilkan struk di browser dan tutup tab setelah pencetakan
            return redirect('/listTransaksi');
        } else {
            return redirect('/')->with('error', 'Gagal cetak struk, silakan cetak ulang struk');
        }
    }

}
