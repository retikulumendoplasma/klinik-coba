@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Tambah Pasien </h1>
            </div>
            <form action="/tambahPasien" method="post">
                @csrf
                <div class="form-group pb-3">
                    <label for="nomor_rekam_medis">Nomor Rekam Medis</label>
                    <input type="text" class="form-control" id="nomor_rekam_medis" name='nomor_rekam_medis' required value="{{ $newMr }}" >
                </div>
                <div class="form-group pb-3">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name='nama' required placeholder="Silahkan Masukkan Nama" >
                </div>
                <div class="form-group pb-3">
                    <label for="Tempat">Tempat Lahir</label>
                    <input type="text" class="form-control"  id="tempat" name='tempat_lahir' required placeholder="Silahkan Masukkan Tempat Lahir" >
                </div>
                <div class="form-group pb-3">
                    <label for="Tanggal">Tanggal Lahir</label>
                    <input type="date" class="form-control"  id="tanggal" name='tanggal_lahir' required placeholder="Silahkan Masukkan Tanggal Lahir" >
                </div>
                <div class="form-group pb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name='jenis_kelamin' aria-label="Default select example">
                        <option value="1">Pria</option>
                        <option value="2">Wanita</option>
                    </select>
                </div>
                {{-- <div class="form-group pb-3">
                    <label for="Agama">Agama</label>
                    <input type="text" class="form-control"  id="agama" name='agama' required placeholder="Agama" >
                </div> --}}
                <div class="form-group pb-3">
                    <label for="Alamat">Alamat</label>
                    <input type="text" class="form-control"  id="alamat" name='alamat' required placeholder="Silahkan Masukkan Alamat" >
                </div>
                <div class="form-group pb-3">
                    <label for="NoHP">No HP</label>
                    <input type="number" class="form-control"  id="phoneInput" name='nomor_hp' maxlength="12" pattern="[0-9]+" placeholder="Silahkan Masukkan No HP" >
                </div>
                <div class="form-group pb-3">
                    <label for="exampleFormControlInput1" class="form-label">Status Perkawinan</label>
                    <select class="form-select" name='status_perkawinan' aria-label="Default select example">
                        <option value="1">Belum Menikah</option>
                        <option value="2">Menikah</option>
                    </select>
                </div>
                <div class="form-group pb-3">
                    <label for="Pekerjaan">Pekerjaan</label>
                    <input type="text" class="form-control"  id="pekerjaan" name='pekerjaan' required placeholder="Pekerjaan" >
                </div>
                <div class="form-group pb-3">
                    <label for="riwayat_penyakit">Riwayat Penyakit</label>
                    <input type="text" class="form-control"  id="riwayat_penyakit" name='riwayat_penyakit' placeholder="Riwayat Penyakit" >
                </div>
                <button type="submit" class="nav-link px-3 bg-success border-0 text-white">Tambah Pasien</button>
            </form>
        </div>
    </div>
</div>
@endsection