@extends('layouts.main')

@section('container')
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="5000">
            <img src="img/Gambar Mesjid Al-Ikhlas.jpg" class="d-block w-100" alt="..." height="720">
        </div>
        <div class="carousel-item" data-bs-interval="5000">
            <img src="img/Gambar Kantor Desa Jatirejo.jpg" class="d-block w-100" alt="..." height="720">
        </div>
        <div class="carousel-item" data-bs-interval="5000">
            <img src="img/Gambar Struktur Organisasi.png" class="d-block w-100" alt="..." height="720">
        </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
        </button>
    </div>
    
@endsection