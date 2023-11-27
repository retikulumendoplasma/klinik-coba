@extends('layouts.main')
@section('main')

<div class="container mt-5 pb-5">
    <div class="row d-flex justify-content-between align-items-center">
        <div class="col-md-5">
            <div class="text-center">
                <img src="img/Palestina.jpg" alt="Logo Situs Anda" width="250" height="250">
                <h1>Desa Jatirejo</h1>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center">
                <h1>Login</h1>
            </div>
            <form action="proses_login.php" method="post">
                <div class="form-group pb-2">
                    <label for="email">Email/No HP</label>
                    <input type="text" class="form-control" id="username" name="username" required placeholder="Masukkan email atau no HP">
                </div>
                <div class="form-group pb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan Password">
                </div>
                <a href="/berita" class="btn btn-dark text-white btn-block mb-3">Masuk</a>
            </form>
            <small class="d-blok text-right mt-3"><a href="/register">Buat akun</a></small>
        </div>
    </div>
</div>

@endsection