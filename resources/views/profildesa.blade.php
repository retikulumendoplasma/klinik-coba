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

<hr>

<div class="row m-5">
    <div class="col-lg-4">
      <img class="rounded-circle" src="img/Gambar Kantor Desa Jatirejo.jpg" alt="Placeholder: 140x140" width="140" height="140">

      <h2>Heading</h2>
      <hr>
      <p>Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
      <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
    </div><!-- /.col-lg-4 -->
    <div class="col-lg-4">
      <img class="rounded-circle" src="img/Gambar Kantor Desa Jatirejo.jpg" alt="Placeholder: 140x140" width="140" height="140">

      <h2>Heading</h2>
      <hr>
      <p>Another exciting bit of representative placeholder content. This time, we've moved on to the second column.</p>
      <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
    </div><!-- /.col-lg-4 -->
    <div class="col-lg-4">
      <img class="rounded-circle" src="img/Gambar Kantor Desa Jatirejo.jpg" alt="Placeholder: 140x140" width="140" height="140">

      <h2>Heading</h2>
      <hr>
      <p>And lastly this, the third column of representative placeholder content.</p>
      <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
    </div><!-- /.col-lg-4 -->
</div><!-- /.row -->
    
@endsection