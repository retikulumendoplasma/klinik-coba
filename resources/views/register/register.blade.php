@extends('layouts.main')
@section('main')

<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Register</h1>
            </div>
            <form action="/register" method="post">
                @csrf
                <div class="form-group pb-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" required placeholder="Silahkan Masukkan Username" required value="{{ old('username') }}">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group pb-3">
                    <label for="email">Email/No HP</label>
                    <input type="text" class="form-control @error('email/nomor_hp') is-invalid @enderror" id="email/nomor_hp" name="email/nomor_hp" required placeholder="Silahkan Masukkan Email atau No HP" required value="{{ old('email/nomor_hp') }}">
                    @error('email/nomor_hp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group pb-3">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" required placeholder="Silahkan Isikan NIK" required value="{{ old('nik') }}">
                    @error('nik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group pb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Masukkan Password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark text-white btn-block mb-3" >Buat akun</button>
            </form>
            <small class="d-blok text-right mt-3"><a href="/login">Sudah punya akun</a></small>
        </div>
    </div>
</div>


@endsection