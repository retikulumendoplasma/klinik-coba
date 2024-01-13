@extends('dashBoard.dashboard')

@section('container')
<div class="container pb-5">
    <h2>Edit Berita</h2>
    <form action="/tambahB/{{ $berita->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="judul_berita" class="form-label">Judul Berita:</label>
            <input type="text" class="form-control" id="judul_berita" name="judul_berita" maxlength="100" required value="{{ old('judul_berita', $berita->judul_berita) }}">
        </div>
        <div class="mb-3">
            <label for="isi_berita" class="form-label">Isi Berita</label>
            <input type="hidden" id="isi_berita" name="isi_berita" value="{{ old('isi_berita', $berita->isi_berita) }}">
            <trix-editor input="isi_berita"></trix-editor>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Gambar</label>
            <input class="form-control" type="file" id="img" name="img" accept="image/*">
        </div>        
        <button type="submit" class="btn btn-primary">Edit Berita</button>
    </form>
    
    <a href="/kelolaBerita" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
</div>
@endsection