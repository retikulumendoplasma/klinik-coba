@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Buat Tender </h1>
            </div>
            <form action="/register" method="post">
                <div class="form-group pb-3">
                    <label for="judultender">Judul Tender</label>
                    <input type="text" class="form-control" id="judul" required placeholder="Silahkan Masukkan Judul" >
                </div>
                <div class="form-group pb-3">
                    <label for="Tanggal mulai">Tanggal Tender Dimulai</label>
                    <input type="date" class="form-control"  id="tanggal tender" required placeholder="Silahkan Masukkan Tanggal" >
                </div>
                <div class="form-group pb-3">
                    <label for="Tanggal berakhir">Tanggal Tender Berakhir</label>
                    <input type="date" class="form-control"  id="tanggal tender" required placeholder="Silahkan Masukkan Tanggal" >
                </div>
                <div class="form-group pb-3">
                    <label for="Anggaran">Anggaran</label>
                    <input type="text" class="form-control"  id="anggaran" required placeholder="Silahkan Masukkan Nominal" >
                </div>
                <button type="submit" class="btn btn-dark text-white btn-block mb-3" >Buat Tender</button>
            </form>
        </div>
    </div>
</div>
@endsection