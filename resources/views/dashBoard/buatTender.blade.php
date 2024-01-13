@extends('dashBoard.dashboard')

@section('container')

<div class="container pb-5">
    <h2>Buat Tender</h2>
    <form action="/buatTender" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul_tender">Judul Tender</label>
            <input type="text" class="form-control" id="judul_tender" name="judul_tender" required placeholder="Silahkan Masukkan Judul" >
        </div>
        <div class="mb-3">
            <label for="detail" class="form-label">Detail tender</label>
            <input id="detail" type="hidden" name="detail">
            <trix-editor input="detail"></trix-editor>
        </div>
        <div class="mb-3">
            <label for="Tanggal mulai">Tanggal Tender Dimulai</label>
            <input type="date" class="form-control"  id="jadwal_tender_dimulai" name="jadwal_tender_dimulai" required placeholder="Silahkan Masukkan Tanggal" >
        </div>
        <div class="mb-3">
            <label for="Tanggal berakhir">Tanggal Tender Berakhir</label>
            <input type="date" class="form-control"  id="jadwal_tender_berakhir" name="jadwal_tender_berakhir" required placeholder="Silahkan Masukkan Tanggal" >
        </div>
        <div class="mb-3">
            <label for="Anggaran">Anggaran</label>
            <input type="number" class="form-control"  id="anggaran_dana" name="anggaran_dana" required placeholder="Silahkan Masukkan Nominal" >
        </div>
        <div class="mb-3">
            <label for="gambar_tender" class="form-label">Gambar</label>
            <input class="form-control" type="file" id="gambar_tender" name="gambar_tender" accept="image/*">
        </div>
        <button type="submit" class="btn btn-dark text-white btn-block mb-3" >Buat Tender</button>
    </form>
</div>
@endsection