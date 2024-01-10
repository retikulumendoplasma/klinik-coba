@extends('layouts.main')

@section('main')
    {{-- Slider image --}}
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="3000">
                <img src="img/Gambar Mesjid Al-Ikhlas.jpg" class="d-block w-100" alt="..." height="720">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="img/Gambar Kantor Desa Jatirejo.jpg" class="d-block w-100" alt="..." height="720">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="img/Gambar Struktur Organisasi.png" class="d-block w-100" alt="..." height="720">
            </div>
        </div>
        <button class="carousel-control-prev d-md-none" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next d-md-none" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="row m-5">
        <h2 class="head_text pb-3">Berita Terkini Desa Jatirejo</h2>
        @foreach ($berita as $Berita)
        <div class="col-md-4 mb-5">
            <div class="card" style="height: 100%;">
                <img src="{{ asset('storage/' . $Berita->img) }}" alt="Foto Pendukung" style="max-width: 100%; max-height: 200px;">
                <div class="card-body">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight"><a href="/berita/{{ $Berita->id }}">{{ $Berita->judul_berita }}</a></h2>
                    <h5 class="card-text font-semibold">{{ $Berita->author }}</h5>
                    <p class="card-text">{{ $Berita->excerpt }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    {{-- interval guard --}}
    <script>
        $(document).ready(function() {
            $('#carouselExampleInterval').carousel({
                interval: 5000
            });
        });
    </script>
@endsection