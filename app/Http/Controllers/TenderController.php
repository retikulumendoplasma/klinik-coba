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
        return view('tenderVote', [
            "title" => "Tender Vote",
            // 'pengajuProposal' => $pengajuProposal,
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

    public function viewT(tender $tender)
    {
        return view('/dashboard.viewTender', [
            //pengisian berita
            "title" => "Detail Tender",
            //data berita sudah tersimpan dalam models berita
            "dataTender" => $tender
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
        $validatedData = $request->validate([
            'judul_tender' => 'required|max:100',
            'detail' => 'required',
            'jadwal_tender_dimulai' => 'required|date',
            'jadwal_tender_berakhir' => 'required|date',
            'anggaran_dana' => 'required',
            'gambar_tender' => 'image|file',
        ]);
        $validatedData['gambar_tender'] = $request->file('gambar_tender')->store('gambar_tender');
        // dd($request->all());
        tender::create($validatedData);


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
            'detail' => 'required',
            'jadwal_tender_dimulai' => 'required|date',
            'jadwal_tender_berakhir' => 'required|date',
            'anggaran_dana' => 'required',
            'gambar_tender' => 'required|string',
        ]);
        // dd($request->all());
        $validatedData['gambar_tender'] = $request->file('gambar_tender')->store('gambar_tender');
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

    public function storeProposal(Request $request)
    {
        // Validasi data yang dikirimkan melalui form
        // dd($request->all());
        $validatedData = $request->validate([
            'nama' => 'required',
            'id_tender' => 'required',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan tipe file gambar yang diizinkan
            'file_proposal' => 'required|file|mimes:pdf,docx', // Sesuaikan dengan tipe file dokumen yang diizinkan
            'link_vidio' => 'nullable|url',
            'foto_pengaju' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan tipe file gambar yang diizinkan
        ]);
    
        // Handle file foto_ktp
        $validatedData['foto_ktp'] = $request->file('foto_ktp')->store('tender-foto_ktp');
        
        // Handle file file_proposal
        $validatedData['file_proposal'] = $request->file('file_proposal')->store('tender-files');
    
        // Handle file foto_pengaju
        $validatedData['foto_pengaju'] =  $request->file('foto_pengaju')->store('tender-foto_pengaju');




        // Handle id user
        $userId = Auth::id();
        $validatedData['id_user'] = $userId;
        // Simpan data pengajuan tender ke dalam database
        $pengaju = pengaju_proposal_tender::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect('berhasilurusproposal/' . $pengaju->id)->with('success', 'Pengajuan Tender berhasil disimpan.');
    }

    public function berhasil($pengaju)
    {
        $dataProposal = pengaju_proposal_tender::find($pengaju);
        return view('berhasilurusproposal', [
            "title" => "Berhasil",
            //data surat sudah tersimpan dalam models surat
            "dataProposal" => $dataProposal

        ]);
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

    public function tolakProposal($id)
    {
            // Temukan proposal berdasarkan $id dan lakukan tindakan penolakan
        $proposal = pengaju_proposal_tender::find($id);

        // Lakukan validasi apakah proposal ditemukan atau tidak
        if (!$proposal) {
            // Proposal tidak ditemukan, mungkin hendak melakukan redirect atau memberikan pesan error
            return redirect()->back()->with('error', 'Proposal not found.');
        }

        // Lakukan tindakan penolakan disini
        $proposal->delete(); // Atau lakukan tindakan penolakan sesuai kebutuhan

        // Redirect atau berikan pesan sukses
        return redirect()->back()->with('success', 'Proposal berhasil ditolak.');
    }

    //menampilkan jumlah pengaju pada tampilan user
    public function voting(pengaju_proposal_tender $pengaju, tender $tender)
    {
        $pengajuProposal = pengaju_proposal_tender::where('id_tender', $tender->id)->get();
        return view('voting', [
            "title" => "Voting Tender",
            'pengaju' => $pengaju,
            'tender' => $tender,
            'pengajuProposal' => $pengajuProposal,
        ]);
    }

    public function pilih(Request $request, $id)
    {
       
        $userId = Auth::id();
    
        // Simpan data pengajuan tender ke dalam database
        $request->merge(['user_id' => $request->get('user_id',$userId)]);
        $request->merge(['tanggal_vote' => $request->get('tanggal_vote', now())]);
        
        voting_tender::create($request->all());
        return redirect('/tenderVote')->with('success', 'Memilih');
    }

    public function batalVoting($id)
    {
        $voting = voting_tender::find($id);

        if (!$voting) {
            // Handle jika voting tidak ditemukan
            return redirect()->back()->with('error', 'Voting tidak ditemukan.');
        }

        $voting->delete();

        // Handle jika penghapusan voting berhasil
        return redirect()->back()->with('success', 'Pilihan berhasil dibatalkan.');
    }

    public function viewProposal($pengaju)
    {
        $dataProposal = pengaju_proposal_tender::find($pengaju);
        $dataVote = voting_tender::where('proposal_id', $pengaju)->get();
        $namayangngevote = [];
        $namatender = [];
        foreach ($dataVote as $vote) {
            $namayangngevote[] = $vote->penduduk->nama;
            $namatender[] = $vote->tender->judul_tender;
        }
        return view('/dashboard.viewProposal', [
            "title" => "Detail Proposal",
            "dataVote" => $dataVote,
            "dataProposal" => $dataProposal,
            "namayangngevote" => $namayangngevote,
            "namatender" => $namatender,
        ]);
    }

    public function statusPengajuan(pengaju_proposal_tender $pengaju)
    {
        return view('pengajuanProposalTender', [
            "title" => "Pengajuan proposal tender",
            //data surat sudah tersimpan dalam models surat
            "pengaju" => $pengaju
        ]);
    }
}
