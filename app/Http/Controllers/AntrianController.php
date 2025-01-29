<?php

namespace App\Http\Controllers;

use App\Events\PasienBaruDitambahkan;
use App\Models\antrian;
use App\Models\patients;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $antrianHariIni = Antrian::whereDate('jam_kedatangan', Carbon::today())
        ->with('patients') // Lazy loading relasi ke tabel patients
        ->get();

        return view('dashBoard.viewAntrian', [
            'title' => 'Data Rekam Medis',
            'dataAntrian' => $antrianHariIni,
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        
        // Cari pasien berdasarkan nama atau nomor rekam medis
        $patients = patients::where('nama', 'LIKE', "%$query%")
            ->orWhere('nomor_rekam_medis', 'LIKE', "%$query%")
            ->get(['nomor_rekam_medis', 'nama']); // Hanya ambil field yang diperlukan

        return response()->json($patients);
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
        $validated = $request->validate([
            'nomor_rekam_medis' => 'required|exists:patients,nomor_rekam_medis',
        ]);
    
        $pasien = patients::where('nomor_rekam_medis', $validated['nomor_rekam_medis'])->first();
    
        // Simpan ke tabel antrian
        antrian::create([
            'nomor_rekam_medis' => $pasien->nomor_rekam_medis,
            'status' => 'Antri',
            'jam_kedatangan' => now(),
        ]);
        broadcast(new PasienBaruDitambahkan([
            'nomor_rekam_medis' => $pasien->nomor_rekam_medis,
            'nama' => $pasien->nama,
            'alamat' => $pasien->alamat,
            'nomor_hp' => $pasien->nomor_hp,
        ]));
    
        return redirect()->back()->with('success', 'Pasien berhasil ditambahkan ke antrian.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function show(antrian $antrian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function edit(antrian $antrian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, antrian $antrian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function destroy(antrian $antrian)
    {
        //
    }
}
