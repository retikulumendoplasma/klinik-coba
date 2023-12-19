@extends('layouts.main')

@section('main')
<div class="container">
    <h1 class="text-center pb-2">Surat Keterangan Domisili</h1>
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                <select id="namaSelector" name="nama" class="form-select" aria-label="Default select example">
                    <option value="">Nama</option>
                    @foreach ($penduduk as $nik)
                        <option value="{{ $nik->nik }}">{{ $nik->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">NIK</label>
                <input class="form-control" type="text" id="nikInput" name="nik" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tempat, tgl lahir</label>
                <input class="form-control" type="text" id="tempat_tanggal_lahirInput" name="tempat_tanggal_lahir" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Jenis kelamin</label>
                <input class="form-control" type="text" id="jenis_kelaminInput" name="jenis_kelamin" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload foto KTP</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload foto KK</label>
                <input class="form-control" type="file" id="formFile">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Status perkawinan</label>
                <input class="form-control" type="text" id="status_perkawinanInput" name="status_perkawinan" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Agama</label>
                <input class="form-control" type="text" id="agamaInput" name="agama" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pekerjaan</label>
                <input class="form-control" type="text" id="pekerjaanInput" name="pekerjaan" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                <input class="form-control" type="text" id="alamatInput" name="alamat" aria-label="Disabled input example" disabled readonly>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#namaSelector').on('change', function () {
                var penduduk = $(this).val();

                // Ajax request mendapatkan data penduduk
                $.ajax({
                    url: '/getPendudukData/' + penduduk,
                    type: 'GET',
                    success: function (response) {
                        // untuk auto input kedalam teks input (input text)
                        $('#nikInput').val(response.nik);
                        var tempatTanggalLahir = response.tempat_lahir + ', ' + response.tanggal_lahir;
                        $('#tempat_tanggal_lahirInput').val(tempatTanggalLahir);
                        $('#jenis_kelaminInput').val(response.jenis_kelamin);
                        $('#status_perkawinanInput').val(response.status_perkawinan);
                        $('#agamaInput').val(response.agama);
                        $('#pekerjaanInput').val(response.pekerjaan);
                        $('#alamatInput').val(response.alamat);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
    <button type="button" class="position end-0 m-2 btn btn-dark">Ajukan</button>
</div>

@endsection