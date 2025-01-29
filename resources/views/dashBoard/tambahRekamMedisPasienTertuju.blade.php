@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Tambah Rekam Medis {{ $pasien->nama }}</h1>
            </div>
            <form action="{{ route('tambahRekamMedis') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <!-- Nomor Rekam Medis -->
                        <div class="mb-3">
                            <label for="nomor_rekam_medis" class="form-label">Nomor Rekam Medis</label>
                            <input type="text" class="form-control" id="nomor_rekam_medis" name="nomor_rekam_medis" value="{{ $pasien->nomor_rekam_medis ?? '' }}" readonly>
                        </div>

                        <!-- Nama Pasien -->
                        <div class="mb-3">
                            <label for="nama_pasien" class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="{{ $pasien->nama ?? '' }}" readonly>
                        </div>

                        <!-- Nama Dokter -->
                        <div class="mb-3">
                            <label for="id_dokter" class="form-label">Nama Dokter</label>
                            <!-- Menampilkan nama dokter -->
                            <input type="text" class="form-control" id="nama_dokter" value="{{ auth()->user()->medical_staff->nama ?? '' }}" readonly>
                            <!-- Menyimpan ID dokter -->
                            <input type="hidden" id="id_dokter" name="id_dokter" value="{{ auth()->user()->medical_staff->id_dokter ?? '' }}">
                        </div>

                        <!-- Subjective -->
                        <div class="form-group pb-3">
                            <label for="subjective"><b>Subjective :</b> </label>
                            <textarea id="subjective" name="subjective" rows="4" class="form-control @error('subjective') is-invalid @enderror">{{ old('subjective') }}</textarea>
                            @error('subjective')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Objective -->
                        <div class="form-group pb-3">
                            <label for="objective"><b>Objective :</b> </label>
                            <textarea id="objective" name="objective" rows="4" class="form-control @error('objective') is-invalid @enderror">{{ old('objective') }}</textarea>
                            @error('objective')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Assesment -->
                        <div class="form-group pb-3">
                            <label for="assesment"><b>Assesment :</b> </label>
                            <textarea id="assesment" name="assesment" rows="4" class="form-control @error('assesment') is-invalid @enderror">{{ old('assesment') }}</textarea>
                            @error('assesment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Planning -->
                        <div class="form-group pb-3">
                            <label for="planning"><b>Planning :</b> </label>
                            <textarea id="planning" name="planning" rows="4" class="form-control @error('planning') is-invalid @enderror">{{ old('planning') }}</textarea>
                            @error('planning')
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
