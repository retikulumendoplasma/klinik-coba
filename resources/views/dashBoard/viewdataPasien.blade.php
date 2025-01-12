@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Detail Pasien </h1>
            </div>
            {{-- <div class="form-group pb-3">
                <label for="NIK">NIK</label>
                <input type="number" class="form-control"  id="NIK" name='nik' value="{{ $penduduk->nik }}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group pb-3">
                <label for="No_kk">No KK</label>
                <input type="text" class="form-control"  id="KK" name='nomor_kk' value="{{ $penduduk->nomor_kk }}" aria-label="Disabled input example" disabled readonly>
            </div> --}}
            <div class="form-group pb-3">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name='nama' value="{{ $patients->nama }}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group pb-3">
                <label for="Tempat">Tempat Lahir</label>
                <input type="text" class="form-control"  id="tempat" name='tempat_lahir' value="{{ $patients->tempat_lahir }}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group pb-3">
                <label for="Tanggal">Tanggal Lahir</label>
                <input type="date" class="form-control"  id="tanggal" name='tanggal_lahir' value="{{ $patients->tanggal_lahir }}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group pb-3">
                <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                <input class="form-control" type="text" id="jenis_kelaminInput" value="{{ $patients->jenis_kelamin }}" name="jenis_kelamin" aria-label="Disabled input example" disabled readonly>
            </div>
            {{-- <div class="form-group pb-3">
                <label for="Agama">Agama</label>
                <input type="text" class="form-control"  id="agama" name='agama' value="{{ $patients->agama }}" aria-label="Disabled input example" disabled readonly>
            </div> --}}
            <div class="form-group pb-3">
                <label for="Alamat">Alamat</label>
                <input type="text" class="form-control"  id="alamat" name='alamat' value="{{ $patients->alamat }}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group pb-3">
                <label for="NoHP">No HP</label>
                <input type="tel" class="form-control"  id="phoneInput" name='nomor_hp' value="{{ $patients->nomor_hp }}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group pb-3">
                <label for="exampleFormControlInput1" class="form-label">Status Perkawinan</label>
                <input class="form-control" type="text" id="status_perkawinanInput" value="{{ $patients->status_perkawinan }}" name="status_perkawinan" aria-label="Disabled input example" disabled readonly>
            </div>
            {{-- <div class="form-group pb-3">
                <label for="Pendidikan">Pendidikan</label>
                <input type="text" class="form-control"  id="pendidikan" name='pendidikan' value="{{ $patients->pendidikan }}" aria-label="Disabled input example" disabled readonly>
            </div> --}}
            <div class="form-group pb-3">
                <label for="Pekerjaan">Pekerjaan</label>
                <input type="text" class="form-control"  id="pekerjaan" name='pekerjaan' value="{{ $patients->pekerjaan }}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group pb-3">
                <label for="Riwayat_Penyakit">Riwayat Penyakit</label>
                <input type="text" class="form-control"  id="riwayat_penyakit" name='riwayat_penyakit' value="{{ $patients->riwayat_penyakit }}" aria-label="Disabled input example" disabled readonly>
            </div>
            {{-- <div class="form-group pb-3">
                <label for="Status_KK">Status Hubungan Pada KK</label>
                <input type="text" class="form-control"  id="status_KK" name='status_hubungan_kk' value="{{ $penduduk->status_hubungan_kk }}" aria-label="Disabled input example" disabled readonly>
            </div> --}}
            <a href="/dataPasien" class="badge btn-primary" style="text-decoration: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                </svg>
                Kembali
             </a>
        </div>
    </div>
</div>

@endsection