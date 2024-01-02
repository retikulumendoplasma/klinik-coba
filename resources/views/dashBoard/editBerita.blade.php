@extends('dashBoard.dashboard')

@section('container')
<div class="container pb-5">
    <h2>Edit Berita</h2>
    <form action="/tambahB/{{ $berita->id }}" method="post">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="judul_berita" class="form-label">Judul Berita:</label>
            <input type="text" class="form-control" id="judul_berita" name="judul_berita" maxlength="100" required value="{{ old('judul_berita', $berita->judul_berita) }}">
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug:</label>
            <input type="text" class="form-control" id="slug" name="slug" required value="{{ old('judul_berita', $berita->slug) }}">
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Penulis:</label>
            <input type="text" class="form-control" id="author" name="author" required value="{{ old('judul_berita', $berita->author) }}">
        </div>
        <div class="mb-3">
            <label for="isi_berita" class="form-label">Isi Berita</label>
            <input type="hidden" id="isi_berita" name="isi_berita" value="{{ old('judul_berita', $berita->isi_berita) }}">
            <trix-editor input="isi_berita"></trix-editor>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">excerpt:</label>
            <input type="excerpt" class="form-control" id="excerpt" name="excerpt" maxlength="150" required value="{{ old('judul_berita', $berita->excerpt) }}">
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">URL Gambar:</label>
            <input type="text" class="form-control" id="img" name="img" required value="{{ old('judul_berita', $berita->img) }}">
        </div>
        <button type="submit" class="btn btn-primary">Edit Berita</button>
    </form>
    
    <a href="/kelolaBerita" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
</div>
@endsection