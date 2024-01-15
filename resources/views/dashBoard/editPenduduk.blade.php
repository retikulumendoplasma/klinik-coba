@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Edit Penduduk </h1>
            </div>
            <form action="/tambahPenduduk/{{ $penduduk->nik }}" method="post">
                @method('put')
                @csrf
                <div class="form-group pb-3">
                    <label for="NIK">NIK</label>
                    <input type="number" class="form-control"  id="NIK" name='nik' required placeholder="Silahkan Masukkan NIK" value="{{ old('nik', $penduduk->nik) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="No_kk">No KK</label>
                    <input type="text" class="form-control"  id="KK" name='nomor_kk' required placeholder="Silahkan Masukkan No KK" value="{{ old('nomor_kk', $penduduk->nomor_kk) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name='nama' required placeholder="Silahkan Masukkan Nama" value="{{ old('nama', $penduduk->nama) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="Tempat">Tempat Lahir</label>
                    <input type="text" class="form-control"  id="tempat" name='tempat_lahir' required placeholder="Silahkan Masukkan Tempat Lahir" value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="Tanggal">Tanggal Lahir</label>
                    <input type="date" class="form-control"  id="tanggal" name='tanggal_lahir' required placeholder="Silahkan Masukkan Tanggal Lahir" value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name='jenis_kelamin' aria-label="Default select example" value="{{ old('jenis_kelamin', $penduduk->jenis_kelamin) }}">
                        <option value="1">Laki-laki</option>
                        <option value="2">Perempuan</option>
                    </select>

                </div>
                <div class="form-group pb-3">
                    <label for="Agama">Agama</label>
                    <input type="text" class="form-control"  id="agama" name='agama' required placeholder="Agama" value="{{ old('agama', $penduduk->agama) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="Alamat">Alamat</label>
                    <input type="text" class="form-control"  id="alamat" name='alamat' required placeholder="Silahkan Masukkan Alamat" value="{{ old('alamat', $penduduk->alamat) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="NoHP">No HP</label>
                    <input type="tel" class="form-control"  id="phoneInput" name='nomor_hp' maxlength="12" pattern="[0-9]+" placeholder="Silahkan Masukkan No HP" value="{{ old('nomor_hp', $penduduk->nomor_hp) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="exampleFormControlInput1" class="form-label">Status Perkawinan</label>
                    <select class="form-select" name='status_perkawinan' aria-label="Default select example" value="{{ old('status_perkawinan', $penduduk->status_perkawinan) }}">
                        <option value="1">Menikah</option>
                        <option value="2">Belum Menikah</option>
                    </select>
                </div>
                <div class="form-group pb-3">
                    <label for="Pendidikan">Pendidikan</label>
                    <input type="text" class="form-control"  id="pendidikan" name='pendidikan' required placeholder="Pendidikan" value="{{ old('pendidikan', $penduduk->pendidikan) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="Pekerjaan">Pekerjaan</label>
                    <input type="text" class="form-control"  id="pekerjaan" name='pekerjaan' required placeholder="Pekerjaan" value="{{ old('pekerjaan', $penduduk->pekerjaan) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="Status_KK">Status Hubungan Pada KK</label>
                    <input type="text" class="form-control"  id="status_KK" name='status_hubungan_kk' required placeholder="Status Hubungan Pada KK" value="{{ old('status_hubungan_kk', $penduduk->status_hubungan_kk) }}">
                </div>
                <button type="submit" class="btn btn-success text-white btn-block mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                     Edit Penduduk
                </button>
            </form>
        </div>
    </div>
</div>
@endsection