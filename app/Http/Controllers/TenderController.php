<?php

namespace App\Http\Controllers;

use App\Models\tender;
use App\Models\pengaju_proposal_tender;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatetenderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function tampil()
    {
        return view('tender', [
            //pengisian berita
            "title" => "Tender",
            //data berita sudah tersimpan dalam models berita
            "dataTender" => tender::all()
        ]);
    }

    public function tampilVote()
    {
        return view('tenderVote', [
            //pengisian berita
            "title" => "Tender Vote",
            //data berita sudah tersimpan dalam models berita
            "dataTender" => tender::all()
        ]);
    }

    public function index()
    {
        return view('dashBoard.kelolaTender', [
            //pengisian berita
            "title" => "Data Tender",
            //data berita sudah tersimpan dalam models berita
            "dataTender" => tender::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashBoard.buatTender', [
            //pengisian berita
            "title" => "Buat Tender"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoretenderRequest  $request
     
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'judul_tender' => 'required|max:100',
            'jadwal_tender_dimulai' => 'required|date',
            'jadwal_tender_berakhir' => 'required|date',
            'anggaran_dana' => 'required',
            'gambar_tender' => 'required|string',
        ]);
        // dd($request->all());
        tender::create($request->all());


        return redirect('/kelolaTender')->with('success', 'Tambah Tender Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function show(tender $tender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function edit(tender $tender)
    {
        return view('dashBoard.editTender', [
            "title" => "Edit Tender",
            "tender" => $tender,
            //data berita sudah tersimpan dalam models berita
            "dataTender" => tender::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetenderRequest  $request
     * @param  \App\Models\tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tender $tender)
    {
        $validatedData = $request->validate([
            'judul_tender' => 'required|max:100',
            'jadwal_tender_dimulai' => 'required|date',
            'jadwal_tender_berakhir' => 'required|date',
            'anggaran_dana' => 'required',
            'gambar_tender' => 'required|string',
        ]);
        // dd($request->all());
        tender::where('id', $tender->id)->update($validatedData);
        return redirect('/kelolaTender')->with('success', 'Edit Tender Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tender $tender)
    {
        // Hapus tender jika ditemukan
        if ($tender) {
            $tender->delete();
            return redirect('/kelolaTender')->with('success', 'Tender berhasil dihapus.');
        } else {
            return redirect('/kelolaTender')->with('error', 'Tender tidak ditemukan.');
        }
    }

    public function showPengajuanForm(Tender $tender)
    {
        return view('pengajuanTender', [
            'title' => 'Pengajuan Proposal',
            'tender' => $tender,
        ]);
    }

    public function storeProposal(Request $request, pengaju_proposal_tender $tender)
    {
        // Validasi data yang dikirimkan melalui form
        // dd($request->all());
        $request->validate([
            'nama' => 'required',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan tipe file gambar yang diizinkan
            'file_proposal' => 'required|file|mimes:pdf,docx', // Sesuaikan dengan tipe file dokumen yang diizinkan
            'link_vidio' => 'required|url',
            'foto_pengaju' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan tipe file gambar yang diizinkan
        ]);
    
        // Handle file foto_ktp
        $fotoKtpPath = $request->file('foto_ktp')->store('public/tender_files');
        
        // Handle file file_proposal
        $fileProposalPath = $request->file('file_proposal')->store('public/tender_files');
    
        // Handle file foto_pengaju
        $fotoPengajuPath = $request->file('foto_pengaju')->store('public/tender_files');

        // Handle id user
        $userId = Auth::id();
    
        // Simpan data pengajuan tender ke dalam database
        $request->merge(['id_tender' => $request->get('id_tender',1)]);
        $request->merge(['id_user' => $request->get('id_user',$userId)]);
        pengaju_proposal_tender::create($request->all());

        // $pengajuanTender = pengaju_proposal_tender::create([
        //     'id_tender' => $request->tender_id,
        //     'id_user' => $userId,
        //     'nama' => $request->nama,
        //     'foto_ktp' => $fotoKtpPath,
        //     'file_proposal' => $fileProposalPath,
        //     'link_vidio' => $request->link_vidio,
        //     'foto_pengaju' => $fotoPengajuPath,
        // ]);
    
        // Redirect dengan pesan sukses
        return redirect('/tender')->with('success', 'Pengajuan Tender berhasil disimpan.');
    }

}
