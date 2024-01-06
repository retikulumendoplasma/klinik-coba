@extends('dashBoard.dashboard')

@section('container')
<div class="container pb-5">
    <article class="py-4">
        <img src="{{ $viewberita->img }}" class="img_dberita card-img-top img-fluid" alt="..."> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $viewberita->judul_berita }}</h2>
        <h5 class="font-semibold">{{ $viewberita->author }}</h5>
        <p>{!! $viewberita->isi_berita !!}</p>
    </article>
    
    <a href="/kelolaBerita" class="btn-success"><span data-feather="arrow left">Kembali</span></a>
    <a href="/kelolaBerita/{{ $viewberita->id }}/editBerita" class="btn-warning"><span data-feather="edit">Edit</span></a>
    <!-- Form untuk delete -->
    <form action="/kelolaBerita/{{ $viewberita->id }}" method="post" class="d-inline" >
        @csrf
        @method('DELETE')
        <button class="badge bg-danger" onclick="return confirm('Hapus Berita Ini?')"><span data-feather="x-circle"></span>hapus</button>
    </form>  
    
</div>


@endsection