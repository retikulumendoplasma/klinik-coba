<?php

namespace App\Http\Controllers;

use App\Models\jenis_tindakan;
use App\Models\medical_reports;
use App\Models\resep;
use App\Models\resep_obat;
use App\Models\tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TindakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function viewTindakan()
    {
        // Query untuk pasien yang belum mendapatkan tindakan
        $rekamMedisBelumTindakan = medical_reports::query()
            ->with(['patients', 'medical_staff']) // Memuat relasi pasien dan staf medis
            ->whereDoesntHave('tindakan'); // Memilih data yang tidak memiliki tindakan
    
        // Query untuk pasien yang sudah mendapatkan tindakan
        $rekamMedisSudahTindakan = medical_reports::query()
            ->with(['patients', 'medical_staff']) // Memuat relasi pasien dan staf medis
            ->whereHas('tindakan'); // Memilih data yang memiliki tindakan
    
        // Jika ada pencarian, filter berdasarkan nama pasien atau nomor rekam medis
        if (request('cari')) {
            $rekamMedisBelumTindakan->where(function ($query) {
                $query->whereHas('patients', function ($subQuery) {
                    $subQuery->where('nama', 'like', '%' . request('cari') . '%');
                })->orWhere('nomor_rekam_medis', 'like', '%' . request('cari') . '%');
            });
    
            $rekamMedisSudahTindakan->where(function ($query) {
                $query->whereHas('patients', function ($subQuery) {
                    $subQuery->where('nama', 'like', '%' . request('cari') . '%');
                })->orWhere('nomor_rekam_medis', 'like', '%' . request('cari') . '%');
            });
        }
    
        // Ambil data hasil pencarian
        $belumTindakan = $rekamMedisBelumTindakan->get();
        $sudahTindakan = $rekamMedisSudahTindakan->get();
    
        // Kirim data ke view
        return view('dashBoard.viewTindakan', [
            "title" => "Data Tindakan",
            "belumTindakan" => $belumTindakan,
            "sudahTindakan" => $sudahTindakan,
        ]);
    }
    
    

    public function formTindakan($id_rekam_medis)
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
        $dataResep = collect(); // Koleksi kosong
        if ($resep) {
            $dataResep = resep_obat::with('medicines')
                ->where('id_resep', $resep->id_resep)
                ->get();
        }


        return view('dashBoard.formTindakan', [
            'rekamMedis' => $rekamMedis,
            'resep' => $resep ?? null, // Fallback ke null jika tidak ada resep
            'dataResep' => $dataResep,
        ]);
    }

    public function storeTindakan(Request $request)
    {
        // Validasi request
        $request->validate([
            'id_rekam_medis' => 'required|exists:medical_reports,id_rekam_medis', // Sesuaikan dengan nama tabel
            'id_jenis_tindakan' => 'required|array',
            'id_jenis_tindakan.*' => 'exists:jenis_tindakan,id_jenis_tindakan',
            'harga_tindakan' => 'required|array',
            'harga_tindakan.*' => 'numeric|min:0', // Pastikan harga_tindakan berupa angka
        ]);

        // Mengambil input dari request
        $idRekamMedis = $request->input('id_rekam_medis');
        $idJenisTindakan = $request->input('id_jenis_tindakan');
        $hargaTindakan = $request->input('harga_tindakan');

        // Pastikan harga_tindakan hanya berisi angka yang valid
        foreach ($hargaTindakan as $index => $harga) {
            // Hapus titik dan pastikan menjadi integer
            $hargaTindakan[$index] = (int) str_replace('.', '', $harga);
        }

        // Menyimpan data tindakan
        foreach ($idJenisTindakan as $index => $idJenis) {
            Tindakan::create([
                'id_rekam_medis' => $idRekamMedis,
                'id_jenis_tindakan' => $idJenis,
                'harga_tindakan' => $hargaTindakan[$index],
                'tanggal_tindakan' => now(), // Isi otomatis dengan tanggal sekarang
            ]);
        }

        return redirect('/viewTindakan')->with('success', 'Tindakan berhasil disimpan!');
    }



    public function detailTindakanPasien($id_rekam_medis)
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
        $dataResep = collect(); // Koleksi kosong
        $totalBiayaObat = 0; // Total biaya obat
        if ($resep) {
            $dataResep = resep_obat::with('medicines')
                ->where('id_resep', $resep->id_resep)
                ->get();
    
            // Hitung total biaya obat (misalkan ada kolom harga di tabel medicines)
            $totalBiayaObat = $dataResep->sum(function ($item) {
                return $item->medicines->harga_jual * $item->jumlah; // Harga * jumlah
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
    
        return view('dashBoard.detailTindakanPasien', [
            'rekamMedis' => $rekamMedis,
            'resep' => $resep ?? null, // Fallback ke null jika tidak ada resep
            'dataResep' => $dataResep,
            'listTindakan' => $listTindakan, // Data tindakan
            'totalBiayaTindakan' => $totalBiayaTindakan, // Total biaya tindakan
            'totalBiayaObat' => $totalBiayaObat, // Total biaya obat
            'totalBiaya' => $totalBiaya, // Total biaya keseluruhan (tindakan + obat)
        ]);
    }
    
    
    

    
    public function searchTindakan(Request $request)
    {
        $query = $request->input('q');
        $tindakan = jenis_tindakan::where('nama_tindakan', 'like', "%$query%")
            ->select('id_jenis_tindakan', 'nama_tindakan', 'harga_tindakan')
            ->get();

        return response()->json($tindakan);
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
     * @param  \App\Models\tindakan  $tindakan
     * @return \Illuminate\Http\Response
     */
    public function show(tindakan $tindakan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tindakan  $tindakan
     * @return \Illuminate\Http\Response
     */
    public function edit($id_tindakan)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tindakan  $tindakan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_tindakan)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tindakan  $tindakan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_tindakan)
    {
        $tindakan = tindakan::find($id_tindakan);

        // Hapus data jika ditemukan
        if ($tindakan) {
            $tindakan->delete();
            return redirect('/viewTindakan')->with('success', 'Data Tindakan berhasil dihapus.');
        } else {
            return redirect('/viewTindakan')->with('error', 'Tindakan tidak ditemukan.');
        }
    }
}
