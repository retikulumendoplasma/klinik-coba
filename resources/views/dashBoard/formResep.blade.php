@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Tambah Rekam Medis</h1>
            </div>

            <!-- Informasi Rekam Medis -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Informasi Rekam Medis</h5>

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

              <!-- Form Tambah Resep -->
              <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Tambah Resep</h5>
                    <form action="{{ route('storeResep') }}" method="POST" id="formResep">
                        @csrf
                        <input type="hidden" name="id_rekam_medis" value="{{ $rekamMedis->id_rekam_medis }}">
                    
                        <!-- Select2 untuk mencari obat -->
                        <div class="form-group">
                            <label for="obat" class="fw-semibold">Cari Obat</label>
                            <select id="obat" class="form-control" name="obat[]" multiple="multiple" style="width: 100%;">
                                <!-- Select2 akan memuat opsi obat melalui AJAX -->
                            </select>
                        </div>

                        <!-- Error jika tidak ada obat yang dipilih -->
                        @error('obat')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    
                        <!-- Daftar obat yang dipilih dengan jumlah -->
                        <div id="selected-obat" class="mt-4">
                            <!-- Area untuk menampilkan obat yang dipilih dengan jumlah -->
                        </div>
                    
                        <button type="submit" class="btn btn-primary mt-3" id="submitResep">Simpan Resep</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script>
    $(document).ready(function () {
        // Inisialisasi Select2 untuk mencari obat
        $('#obat').select2({
            placeholder: "Cari Obat...",
            ajax: {
                url: "{{ route('searchObat') }}", // Endpoint pencarian obat
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // Query pencarian
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(function (item) {
                            return {
                                id: item.id_obat,
                                text: item.nama_obat
                            };
                        })
                    };
                },
                cache: true
            }
        });

        // Event listener untuk menambahkan obat yang dipilih
        $('#obat').on('select2:select', function (e) {
            const selectedData = e.params.data;

            // Tambahkan obat ke daftar hanya jika belum ada
            if ($('#selected-obat').find(`[data-id="${selectedData.id}"]`).length === 0) {
                $('#selected-obat').append(`
                    <div class="d-flex align-items-center mb-3" data-id="${selectedData.id}">
                        <input type="hidden" name="obat[]" value="${selectedData.id}">
                        <div style="flex-grow: 1;">${selectedData.text}</div>
                        <input type="number" class="form-control" name="jumlah[${selectedData.id}]" placeholder="Jumlah" min="1" style="width: 80px;" required>
                        <button type="button" class="btn btn-danger ms-2 btn-remove">Hapus</button>
                    </div>
                `);
            }
        });

        // Event listener untuk menghapus obat dari daftar
        $('#selected-obat').on('click', '.btn-remove', function () {
            $(this).parent().remove();
        });

        // Validasi sebelum submit
        $('#formResep').on('submit', function (e) {
            if ($('#selected-obat').children().length === 0) {
                e.preventDefault();
                alert('Pilih minimal satu obat untuk disimpan.');
            }
        });
    });
</script>
@endsection