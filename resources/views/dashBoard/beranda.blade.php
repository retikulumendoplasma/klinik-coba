@extends('dashBoard.dashboard')

@section('container')

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Selamat datang, {{ auth()->user()->username }}</h1>
    </div>

    {{-- notif permohonan tender, saran masukan, dan surat --}}
    <div class="row p-5">
        <div class="col-md-4">
            <div class="text-center position-relative">
                <a href="/kelolaTender" class="text-reset text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-mailbox2-flag" viewBox="0 0 16 16" style="color: green;">>
                        <path d="M10.5 8.5V3.707l.854-.853A.5.5 0 0 0 11.5 2.5v-2A.5.5 0 0 0 11 0H9.5a.5.5 0 0 0-.5.5v8z"/>
                        <path d="M4 3h4v1H6.646A4 4 0 0 1 8 7v6h7V7a3 3 0 0 0-3-3V3a4 4 0 0 1 4 4v6a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V7a4 4 0 0 1 4-4m.585 4.157C4.836 7.264 5 7.334 5 7a1 1 0 0 0-2 0c0 .334.164.264.415.157C3.58 7.087 3.782 7 4 7s.42.086.585.157"/>
                    </svg>
                    <span class="position-absolute top-0 end-75 translate-middle badge rounded-pill bg-danger p-3">
                        {{ $proposalmasuk }}
                        <span class="visually-hidden">unread messages</span>
                    </span>
                    <h6>Permohonan Proposal Tender</h6>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center position-relative">
                <a href="/kelolaSurat" class="text-reset text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-envelope-arrow-down-fill" viewBox="0 0 16 16" style="color: green;">
                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zm.192 8.159 6.57-4.027L8 9.586l1.239-.757.367.225A4.49 4.49 0 0 0 8 12.5c0 .526.09 1.03.256 1.5H2a2 2 0 0 1-1.808-1.144M16 4.697v4.974A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-1.965.45l-.338-.207z"/>
                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.354-1.646a.5.5 0 0 1-.722-.016l-1.149-1.25a.5.5 0 1 1 .737-.676l.28.305V11a.5.5 0 0 1 1 0v1.793l.396-.397a.5.5 0 0 1 .708.708z"/>
                    </svg>
                    <span class="position-absolute top-0 end-75 translate-middle badge rounded-pill bg-danger p-3">
                        {{ $suratmasuk }}
                        <span class="visually-hidden">unread messages</span>
                    </span>
                    <h6>Permohonan Surat</h6>
                </a>
            </div>
        </div>
    </div>
</div>
    
@endsection