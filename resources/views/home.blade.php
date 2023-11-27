@extends('layouts.main')

@section('main')
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

    <div class="row m-5">
        @foreach ($berita as $Berita)
        <div class="col-md-4">
            <div class="card">
                <img src="img/wilayahdesa.png" class="card-img-top img-fluid" alt="...">
                  <div class="card-body">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight"><a href="/berita/{{ $Berita["slug"] }}">{{ $Berita["title"] }}</a></h2>
                    <h5 class="card-text font-semibold">{{ $Berita["author"] }}</h5>
                    <p class="card-text">{{ $Berita["body"] }}</p>
                  </div>
            </div>
        </div>
        @endforeach
    </div>
        
@endsection