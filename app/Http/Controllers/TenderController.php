<?php

namespace App\Http\Controllers;

use App\Models\tender;
use App\Models\voting_tender;
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
        $totalPengaju = pengaju_proposal_tender::where('status_pengajuan', 'diterima')->count();
        return view('tenderVote', [
            'totalPengaju' => $totalPengaju,
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
        $request->merge(['id_user' => $request->get('id_user',$userId)]);
        pengaju_proposal_tender::create($request->all());

    
        // Redirect dengan pesan sukses
        return redirect('/tender')->with('success', 'Pengajuan Tender berhasil disimpan.');
    }

    public function proposal(pengaju_proposal_tender $pengaju, tender $tender)
    {
        $pengajuProposal = pengaju_proposal_tender::where('id_tender', $tender->id)->get();

        return view('dashBoard.kelolaPengajuProposal', [
            "title" => "Proposal Tender",
            'pengaju' => $pengaju,
            'pengajuProposal' => $pengajuProposal
        ]);
    }

    public function approveProposal($id)
    {
        // Temukan proposal berdasarkan ID
        $proposal = pengaju_proposal_tender::find($id);

        // Ubah status_pengajuan menjadi 'diterima'
        $proposal->status_pengajuan = 'diterima';
        $proposal->save();

        // Redirect atau kembali ke halaman yang diinginkan
        return redirect()->back()->with('success', 'Proposal berhasil disetujui');
    }

    //menampilkan jumlah pengaju pada tampilan user
    

    public function voting()
    {
        $pengajuDiterima = pengaju_proposal_tender::where('status_pengajuan', 'diterima')->get();
        return view('voting', ["title" => "Proposal Tender", 'pengajuDiterima' => $pengajuDiterima]);
    }

    public function vote($id)
    {
        $pengaju = pengaju_proposal_tender::findOrFail($id);

        // Cek apakah user sudah melakukan vote sebelumnya
        $userHasVoted = voting_tender::where([
            'id_user' => Auth::id(),
            'id_pengaju_proposal' => $pengaju->id,
        ])->exists();

        if (!$userHasVoted) {
            // Jika belum vote, simpan vote
            voting_tender::create([
                'id_user' => Auth::id(),
                'id_pengaju_proposal' => $pengaju->id,
                'id_tender' => $pengaju->id_tender, // Sesuaikan dengan kolom yang menyimpan ID tender pada tabel pengaju_proposal_tender
                'tanggal_vote' => now(),
            ]);

            // Update jumlah_vote pada tabel pengaju_proposal_tender
            $pengaju->increment('jumlah_vote');

            return redirect()->back()->with('success', 'Vote berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Anda sudah melakukan vote untuk pengaju ini sebelumnya.');
        }
    }
}
