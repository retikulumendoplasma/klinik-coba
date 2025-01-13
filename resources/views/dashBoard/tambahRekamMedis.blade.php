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
                    <label for="mr">Nomor Rekam Medis</label>
                    <input type="text" class="form-control" id="mr" name='mr' required value="{{ $newMr }}" >
                </div>

                <div class="form-group pb-3">
                    <label for="pasien">Nama Pasien</label>
                    <select class="form-select" id="pasien" name="id_pasien" style="width: 100%;">
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
                                id: item.id_pasien,
                                text: item.nama
                            };
                        })
                    };
                },
                cache: true
            }
        });
    });
</script>
@endsection
