@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Tambah Penduduk </h1>
            </div>
            <form action="/register" method="post">
                <div class="form-group pb-3">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" required placeholder="Silahkan Masukkan Nama" >
                </div>
                <div class="form-group pb-3">
                    <label for="No_kk">No KK</label>
                    <input type="text" class="form-control"  id="KK" required placeholder="Silahkan Masukkan No KK" >
                </div>
                <div class="form-group pb-3">
                    <label for="NIK">NIK</label>
                    <input type="text" class="form-control"  id="NIK" required placeholder="Silahkan Masukkan NIK" >
                </div>
                <div class="form-group pb-3">
                    <label for="Tempat">Tempat Lahir</label>
                    <input type="text" class="form-control"  id="tempat" required placeholder="Silahkan Masukkan Tempat Lahir" >
                </div>
                <div class="form-group pb-3">
                    <label for="Tanggal">Tanggal Lahir</label>
                    <input type="date" class="form-control"  id="tanggal" required placeholder="Silahkan Masukkan Tanggal Lahir" >
                </div>
                <div class="form-group pb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" aria-label="Default select example">
                        <option value="1">Laki-laki</option>
                        <option value="2">Perempuan</option>
                    </select>
                </div>
                <div class="form-group pb-3">
                    <label for="Agama">Agama</label>
                    <input type="text" class="form-control"  id="agama" required placeholder="Agama" >
                </div>
                <div class="form-group pb-3">
                    <label for="Alamat">Alamat</label>
                    <input type="text" class="form-control"  id="alamat" required placeholder="Silahkan Masukkan Alamat" >
                </div>
                <div class="form-group pb-3">
                    <label for="NoHP">No HP</label>
                    <input type="tel" class="form-control"  id="phoneInput" maxlength="12" pattern="[0-9]+" placeholder="Silahkan Masukkan No HP" >
                </div>
                <div class="form-group pb-3">
                    <label for="Status">Statu Perkawinan</label>
                    <input type="text" class="form-control"  id="status" required placeholder="Silahkan Masukkan Status" >
                </div>
                <div class="form-group pb-3">
                    <label for="Pendidikan">Pendidikan</label>
                    <input type="text" class="form-control"  id="pendidikan" required placeholder="Pendidikan" >
                </div>
                <div class="form-group pb-3">
                    <label for="Kewarganegaraan">Kewarganegaraan</label>
                    <input type="text" class="form-control"  id="kewarganegaraan" required placeholder="Kewarganegaraan" >
                </div>
                <div class="form-group pb-3">
                    <label for="Status_KK">Status Hubungan Pada KK</label>
                    <input type="text" class="form-control"  id="status_KK" required placeholder="Status Hubungan Pada KK" >
                </div>
                <button type="submit" class="btn btn-dark text-white btn-block mb-3" >Tambah Penduduk</button>
            </form>
        </div>
    </div>
</div>
@endsection