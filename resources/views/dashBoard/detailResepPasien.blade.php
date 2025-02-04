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
                        <h6 class="fw-semibold">Subjective</h6>
                        <p class="text-muted">{!! nl2br(e($resep->medical_reports->subjective)) !!}</p>
                        <hr class="my-3">
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-semibold">Objective</h6>
                        <p class="text-muted">{!! nl2br(e($resep->medical_reports->objective)) !!}</p>
                        <hr class="my-3">
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-semibold">Assesment</h6>
                        <p class="text-muted">{!! nl2br(e($resep->medical_reports->assesment)) !!}</p>
                        <hr class="my-3">
                    </div>
                    <div>
                        <h6 class="fw-semibold">Planning</h6>
                        <p class="text-muted">{!! nl2br(e($resep->medical_reports->planning)) !!}</p>
                    </div>
                </div>
            </div>

            <!-- Detail Resep Obat -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Detail Resep</h5>
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Satuan</th>
                                <th>Jumlah</th>
                                <th>Cara Minum</th>
                                <th>Cara Pemberian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataResep as $resepObat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $resepObat->medicines->nama_obat }}</td>
                                    <td>{{ $resepObat->satuan }}</td>
                                    <td>{{ $resepObat->jumlah }}</td>
                                    <td>{{ $resepObat->cara_minum }}</td>
                                    <td>{{ $resepObat->cara_pakai }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="/resep" class="badge btn-primary" style="text-decoration: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
