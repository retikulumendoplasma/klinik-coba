@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Edit Data Dokter/Perawat </h1>
            </div>
            <form action="/tambahDokter/{{ $dokter->id_dokter }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group pb-3">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name='nama' required placeholder="Silahkan Masukkan Nama" value="{{ old('nama', $dokter->nama) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="nama">NIK</label>
                    <input type="text" class="form-control" id="nik" name='nik' required placeholder="Silahkan Masukkan NIK" value="{{ old('nik', $dokter->nik) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="Alamat">Alamat</label>
                    <input type="text" class="form-control"  id="alamat" name='alamat' required placeholder="Silahkan Masukkan Tempat Lahir" value="{{ old('alamat', $dokter->alamat) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="Tanggal">Tanggal Lahir</label>
                    <input type="date" class="form-control"  id="tanggal" name='tanggal_lahir' required placeholder="Silahkan Masukkan Tanggal Lahir" value="{{ old('tanggal_lahir', $dokter->tanggal_lahir) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="nowa">No Telp/WA</label>
                    <input type="tel" class="form-control"  id="telp_hp" name='telp_hp' maxlength="12" pattern="[0-9]+" placeholder="Silahkan Masukkan No HP" value="{{ old('telp_hp', $dokter->telp_hp) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="Jabatan">Jabatan</label>
                    <select class="form-select" name="role" aria-label="Default select example">
                        <option value="Dokter" {{ old('role', $dokter->role) == 'Dokter' ? 'selected' : '' }}>Dokter</option>
                        <option value="Perawat" {{ old('role', $dokter->role) == 'Perawat' ? 'selected' : '' }}>Perawat</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success text-white btn-block mb-3">Edit Data Dokter/Perawat</button>
            </form>
        </div>
    </div>
</div>
@endsection