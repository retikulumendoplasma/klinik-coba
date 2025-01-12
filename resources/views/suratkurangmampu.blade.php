@extends('layouts.main')

@section('main')
<div class="container">
    <h1 class="text-center pb-2">Surat Keterangan Kurang Mampu</h1>
    <div class="row">
        {{-- pesan bahwa proposal sudah diajukan --}}
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <form id="myForm" action="/ajukansurat" method="post" enctype="multipart/form-data" class="row">
            @csrf
            <div class="col-md-6 col-12">
                <input type="hidden" name="jenis_surat" value="Surat keterangan tidak mampu">
                <input type="hidden" id="nomor_kk" name="nomor_kk" value="">
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="form-label">NIK</label>
                    <select id="namaSelector" name="nik" class="form-select" aria-label="Default select example">
                        <option value="">NIK</option>
                        @foreach ($penduduk as $nik)
                            <option value="{{ $nik->nik }}">{{ $nik->nik }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input class="form-control" type="text" id="namaInput" name="nama" aria-label="Disabled input example" disabled readonly>
                </div>
                <input type="hidden" id="tempat_lahirInput" name="tempat_lahir">
                <input type="hidden" id="tanggal_lahirInput" name="tanggal_lahir">
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tempat, tgl lahir</label>
                    <input class="form-control" type="text" id="tempat_tanggal_lahirInput" aria-label="Disabled input example" disabled readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jenis kelamin</label>
                    <input class="form-control" type="text" id="jenis_kelaminInput" name="jenis_kelamin" aria-label="Disabled input example" disabled readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="formFile" class="form-label">Upload foto KTP</label>
                    <input class="form-control" type="file" id="foto_ktp" name="foto_ktp" accept="image/*">
                    @error('foto_ktp')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-3">
                    <label for="formFile" class="form-label">Upload foto KK</label>
                    <input class="form-control" type="file" id="foto_kk" name="foto_kk" accept="image/*">
                    @error('foto_kk')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>                
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Status perkawinan</label>
                    <input class="form-control" type="text" id="status_perkawinanInput" name="status_perkawinan" aria-label="Disabled input example" disabled readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Agama</label>
                    <input class="form-control" type="text" id="agamaInput" name="agama" aria-label="Disabled input example" disabled readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Pekerjaan</label>
                    <input class="form-control" type="text" id="pekerjaanInput" name="pekerjaan" aria-label="Disabled input example" disabled readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                    <input class="form-control" type="text" id="alamatInput" name="alamat" aria-label="Disabled input example" disabled readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="formFile" class="form-label">Upload foto pendukung</label>
                    <input class="form-control" type="file" id="foto_pendukung" name="foto_pendukung" accept="image/*">
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nomor Hp</label>
                    <input class="form-control" type="number" id="nomor_hp" name="nomor_hp" aria-label="Disabled input example">
                    @error('nomor_hp')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="position end-0 m-2 btn btn-dark">Ajukan</button>
            </div>
        </form>
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
                        $('#namaInput').val(response.nama);
                        var tempatTanggalLahir = response.tempat_lahir + ', ' + response.tanggal_lahir;
                        $('#tempat_tanggal_lahirInput').val(tempatTanggalLahir);
                        $('#tempat_lahirInput').val(response.tempat_lahir);
                        $('#tanggal_lahirInput').val(response.tanggal_lahir);
                        $('#jenis_kelaminInput').val(response.jenis_kelamin);
                        $('#status_perkawinanInput').val(response.status_perkawinan);
                        $('#agamaInput').val(response.agama);
                        $('#pekerjaanInput').val(response.pekerjaan);
                        $('#alamatInput').val(response.alamat);
                        $('#nomor_kk').val(response.nomor_kk);
                        
                        // Update nilai atribut "disabled" menjadi "false"
                        $('#namaInput, #tempat_tanggal_lahirInput, #jenis_kelaminInput, #status_perkawinanInput, #agamaInput, #pekerjaanInput, #alamatInput').prop('disabled', false);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

    <script>
         $(document).ready(function () {
            $('#myForm').on('submit', function () {
                var penduduk = $('#namaSelector').val();

                if (!penduduk) {
                    // Menampilkan pesan kesalahan jika opsi NIK belum dipilih
                    alert('Mohon pilih NIK terlebih dahulu.');
                    return false; // Menahan pengiriman formulir
                }
                // Lanjutkan dengan pengiriman formulir
            });
        });
    </script>
</div>

@endsection