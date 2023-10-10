@extends('layouts.main')
@section('container')
    <article class="py-4">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">{{ $detailberita["title"] }}</h2>
        <h2 class="font-semibold">{{ $detailberita["author"] }}</h5>
        <p>{{ $detailberita["body"] }}</p>
    </article>

    <a href="/berita">Kembali</a>
@endsection