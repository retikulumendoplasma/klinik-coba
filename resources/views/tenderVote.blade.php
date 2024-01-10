@extends('layouts.main')

@section('main')

<div class="container pb-5">
    <h2 class="head-text">Program Pembangunan Desa</h2>
    <div class="row m-5">
        @foreach ($dataTender as $Tender)
        <div class="col-md-4 pb-3">
            <div class="card h-100">
                <img src="{{ asset('storage/' . $Tender->gambar_tender) }}" alt="Foto Pendukung" style="max-width: 100%; max-height: 350px;">
                <div class="card-body">
                    <h5 class="card-title">{{ $Tender->judul_tender }}</h5>
                    <p class="card-text">Waktu mulai: {{ $Tender->jadwal_tender_dimulai }}</p>
                    <p class="card-text">Waktu selesai: {{ $Tender->jadwal_tender_berakhir }}</p>
                    <p class="card-text">Anggaran tersedia: {{ $Tender->anggaran_dana }}</p>
                </div>
                <a href="/voting/{{ $Tender->id }}" class="btn btn-success">Lihat Pengajuan</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
    
@endsection