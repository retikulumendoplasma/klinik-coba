@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Tambah Obat </h1>
            </div>
            <form action="/editObat/{{ $obat->id_obat }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group pb-3">
                    <label for="nama_obat">Nama Obat</label>
                    <input type="text" class="form-control" id="nama_obat" name='nama_obat' required placeholder="Silahkan Masukkan nama obat" value="{{ old('nama_obat', $obat->nama_obat) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="jenis_obat">Jenis Obat</label>
                    <input type="text" class="form-control" id="jenis_obat" name='jenis_obat' required placeholder="Silahkan Masukkan jenis obat" value="{{ old('jenis_obat', $obat->jenis_obat) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="supplier">Supplier</label>
                    <input type="text" class="form-control" id="supplier" name='supplier' required placeholder="Silahkan Masukkan supplier" value="{{ old('supplier', $obat->supplier) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="harga_beli">Harga Beli</label>
                    <input type="number" class="form-control" id="harga_beli" name='harga_beli' required placeholder="Silahkan Masukkan harga beli" value="{{ old('harga_beli', $obat->harga_beli) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="harga_jual">Harga Jual</label>
                    <input type="number" class="form-control" id="harga_jual" name='harga_jual' required placeholder="Silahkan Masukkan harga jual" value="{{ old('harga_jual', $obat->harga_jual) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="stok">Stok</label>
                    <input type="number" class="form-control"  id="stok" name='stok' required placeholder="Silahkan Masukkan stok awal" value="{{ old('stok', $obat->stok) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control"  id="keterangan" name='keterangan'  placeholder="Silahkan Masukkan keterangan" value="{{ old('keterangan', $obat->keterangan) }}">
                </div>
                <button type="submit" class="btn btn-success text-white btn-block mb-3">Tambah Obat</button>
            </form>
        </div>
    </div>
</div>
@endsection