@extends('dashBoard.dashboard')

@section('container')
    <h2 class="text-center">Detail Aparatur</h2>

    <div class="container text-center pb-5 border border-dark my-5">
        <img src="{{ asset('storage/' . $aparatur->foto) }}" alt="Your Image" style="max-width: 100%; max-height: 300px;">
        <h2 class="head-text">{{ $aparatur->nip_nipd }}</h2>
        <h3 class="head-text">{{ $aparatur->nama }}</h3>
        <p>Jabatan: {{ $aparatur->jabatan }}</p>
        <p>Tempat {{ $aparatur->tempat_lahir }}, Tanggal lahir: {{ $aparatur->tanggal_lahir }}</p>
        <p>Nomor Wa: {{ $aparatur->no_wa }}</p>
        <a href="/kelolaProfilDesa" class="badge btn-success mt-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
            </svg>
             Kembali
        </a>
    </div>   
    
@endsection

