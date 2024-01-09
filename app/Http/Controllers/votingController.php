<?php

namespace App\Http\Controllers;

use App\Models\voting_tender;
use Illuminate\Http\Request;

class votingController extends Controller
{
    public function store(Request $request, $id)
{
    // Validasi request jika diperlukan

    // Pastikan bahwa user yang melakukan vote adalah user yang seharusnya
    $user = auth()->user();

    // Tambahkan data voting ke dalam tabel voting_tender
    voting_tender::create([
        'id_tender' => $id,
        'id_pengaju_proposal' => $user->id, // Ganti dengan sesuai field yang sesuai di tabel user
        'id_user' => $user->id,
    ]);

    return redirect()->back()->with('success', 'Vote berhasil.');
}
}
