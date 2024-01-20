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
                    <p class="card-text">Anggaran tersedia: {{ number_format($Tender->anggaran_dana, 0, ',', '.') }}</p>
                </div>
                @if (now()->isBefore(\Carbon\Carbon::parse($Tender->jadwal_tender_dimulai)))
                    <p class="text-danger text-center">Tender belum dimulai</p>
                @else
                    @if (now()->isAfter(\Carbon\Carbon::parse($Tender->jadwal_tender_berakhir)->addDay()))
                        <p class="text-danger text-center">Pengajuan proposal telah berakhir</p>
                    @else
                        <a href="{{ route('pengajuanTender', ['tender' => $Tender->id]) }}" class="btn btn-success">Ajukan</a>
                    @endif
                @endif
                
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection