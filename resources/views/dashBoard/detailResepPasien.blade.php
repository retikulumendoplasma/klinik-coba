@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Detail Resep</h1>
            </div>

            <!-- Informasi Rekam Medis -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Informasi Rekam Medis</h5>
                    <div class="form-group pb-3">
                        <label for="tanggal_berobat" class="fw-semibold">Tanggal Berobat</label>
                        <input type="text" class="form-control" id="tanggal_berobat" name="tanggal_berobat" value="{{ \Carbon\Carbon::parse($resep->medical_reports->tanggal_berobat)->translatedFormat('l d - F - Y') }}" disabled readonly>
                    </div>
                    <div class="form-group pb-3">
                        <label for="nama" class="fw-semibold">Nama Pasien</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $resep->medical_reports->patients->nama }}" disabled readonly>
                    </div>
                    <div class="form-group pb-3">
                        <label for="usia" class="fw-semibold">Usia Pasien</label>
                        <input type="text" class="form-control" id="usia" name="usia" value="{{ \Carbon\Carbon::parse($resep->medical_reports->patients->tanggal_lahir)->age }} Tahun" disabled readonly>
                    </div>
                    <div class="form-group">
                        <label for="namadokter" class="fw-semibold">Dokter</label>
                        <input type="text" class="form-control" id="namadokter" name="namadokter" value="{{ $resep->medical_reports->medical_staff->nama }}" disabled readonly>
                    </div>
                </div>
            </div>

            <!-- Detail Rekam Medis -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Detail Rekam Medis</h5>
                    <div class="mb-3">
                        <h6 class="fw-semibold">Keluhan</h6>
                        <p class="text-muted">{!! nl2br(e($resep->medical_reports->keluhan)) !!}</p>
                        <hr class="my-3">
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-semibold">Diagnosa</h6>
                        <p class="text-muted">{!! nl2br(e($resep->medical_reports->diagnosa)) !!}</p>
                        <hr class="my-3">
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-semibold">Terapi</h6>
                        <p class="text-muted">{!! nl2br(e($resep->medical_reports->terapi)) !!}</p>
                        <hr class="my-3">
                    </div>
                    <div>
                        <h6 class="fw-semibold">Catatan Dokter</h6>
                        <p class="text-muted">{!! nl2br(e($resep->medical_reports->catatan_dokter)) !!}</p>
                    </div>
                </div>
            </div>

            <!-- Detail Resep Obat -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Detail Resep</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataResep as $resepObat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $resepObat->medicines->nama_obat }}</td>
                                <td>{{ $resepObat->jumlah }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
