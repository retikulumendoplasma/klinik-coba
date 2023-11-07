@extends('layouts.main')
@section('container')

<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Register</h1>
            </div>
            <form action="proses_login.php" method="post">
                <div class="form-group pb-3">
                    <label for="email">Email/No HP</label>
                    <input type="text" class="form-control" id="username" name="username" required placeholder="Silahkan Masukkan Email atau No HP">
                </div>
                <div class="form-group pb-3">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="password" name="password" required placeholder="Silahkan Isikan NIK">
                </div>
                <div class="form-group pb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan Password">
                </div>
                <button type="submit" class="btn btn-dark text-white btn-block mb-3">Buat akun</button>
            </form>
            <small class="d-blok text-right mt-3"><a href="/login">Sudah punya akun</a></small>
        </div>
    </div>
</div>


@endsection