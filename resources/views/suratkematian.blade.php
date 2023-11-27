@extends('layouts.main')

@section('main')
<div class="container">
    <h1 class="text-center pb-2">Surat Keterangan Meninggal Dunia</h1>
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Nama</option>
                    <option value="1">Febry Aji Pradilla</option>
                    <option value="2">Muhammad Yoga Pranata</option>
                    <option value="3">Bani Illyasa</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tempat, tgl lahir</label>
                <input class="form-control" type="text" value="Tempat, tgl lahir" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Jenis kelamin</label>
                <input class="form-control" type="text" value="Jenis kelamin" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pekerjaan</label>
                <input class="form-control" type="text" value="Pekerjaan" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload foto KTP</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload foto KK</label>
                <input class="form-control" type="file" id="formFile">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Status perkawinan</label>
                <input class="form-control" type="text" value="Status perkawinan" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Agama</label>
                <input class="form-control" type="text" value="Agama" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                <input class="form-control" type="text" value="Alamat" aria-label="Disabled input example" disabled readonly>
            </div>
        </div>
    </div>
    
    <button type="button" class="position end-0 m-2 btn btn-dark">Ajukan</button>
</div>

@endsection