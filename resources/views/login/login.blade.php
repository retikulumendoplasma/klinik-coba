@extends('layouts.main')
@section('main')

<div class="container mt-5 pb-5">
    <div class="row d-flex justify-content-between align-items-center">
        <div class="col-md-5">

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="text-center">
                <img src="img/Palestina.jpg" alt="Logo Situs Anda" width="250" height="250">
                <h1>Desa Jatirejo</h1>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center">
                <h1>Login</h1>
            </div>

            <form action="/login" method="post">
                @csrf
                <div class="form-group pb-2">
                    <label for="email">Email/No HP</label>
                    <input type="text" name="email/nomor_hp" class="form-control @error('email/nomor_hp') is-invalid @enderror" id="email/nomor_hp"  placeholder="Masukkan email atau no HP" required>
                    @error('email/nomor_hp')
                        <div class="invalid-feedback">
                            {{ $massage }}
                        </div>
                    @enderror
                </div>
                <div class="form-group pb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password"  placeholder="Masukkan Password" required>
                </div>
                <button type="submit" class="btn btn-dark text-white btn-block mb-3">Masuk</button>
            </form>

            <small class="d-blok text-right mt-3"><a href="/register">Buat akun</a></small>
        </div>
    </div>
</div>

@endsection
