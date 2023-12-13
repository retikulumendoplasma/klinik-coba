@extends('dashBoard.dashboard')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Selamat datang, {{ auth()->user()->username }}</h1>
    </div>

    {{-- notif permohonan tender, saran masukan, dan surat --}}
    <div class="row pb-5">
        <div class="col-md-4">
            <a href="/kelolaTender" class="text-reset text-decoration-none">
                <div class="card-body text-center border">
                    <img src="https://drive.google.com/uc?id=1lYPDZWg2gXTASyOwiMx-i9oO-NFElr8d" height="100">
                    <h5>5</h5>
                    <h4>Permohonan Tender</h4>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="/saranMasukanAdmin" class="text-reset text-decoration-none">
                <div class="card-body text-center border">
                    <img src="https://drive.google.com/uc?id=18ja9n1n3pX2acNfjYXfqX4uWQ5FLwElM" height="100">
                    <h5>7</h5>
                    <h4>Saran dan Masukan</h4>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="/kelolaSurat" class="text-reset text-decoration-none">
                <div class="card-body text-center border">
                    <img src="https://drive.google.com/uc?id=1XsF5pLaScQfJmplURhICqHoMG9P9oEuV" height="100">
                    <h5>12</h5>
                    <h4>Permohonan Surat</h4>
                </div>
            </a>
        </div>
    </div>

@endsection