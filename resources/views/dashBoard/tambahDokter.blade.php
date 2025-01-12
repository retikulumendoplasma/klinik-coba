@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Tambah Dokter/Perawat </h1>
            </div>
            <form action="/tambahDokter" method="post" enctype="multipart/form-data">
                @csrf
                {{-- <div class="form-group pb-3">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                </div> --}}
                <div class="form-group pb-3">
                    <label for="nama">NIK</label>
                    <input type="text" class="form-control" id="nik" name='nik' required placeholder="Silahkan Masukkan NIK" >
                </div>
                <div class="form-group pb-3">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name='nama' required placeholder="Silahkan Masukkan Nama" >
                </div>
                <div class="form-group pb-3">
                    <label for="Alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name='alamat' required placeholder="Silahkan Masukkan Alamat" >
                </div>
                {{-- <div class="form-group pb-3">
                    <label for="Tempat">Tempat Lahir</label>
                    <input type="text" class="form-control"  id="tempat" name='tempat_lahir' required placeholder="Silahkan Masukkan Tempat Lahir" >
                </div> --}}
                <div class="form-group pb-3">
                    <label for="Tanggal">Tanggal Lahir</label>
                    <input type="date" class="form-control"  id="tanggal" name='tanggal_lahir' required placeholder="Silahkan Masukkan Tanggal Lahir" >
                </div>
                <div class="form-group pb-3">
                    <label for="telphp">No Telp/WA</label>
                    <input type="tel" class="form-control"  id="telp_hp" name='telp_hp' maxlength="12" pattern="[0-9]+" placeholder="Silahkan Masukkan No Telp/WA" >
                </div>
                <div class="form-group pb-3">
                    <label for="Role">Jabatan</label>
                    <select class="form-select" name='role' aria-label="Default select example">
                        <option value="1">Dokter</option>
                        <option value="2">Perawat</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success text-white btn-block mb-3">Tambah Dokter/Perawat</button>
            </form>
        </div>
    </div>
</div>
@endsection