{{-- @extends('dashBoard.dashboard')

@section('container')
<h2>Tambah Berita</h2>

<div class="col-lg-8">
    <form method="post" action="#">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="category_id"> --}}
                {{-- @foreach ($categories as $category) --}}
                    {{-- <option value="_">i</option> --}}
                {{-- @endforeach --}}
            {{-- </select>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <input id="x" type="hidden" name="content">
            <trix-editor input="x"></trix-editor>
        </div>
        <button type="submit" class="btn btn-primary">Buat Berita</button>
    </form>
</div>



@endsection --}}

@extends('dashBoard.dashboard')

@section('container')
<div class="container pb-5">
    <h2>Tambah Berita</h2>
    <form action="/kelolaBerita" method="post">
        @csrf
        <div class="mb-3">
            <label for="judul_berita" class="form-label">Judul Berita:</label>
            <input type="text" class="form-control" id="judul_berita" name="judul_berita" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Penulis:</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>
        <div class="mb-3">
            <label for="isi_berita" class="form-label">Isi Berita</label>
            <input id="isi_berita" type="hidden" name="content">
            <trix-editor input="x"></trix-editor>
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">URL Gambar:</label>
            <input type="text" class="form-control" id="img" name="img" required>
        </div>
        <!-- Tambahkan input lain sesuai kebutuhan, misalnya slug, kategori, dll. -->

        <button type="submit" class="btn btn-primary">Tambah Berita</button>
    </form>
    
    <a href="/kelolaBerita" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
</div>
@endsection
