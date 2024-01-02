<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadProposalController extends Controller
{
    public function store(Request $request, Tender $tender)
{
    // Validasi data yang dikirimkan melalui form
    dd($request->all());
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

    // Simpan data pengajuan tender ke dalam database
    $tender->pengajuanTender()->create([
        'nama' => $request->nama,
        'foto_ktp' => $fotoKtpPath,
        'file_proposal' => $fileProposalPath,
        'link_vidio' => $request->link_vidio,
        'foto_pengaju' => $fotoPengajuPath,
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('tender.show', $tender->id)->with('success', 'Pengajuan Tender berhasil disimpan.');
}

}
