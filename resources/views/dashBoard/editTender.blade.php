@extends('dashBoard.dashboard')

@section('container')

<div class="container pb-5">
    <h2>Edit Tender</h2>
    <form action="/buatTender/{{ $tender->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group pb-3">
            <label for="judul_tender">Judul Tender</label>
            <input type="text" class="form-control" id="judul_tender" name="judul_tender" required placeholder="Silahkan Masukkan Judul" value="{{ old('judul_tender', $tender->judul_tender) }}">
        </div>
        <div class="mb-3">
            <label for="detail" class="form-label">Detail tender</label>
            <input id="detail" type="hidden" name="detail" required placeholder="Silahkan Masukkan Judul" value="{{ old('detail', $tender->detail) }}">
            <trix-editor input="detail"></trix-editor>
        </div>
        <div class="form-group pb-3">
            <label for="Tanggal mulai">Tanggal Tender Dimulai</label>
            <input type="date" class="form-control"  id="jadwal_tender_dimulai" name="jadwal_tender_dimulai" required placeholder="Silahkan Masukkan Tanggal"  value="{{ old('jadwal_tender_dimulai', $tender->jadwal_tender_dimulai) }}">
        </div>
        <div class="form-group pb-3">
            <label for="Tanggal berakhir">Tanggal Tender Berakhir</label>
            <input type="date" class="form-control"  id="jadwal_tender_berakhir" name="jadwal_tender_berakhir" required placeholder="Silahkan Masukkan Tanggal" value="{{ old('jadwal_tender_berakhir', $tender->jadwal_tender_berakhir) }}">
        </div>
        <div class="form-group pb-3">
            <label for="Anggaran">Anggaran</label>
            <input type="number" class="form-control"  id="anggaran_dana" name="anggaran_dana" required placeholder="Silahkan Masukkan Nominal" value="{{ old('anggaran_dana', $tender->anggaran_dana) }}">
        </div>
        <div class="mb-3">
            <label for="gambar_tender" class="form-label">Gambar</label>
            <input class="form-control" type="file" id="gambar_tender" name="gambar_tender" accept="image/*" value="{{ old('gambar_tender', $tender->gambar_tender) }}">
        </div>
        <button type="submit" class="btn btn-dark text-white btn-block mb-3" >Edit Tender</button>
    </form>
</div>
@endsection