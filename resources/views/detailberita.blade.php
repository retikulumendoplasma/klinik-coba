@extends('layouts.main')

@section('main')

<div class="container pb-5">
    <article class="py-4">
        <img src="{{ asset('storage/' . $detailberita->img  ) }}" alt="..." style="max-width: 100%; max-height: 350px;">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $detailberita->judul_berita }}</h2>
        <h5 class="font-semibold">{{ $detailberita->author }}</h5>
        <p>{!! $detailberita->isi_berita !!}</p>
    </article>
    
    <button class="bg-dark"><a class="text-white text-decoration-none" href="/berita">Kembali</a></button>
</div>
    
@endsection