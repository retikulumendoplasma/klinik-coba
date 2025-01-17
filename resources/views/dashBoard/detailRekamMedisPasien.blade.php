@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="text-center mb-4">
                <h1 class="fw-bold">Rekam Medis</h1>
            </div>

            <!-- Informasi Pasien -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Informasi Pasien</h5>
                    <div class="form-group pb-3">
                        <label for="tanggal_berobat" class="fw-semibold">Tanggal Berobat</label>
                        <input type="text" class="form-control" id="tanggal_berobat" name="tanggal_berobat" value="{{ \Carbon\Carbon::parse($rekamMedis->tanggal_berobat)->translatedFormat('l d - F - Y') }}" disabled readonly>
                    </div>
                    <div class="form-group pb-3">
                        <label for="nama" class="fw-semibold">Nama Pasien</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $rekamMedis->patients->nama }}" disabled readonly>
                    </div>
                    <div class="form-group pb-3">
                        <label for="usia" class="fw-semibold">Usia Pasien</label>
                        <input type="text" class="form-control" id="usia" name="usia" value="{{ \Carbon\Carbon::parse($rekamMedis->patients->tanggal_lahir)->age }} Tahun" disabled readonly>
                    </div>
                    <div class="form-group">
                        <label for="namadokter" class="fw-semibold">Dokter</label>
                        <input type="text" class="form-control" id="namadokter" name="namadokter" value="{{ $rekamMedis->medical_staff->nama }}" disabled readonly>
                    </div>
                </div>
            </div>

            <!-- Detail Rekam Medis -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Detail Rekam Medis</h5>
                    
                    <!-- Keluhan -->
                    <div class="mb-3">
                        <h6 class="fw-semibold">Keluhan</h6>
                        <p class="text-muted">{!! nl2br(e($rekamMedis->keluhan)) !!}</p>
                        <hr class="my-3">
                    </div>

                    <!-- Diagnosa -->
                    <div class="mb-3">
                        <h6 class="fw-semibold">Diagnosa</h6>
                        <p class="text-muted">{!! nl2br(e($rekamMedis->diagnosa)) !!}</p>
                        <hr class="my-3">
                    </div>

                    <!-- Terapi -->
                    <div class="mb-3">
                        <h6 class="fw-semibold">Terapi</h6>
                        <p class="text-muted">{!! nl2br(e($rekamMedis->terapi)) !!}</p>
                        <hr class="my-3">
                    </div>

                    <!-- Catatan Dokter -->
                    <div>
                        <h6 class="fw-semibold">Catatan Dokter</h6>
                        <p class="text-muted">{!! nl2br(e($rekamMedis->catatan_dokter)) !!}</p>
                    </div>
                </div>
            </div>

            <!-- Tombol Kembali -->
            <div class="text-center">
                <a href="/rekamMedisPasien/{{ $rekamMedis->nomor_rekam_medis }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
