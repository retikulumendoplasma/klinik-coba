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
    </div>   
@endsection

