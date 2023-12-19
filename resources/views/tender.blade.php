@extends('layouts.main')

@section('main')

<div class="container pb-5">
    <h2 class="head-text">Program Pembangunan Desa</h2>
    <div class="row m-5">
        <div class="col-md-4 pb-3">
            <div class="card h-100">
                <img src="img/Gambar Kantor DEsa Jatirejo.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">Waktu mulai: </p>
                    <p class="card-text">Waktu selesai: </p>
                    <p class="card-text">Anggaran tersedia: </p>
                </div>
                <a href="/pengajuanTender" class="btn btn-success">Ajukan</a>
            </div>
        </div>
        <div class="col-md-4 pb-3">
            <div class="card h-100">
                <img src="img/Gambar TK Harapan Kita.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">Waktu mulai: </p>
                    <p class="card-text">Waktu selesai: </p>
                    <p class="card-text">Anggaran tersedia: </p>
                </div>
                <a href="/pengajuanTender" class="btn btn-success">Ajukan</a>
            </div>
        </div>
    </div>
</div>
    
@endsection