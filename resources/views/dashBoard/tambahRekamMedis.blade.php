@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Tambah Rekam Medis </h1>
            </div>
            <form action="/tambahRekamMedis" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group pb-3">
                    <label for="nomor_rekam_medis">Nomor Rekam Medis</label>
                    <input type="text" class="form-control" id="nomor_rekam_medis" name="nomor_rekam_medis" readonly>
                </div>

                <div class="form-group pb-3">
                    <label for="pasien">Nama Pasien</label>
                    <select class="form-select" id="pasien" name="nomor_rekam_medis" style="width: 100%;">
                        <option value="">Pilih Pasien</option>
                    </select>
                </div>

                <div class="form-group pb-3">
                    <label for="dokter">Nama Dokter</label>
                    <select class="form-select" name='id_dokter' aria-label="Default select example">
                        @foreach ($dokter as $d)
                            <option value="{{ $d->id_dokter }}">{{ $d->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group pb-3">
                    <label for="keluhan">Keluhan</label>
                    <input type="text" class="form-control" id="keluhan" name='keluhan' required placeholder="Silahkan Masukkan Keluhan" >
                </div>
                <div class="form-group pb-3">
                    <label for="diagnosa">Diagnosa</label>
                    <input type="text" class="form-control" id="diagnosa" name='diagnosa' required placeholder="Silahkan Masukkan Diagnosa" >
                </div>
                <div class="form-group pb-3">
                    <label for="terapi">Terapi</label>
                    <input type="text" class="form-control"  id="terapi" name='terapi' required placeholder="Silahkan Masukkan Terapi" >
                </div>
                <div class="form-group pb-3">
                    <label for="catatan_dokter">Catatan Dokter</label>
                    <input type="text" class="form-control"  id="catatan_dokter" name='catatan_dokter' required placeholder="Silahkan Masukkan catatan dokter" >
                </div>
                <button type="submit" class="btn btn-success text-white btn-block mb-3">Tambah Rekam Medis</button>
            </form>
        </div>
    </div>
</div>

<!-- Include jQuery (pastikan dimuat sebelum Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script>
    $(document).ready(function() {
        // Inisialisasi Select2 untuk input pasien
        $('#pasien').select2({
            placeholder: "Cari Pasien...",
            allowClear: true,
            ajax: {
                url: "{{ route('searchPasien') }}", // Endpoint pencarian
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
                                id: item.nomor_rekam_medis, // Gunakan nomor_rekam_medis sebagai ID
                                text: item.nama // Tampilkan nama pasien
                            };
                        })
                    };
                },
                cache: true
            }
        });

        // Event listener untuk mengisi nomor rekam medis
        $('#pasien').on('select2:select', function(e) {
            var selectedData = e.params.data;
            $('#nomor_rekam_medis').val(selectedData.id); // Isi input dengan nomor rekam medis
        });

        // Event listener untuk mengosongkan nomor rekam medis jika pilihan dihapus
        $('#pasien').on('select2:clear', function() {
            $('#nomor_rekam_medis').val('');
        });
    });
</script>

@endsection
