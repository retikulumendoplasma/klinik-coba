<?php

namespace App\Http\Controllers;

use App\Models\saran_dan_masukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SaranDanMasukanController extends Controller
{
    public function index()
{
    return view('saranmasukan', [
        "title" => "Saran dan Masukan",
        "saranmasukan" => saran_dan_masukan::latest('id')->get(),
    ]);
}

    public function indexsaran()

    {
        return view('dashBoard.saranMasukanAdmin', [

            "title" => "Saran dan Masukan",

            "saranmasukan" => saran_dan_masukan::latest('id')->get(),
        ]);
    }

    public function indexbalasan($id)
    {
        return view('dashBoard.balasSaran', [

            "title" => "Balas Saran dan Masukan",
            "saranmasukan" => saran_dan_masukan::find($id)
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'isi_saran' => 'required',
            'tanggal_saran_masuk' => 'required|date',
        ]);
        $userId = Auth::id();
        $validatedData['id_user'] = $userId;
        // dd($request->all());
        saran_dan_masukan::create($validatedData);


        return redirect('/saranmasukan')->with('success', 'Berhasil memberi saran');
    }

    public function storebalasan(Request $request, $id)
    {
        $request->validate([
            'isi_balasan' => 'required',
            'tanggal_balasan' => 'required|date',
        ]);
        
        // dd($request->all());
        $balasan = saran_dan_masukan::find($id);
        $balasan->update([
            'isi_balasan' => $request->isi_balasan,
            'tanggal_balasan' => $request->tanggal_balasan,
        ]);

        return redirect('/saranMasukanAdmin')->with('success', 'Berhasil memberi balasan');
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'isi_balasan' => 'required',
            'tanggal_balasan' => 'required|date',
        ]);
        // dd($validatedData);
        $balasan = saran_dan_masukan::find($id);
        $balasan->update($validatedData);
        return redirect('/saranMasukanAdmin')->with('success', 'Berhasil edit balasan');
    }
}
