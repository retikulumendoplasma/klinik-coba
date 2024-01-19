@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Edit Aparatur </h1>
            </div>
            <form action="/tambahAparatur/{{ $aparatur->nip_nipd }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group pb-3">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*" value="{{ old('foto', $aparatur->foto) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="nama">NIP/NIPD</label>
                    <input type="number" class="form-control" id="nip_nipd" name='nip_nipd' required placeholder="Silahkan Masukkan NIP atau NIPD" value="{{ old('nip_nipd', $aparatur->nip_nipd) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name='nama' required placeholder="Silahkan Masukkan Nama" value="{{ old('nama', $aparatur->nama) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="Tempat">Tempat Lahir</label>
                    <input type="text" class="form-control"  id="tempat" name='tempat_lahir' required placeholder="Silahkan Masukkan Tempat Lahir" value="{{ old('tempat_lahir', $aparatur->tempat_lahir) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="Tanggal">Tanggal Lahir</label>
                    <input type="date" class="form-control"  id="tanggal" name='tanggal_lahir' required placeholder="Silahkan Masukkan Tanggal Lahir" value="{{ old('tanggal_lahir', $aparatur->tanggal_lahir) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="nowa">No WA</label>
                    <input type="tel" class="form-control"  id="no_wa" name='no_wa' maxlength="12" pattern="[0-9]+" placeholder="Silahkan Masukkan No HP" value="{{ old('no_wa', $aparatur->no_wa) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="Jabatan">Jabatan</label>
                    <input type="text" class="form-control"  id="jabatan" name='jabatan' required placeholder="Jabatan" value="{{ old('jabatan', $aparatur->jabatan) }}">
                </div>
                <button type="submit" class="btn btn-success text-white btn-block mb-3">Edit Aparatur</button>
            </form>
        </div>
    </div>
</div>
@endsection