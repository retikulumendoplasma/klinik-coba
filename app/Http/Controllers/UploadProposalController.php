<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengaju_proposal_tender;
use Illuminate\Validation\Rule;

class UploadProposalController extends Controller
{
    public function tampil()
    {
        return view('dashboard.kelolaPengajuProposal', [
            //pengisian berita
            "title" => "Pengaju Proposal",
            //data berita sudah tersimpan dalam models berita
            "pengajuProposal" => pengaju_proposal_tender::all()
        ]);
    }

}
