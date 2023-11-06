@extends('layouts.main')
@section('container')

<div class="container mt-5 pb-5">
    <div class="row d-flex justify-content-between align-items-center">
        <div class="col-md-5">
            <div class="text-center">
                <img src="img/Logo Nagan Raya.jpg" alt="Logo Situs Anda" width="250" height="250">
                <h1>Desa Jatirejo</h1>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Login
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Masukkan email Anda">
                        </div>
                        <div class="form-group pb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Masukkan password Anda">
                        </div>
                        <button type="submit" class="text-white btn btn-dark">Masuk</button>
                    </form>
                    <small class="d-blok text-right mt-3"><a href="/register">Buat akun</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection