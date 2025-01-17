@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Detail Dokter/Perawat </h1>
            </div>
            <div class="form-group pb-3">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name='nama' value="{{ $dokter->nama }}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group pb-3">
                <label for="Nik">NIK</label>
                <input type="text" class="form-control"  id="nik" name='nik' value="{{ $dokter->nik }}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group pb-3">
                <label for="Alamat">Alamat</label>
                <input type="text" class="form-control"  id="alamat" name='alamat' value="{{ $dokter->alamat }}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group pb-3">
                <label for="Tanggal">Tanggal Lahir</label>
                <input type="date" class="form-control"  id="tanggal" name='tanggal_lahir' value="{{ $dokter->tanggal_lahir }}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group pb-3">
                <label for="exampleFormControlInput1" class="form-label">Jabatan</label>
                <input class="form-control" type="text" id="role" value="{{ $dokter->role }}" name="role" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group pb-3">
                <label for="NoHP">No Telp/WA</label>
                <input type="tel" class="form-control"  id="telp_hp" name='telp_hp' value="{{ $dokter->telp_hp }}" aria-label="Disabled input example" disabled readonly>
            </div>
            <a href="/kelolaDokter" class="badge btn-primary" style="text-decoration: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                </svg>
                Kembali
             </a>
        </div>
    </div>
</div>

@endsection