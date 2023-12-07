@extends('layouts.main')
@section('main')

<div class="container pb-5">
    <article class="py-4">
        <img src="{{ $detailberita['img'] }}" class="img_dberita card-img-top img-fluid" alt="..."> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $detailberita["title"] }}</h2>
        <h5 class="font-semibold">{{ $detailberita["author"] }}</h5>
        <p>{{ $detailberita["body"] }}</p>
    </article>

    <button class="bg-dark"><a class="text-white text-decoration-none" href="/berita">Kembali</a></button>
</div>
    
@endsection