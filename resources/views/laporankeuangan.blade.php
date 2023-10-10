@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-2">
            <h5>Histori laporan keuangan desa</h5>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">2020</a>
                <a href="#" class="list-group-item list-group-item-action">2021</a>
                <a href="#" class="list-group-item list-group-item-action">2022</a>
                <a href="#" class="list-group-item list-group-item-action active">2023</a>
            </div>
        </div>
        <div class="col-9">
            <div class="py-6">
                <img src="img/Gambar Struktur Organisasi.png" class="img-fluid" alt="...">
            </div>
            <button type="button" class="m-2 btn btn-dark">Download PDF</button>
        </div>
    </div>
@endsection