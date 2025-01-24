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
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotal = 0; @endphp <!-- Variabel untuk menghitung total -->
                            @foreach ($dataResep as $resepObat)
                                @php
                                    $totalHarga = $resepObat->medicines->harga_jual * $resepObat->jumlah;
                                    $grandTotal += $totalHarga;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $resepObat->medicines->nama_obat }}</td>
                                    <td>{{ $resepObat->jumlah }}</td>
                                    <td>Rp{{ number_format($resepObat->medicines->harga_jual, 0, ',', '.') }}</td>
                                    <td>Rp{{ number_format($totalHarga, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Grand Total</th>
                                <th>Rp{{ number_format($grandTotal, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                    
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
