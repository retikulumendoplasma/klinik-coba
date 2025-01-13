<?php

namespace App\Http\Controllers;

use App\Models\medicines;
use Illuminate\Http\Request;

class DataObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obat = medicines::query();
        if (request('cari')) {
            $obat->where(function ($query) {
                $query->where('nama_obat', 'like', '%' . request('cari') . '%')
                      ->orWhere('jenis_obat', 'like', '%' . request('cari') . '%');
            });
        }

        $cariobat = $obat->get();

        return view('dashBoard.dataObat', [
            "title" => "Data Obat",
            "dataObat" => $cariobat
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
    
    public function formTambahObat()
    {
        return view('/dashboard.tambahObat', [
            "title" => "Tambah Obat",
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string',
            'jenis_obat' => 'required',
            'supplier' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
            'keterangan' => 'required'
        ]);

        // dd($request->all());
        medicines::create($request->all());

        return redirect('/dataObat')->with('success', 'Data Obat berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function show(medicines $medicines)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function edit(medicines $medicines)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, medicines $medicines)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function destroy(medicines $medicines)
    {
        //
    }
}
