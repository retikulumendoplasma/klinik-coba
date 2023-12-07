@extends('layouts.main')

@section('main')

<div class="container">
    @foreach ($berita as $Berita)
        {{-- menampilkan berita dalam bentuk card --}}
        <div class="card mb-3">
            <img src="{{ $Berita->img }}" class="card-img-top" alt="..." height="300px">
            <div class="card-body">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight"><a href="/berita/{{ $Berita->id }}">{{ $Berita->judul_berita }}</a></h2>
                <h5 class="card-text font-semibold">{{ $Berita->author }}</h5>
                <p class="card-text">{{ $Berita->excerpt }}</p>
                <p class="card-text"><small class="text-body-secondary">Last updated {{ $Berita->tgl_terbit }}</small></p>
            </div>
        </div>   
    @endforeach
</div>
    
@endsection