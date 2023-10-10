@extends('layouts.main')

@section('container')
    @foreach ($berita as $Berita)
        {{-- menampilkan berita dalam bentuk card --}}
        <div class="card mb-3">
            <img src="" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title font-semibold text-xl text-gray-800 leading-tight"><a href="/berita/{{ $Berita["slug"] }}">{{ $Berita["title"] }}</a></h5>
              <h5 class="card-text font-semibold">{{ $Berita["author"] }}</h5>
              <p class="card-text">{{ $Berita["body"] }}</p>
              <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
            </div>
        </div>   
    @endforeach
@endsection