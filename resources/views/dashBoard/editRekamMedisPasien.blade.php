@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="text-center mb-4">
                <h1 class="fw-bold">Edit Rekam Medis Pasien</h1>
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
            
        <form action="/editRekamMedis/{{ $rekamMedis->id_rekam_medis }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf

            <input type="hidden" name="tanggal_berobat" value="{{ $rekamMedis->tanggal_berobat }}">
            <input type="hidden" name="id_dokter" value="{{ $rekamMedis->id_dokter }}">

            <!-- Detail Rekam Medis -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Detail Rekam Medis</h5>
                    
                <!-- Subjective -->
                <div class="form-group pb-3">
                    <label for="subjective"><b>Subjective :</b> </label>
                    <textarea id="subjective" name="subjective" rows="4" class="form-control @error('subjective') is-invalid @enderror">{{ old('subjective', $rekamMedis->subjective) }}</textarea>
                    @error('subjective')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Objective -->
                <div class="form-group pb-3">
                    <label for="objective"><b>Objective :</b> </label>
                    <textarea id="objective" name="objective" rows="4" class="form-control @error('objective') is-invalid @enderror">{{ old('objective', $rekamMedis->objective) }}</textarea>
                    @error('objective')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Assessment -->
                <div class="form-group pb-3">
                    <label for="assesment"><b>Assessment :</b> </label>
                    <textarea id="assesment" name="assesment" rows="4" class="form-control @error('assesment') is-invalid @enderror">{{ old('assesment', $rekamMedis->assesment) }}</textarea>
                    @error('assesment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Planning -->
                <div class="form-group pb-3">
                    <label for="planning"><b>Planning :</b> </label>
                    <textarea id="planning" name="planning" rows="4" class="form-control @error('planning') is-invalid @enderror">{{ old('planning', $rekamMedis->planning) }}</textarea>
                    @error('planning')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                </div>
            </div>
            <button type="submit" class="btn btn-success text-white btn-block mb-3">Edit Data Rekam Medis</button>
        </form>

        </div>
    </div>
</div>
@endsection
