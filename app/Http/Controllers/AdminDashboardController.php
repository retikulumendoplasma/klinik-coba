<?php

namespace App\Http\Controllers;

use App\Models\pengaju_surat;
use App\Models\pengaju_proposal_tender;
use App\Models\saran_dan_masukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminDashboardController extends Controller
{
    public function adminhome()
    {
        // $suratmasuk = pengaju_surat::where('status_surat', 'Pending')->count();
        // $proposalmasuk = pengaju_proposal_tender::where('status_pengajuan', 'Pending')->count();
        // $saranmasukan = saran_dan_masukan::whereNull('isi_balasan')->count();
        return view('dashBoard.beranda', [
            "title" => "Dashboard Admin",
            // "suratmasuk" => $suratmasuk,
            // "proposalmasuk" => $proposalmasuk,
            // "saranmasukan" => $saranmasukan,
        ]);
    }

}
