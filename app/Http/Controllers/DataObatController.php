<?php

namespace App\Http\Controllers;

use App\Models\medicines;
use Illuminate\Http\Request;
use App\Models\medical_reports;
use App\Models\medical_staff;
use App\Models\patients;

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
            'keterangan' => 'nullable|string'
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
    public function edit($id_obat)
    {
        $obat = medicines::find($id_obat);

        if (!$obat) {
            return redirect('/dataobat')->with('error', 'obat/Perawat tidak ditemukan');
        };

        return view('dashBoard.editObat', [
            "title" => "Edit Obat",
            "obat" => $obat,
            // 'jabatan_options' => $jabatan_options
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_obat)
    {
        $validatedData = $request->validate([
            'nama_obat' => 'required',
            'jenis_obat' => 'required|string',
            'supplier' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
            'keterangan' => 'nullable|string'
        ]);

        $obat = medicines::find($id_obat);
        if (!$obat) {
            return redirect('/dataObat')->with('error', 'Data obat tidak ditemukan');
        }
        // dd($request->all());
        $obat->update($validatedData);

        return redirect('/dataObat')->with('success', 'Data obat berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_obat)
    {
        $obat = medicines::find($id_obat);

        // Hapus penduduk jika ditemukan
        if ($obat) {
            $obat->delete();
            return redirect('/dataObat')->with('success', 'Data obat berhasil dihapus.');
        } else {
            return redirect('/dataObat')->with('error', 'Berita tidak ditemukan.');
        }
    }

}
