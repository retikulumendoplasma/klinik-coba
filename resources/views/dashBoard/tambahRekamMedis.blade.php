@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Tambah Rekam Medis </h1>
            </div>
            <form action="{{ route('tambahRekamMedis') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <!-- Nomor Rekam Medis -->
                        <div class="form-group pb-3">
                            <label for="nomor_rekam_medis">Nomor Rekam Medis</label>
                            <input type="text" class="form-control @error('nomor_rekam_medis') is-invalid @enderror" 
                                id="nomor_rekam_medis" name="nomor_rekam_medis" value="{{ old('nomor_rekam_medis') }}" readonly>
                            @error('nomor_rekam_medis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pilihan Pasien -->
                        <div class="form-group pb-3">
                            <label for="pasien">Nama Pasien</label>
                            <select class="form-select @error('nomor_rekam_medis') is-invalid @enderror" 
                                id="pasien" name="nomor_rekam_medis" style="width: 100%;">
                                <option value="">Pilih Pasien</option>
                            </select>
                            @error('nomor_rekam_medis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pilihan Dokter -->
                        <div class="form-group pb-3">
                            <label for="dokter">Nama Dokter</label>
                            <select class="form-select @error('id_dokter') is-invalid @enderror" 
                                name="id_dokter" aria-label="Default select example">
                                <option value="">Pilih Dokter</option>
                                @foreach ($dokter as $d)
                                    <option value="{{ $d->id_dokter }}" 
                                        {{ old('id_dokter') == $d->id_dokter ? 'selected' : '' }}>
                                        {{ $d->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_dokter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card-body">
                            <!-- Card untuk Subjective -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <strong>Subjective</strong>
                                </div>
                                <div class="card-body">
                                    <textarea placeholder="Subjektif / keluhan pasien" id="keluhan" name="keluhan" rows="4" class="form-control @error('keluhan') is-invalid @enderror">{{ old('keluhan') }}</textarea>
                                    @error('keluhan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                    
                            <!-- Card untuk Objective -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <strong>Objective</strong>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="berat_badan">Berat Badan (kg):</label>
                                        <input type="number" step="0.1" id="berat_badan" name="berat_badan" placeholder="Masukkan berat badan" class="form-control @error('berat_badan') is-invalid @enderror" value="{{ old('berat_badan') }}">
                                        @error('berat_badan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tinggi_badan">Tinggi Badan (cm):</label>
                                        <input type="number" id="tinggi_badan" name="tinggi_badan" placeholder="Masukkan tinggi badan" class="form-control @error('tinggi_badan') is-invalid @enderror" value="{{ old('tinggi_badan') }}">
                                        @error('tinggi_badan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tensi">Tensi (mmHg):</label>
                                        <input type="text" id="tensi" name="tensi" placeholder="Masukkan tekanan darah (contoh: 120/80)" class="form-control @error('tensi') is-invalid @enderror" value="{{ old('tensi') }}">
                                        @error('tensi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="suhu">Suhu Tubuh (°C):</label>
                                        <input type="number" step="0.1" id="suhu" name="suhu" placeholder="Masukkan suhu tubuh" class="form-control @error('suhu') is-invalid @enderror" value="{{ old('suhu') }}">
                                        @error('suhu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                    
                            <!-- Card untuk Assessment -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <strong>Assessment</strong>
                                </div>
                                <div class="card-body">
                                    <textarea id="assesment" name="assesment" rows="4" class="form-control @error('assesment') is-invalid @enderror">{{ old('assesment') }}</textarea>
                                    @error('assesment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                    
                            <!-- Card untuk Plan -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <strong>Plan</strong>
                                </div>
                                <div class="card-body">
                                    <textarea id="plan" name="plan" rows="4" class="form-control @error('plan') is-invalid @enderror">{{ old('plan') }}</textarea>
                                    @error('plan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Catatan Dokter -->
                        <div class="form-group pb-3">
                            <label for="catatan_dokter">Catatan Dokter :</label>
                            <textarea id="catatan_dokter" name="catatan_dokter" rows="4" class="form-control @error('catatan_dokter') is-invalid @enderror">{{ old('catatan_dokter') }}</textarea>
                            @error('catatan_dokter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <button type="submit" class="btn btn-success text-white btn-block mb-3">Tambah Rekam Medis</button>
            </form>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('#pasien').select2({
            placeholder: "Cari Pasien...",
            allowClear: true,
            ajax: {
                url: "{{ route('searchPasien') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return { q: params.term };
                },
                processResults: function (data) {
                    return {
                        results: data.map(function (item) {
                            return { id: item.nomor_rekam_medis, text: item.nama };
                        })
                    };
                },
                cache: true
            }
        });

        // Isi nomor rekam medis saat pasien dipilih
        $('#pasien').on('select2:select', function(e) {
            $('#nomor_rekam_medis').val(e.params.data.id);
        });

        // Hapus nomor rekam medis saat pasien dihapus
        $('#pasien').on('select2:clear', function() {
            $('#nomor_rekam_medis').val('');
        });
    });
</script>

@endsection
