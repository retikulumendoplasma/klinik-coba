@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Buat Tender </h1>
            </div>
            <form action="/buatTender" method="post">
                @csrf
                <div class="form-group pb-3">
                    <label for="judul_tender">Judul Tender</label>
                    <input type="text" class="form-control" id="judul_tender" name="judul_tender" required placeholder="Silahkan Masukkan Judul" >
                </div>
                <div class="form-group pb-3">
                    <label for="Tanggal mulai">Tanggal Tender Dimulai</label>
                    <input type="date" class="form-control"  id="jadwal_tender_dimulai" name="jadwal_tender_dimulai" required placeholder="Silahkan Masukkan Tanggal" >
                </div>
                <div class="form-group pb-3">
                    <label for="Tanggal berakhir">Tanggal Tender Berakhir</label>
                    <input type="date" class="form-control"  id="jadwal_tender_berakhir" name="jadwal_tender_berakhir" required placeholder="Silahkan Masukkan Tanggal" >
                </div>
                <div class="form-group pb-3">
                    <label for="Anggaran">Anggaran</label>
                    <input type="number" class="form-control"  id="anggaran_dana" name="anggaran_dana" required placeholder="Silahkan Masukkan Nominal" >
                </div>
                <div class="mb-3">
                    <label for="img" class="form-label">URL Gambar:</label>
                    <input type="text" class="form-control" id="gambar_tender" name="gambar_tender" required>
                </div>
                <button type="submit" class="btn btn-dark text-white btn-block mb-3" >Buat Tender</button>
            </form>
        </div>
    </div>
</div>
@endsection