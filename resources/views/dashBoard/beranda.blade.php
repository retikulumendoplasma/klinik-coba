@extends('dashBoard.dashboard')

@section('container')

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Selamat datang, {{ auth()->user()->username }}</h1>
    </div>

    <div class="row p-5">
    
        <div class="col-md-4 py-3">
            <div class="text-center position-relative py-2">
                <a href="/dataPasien" class="text-reset text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-file-earmark-person" viewBox="0 0 16 16" style="color: green;">
                        <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5z"/>
                    </svg>
                    {{-- @if ($proposalmasuk)
                    <span class="position-absolute top-0 end-75 translate-middle badge rounded-pill bg-danger p-3">
                        {{ $proposalmasuk }}
                        <span class="visually-hidden">unread messages</span>
                    </span>
                    @endif --}}
                    <h6 style="margin-top: 10px;">Data Pasien</h6>
                </a>
            </div>
        </div>
        
        <div class="col-md-4 py-3">
            <div class="text-center position-relative py-2">
                <a href="/viewAntrian" class="text-reset text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-journal-medical" viewBox="0 0 16 16" style="color: green;">
                        <path d="M10 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                        <path d="M2 1a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zM1 3a1 1 0 0 1 1-1h2v2H1zm4 10V2h9a1 1 0 0 1 1 1v9c0 .285-.12.543-.31.725C14.15 11.494 12.822 10 10 10c-3.037 0-4.345 1.73-4.798 3zm-4-2h3v2H2a1 1 0 0 1-1-1zm3-1H1V8h3zm0-3H1V5h3z"/>
                      </svg>
                    {{-- @if ($proposalmasuk)
                    <span class="position-absolute top-0 end-75 translate-middle badge rounded-pill bg-danger p-3">
                        {{ $proposalmasuk }}
                        <span class="visually-hidden">unread messages</span>
                    </span>
                    @endif --}}
                    <h6 style="margin-top: 10px;">Antrian</h6>
                </a>
            </div>
        </div>
        
        @can('admin')
        <div class="col-md-4 py-3">
            <div class="text-center position-relative py-2">
                <a href="/rekamMedis" class="text-reset text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-journal-medical" viewBox="0 0 16 16" style="color: green;">
                        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v.634l.549-.317a.5.5 0 1 1 .5.866L9 6l.549.317a.5.5 0 1 1-.5.866L8.5 6.866V7.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L7 6l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V4.5A.5.5 0 0 1 8 4M5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                      </svg>
                    {{-- @if ($suratmasuk)
                        <span class="position-absolute top-0 end-75 translate-middle badge rounded-pill bg-danger p-3">
                            {{ $suratmasuk }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    @endif --}}
                    
                    <h6 style="margin-top: 10px;">Rekam Medis</h6>
                </a>
            </div>
        </div>
        <div class="col-md-4 py-3">
            <div class="text-center position-relative py-2">
                <a href="/kelolaDokter" class="text-reset text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16" style="color: green;">
                        <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5"/>
                        <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z"/>
                      </svg>
                    {{-- @if ($saranmasukan)
                        <span class="position-absolute top-0 end-75 translate-middle badge rounded-pill bg-danger p-3">
                            {{ $saranmasukan }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    @endif --}}
                    
                    <h6 style="margin-top: 10px;">Data Dokter / Perawat</h6>
                </a>
            </div>
        </div>
        <div class="col-md-4 py-3">
            <div class="text-center position-relative py-2">
                <a href="/dataObat" class="text-reset text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-capsule" viewBox="0 0 16 16" style="color: green;">
                        <path d="M1.828 8.9 8.9 1.827a4 4 0 1 1 5.657 5.657l-7.07 7.071A4 4 0 1 1 1.827 8.9Zm9.128.771 2.893-2.893a3 3 0 1 0-4.243-4.242L6.713 5.429z"/>
                      </svg>
                    {{-- @if ($saranmasukan)
                        <span class="position-absolute top-0 end-75 translate-middle badge rounded-pill bg-danger p-3">
                            {{ $saranmasukan }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    @endif --}}
                    
                    <h6 style="margin-top: 10px;">Data Obat</h6>
                </a>
            </div>
        </div>

        @endcan

        <div class="col-md-4 py-3">
            <div class="text-center position-relative py-2">
                <a href="/resep" class="text-reset text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-prescription" viewBox="0 0 16 16" style="color: green;">
                        <path d="M5.5 6a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 1 0V9h.293l2 2-1.147 1.146a.5.5 0 0 0 .708.708L9 11.707l1.146 1.147a.5.5 0 0 0 .708-.708L9.707 11l1.147-1.146a.5.5 0 0 0-.708-.708L9 10.293 7.695 8.987A1.5 1.5 0 0 0 7.5 6zM6 7h1.5a.5.5 0 0 1 0 1H6z"/>
                        <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v10.5a1.5 1.5 0 0 1-1.5 1.5h-7A1.5 1.5 0 0 1 3 14.5V4a1 1 0 0 1-1-1zm2 3v10.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V4zM3 3h10V1H3z"/>
                      </svg>
                    {{-- @if ($saranmasukan)
                        <span class="position-absolute top-0 end-75 translate-middle badge rounded-pill bg-danger p-3">
                            {{ $saranmasukan }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    @endif --}}
                    
                    <h6 style="margin-top: 10px;">Resep Obat</h6>
                </a>
            </div>
        </div>

        @can('admin')

        <div class="col-md-4 py-3">
            <div class="text-center position-relative py-2">
                <a href="/viewTindakan" class="text-reset text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-prescription" viewBox="0 0 16 16" style="color: green;">
                        <path fill-rule="evenodd" d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7"/>
                        <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                        <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                      </svg>
                    {{-- @if ($saranmasukan)
                        <span class="position-absolute top-0 end-75 translate-middle badge rounded-pill bg-danger p-3">
                            {{ $saranmasukan }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    @endif --}}
                    
                    <h6 style="margin-top: 10px;">Tindakan</h6>
                </a>
            </div>
        </div>

        @endcan

        <div class="col-md-4 py-3">
            <div class="text-center position-relative py-2">
                <a href="/viewTransaksi" class="text-reset text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16" style="color: green;">
                        <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z"/>
                        <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
                      </svg>
                    {{-- @if ($saranmasukan)
                        <span class="position-absolute top-0 end-75 translate-middle badge rounded-pill bg-danger p-3">
                            {{ $saranmasukan }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    @endif --}}
                    
                    <h6 style="margin-top: 10px;">Transaksi</h6>
                </a>
            </div>
        </div>
        
        <div class="col-md-4 py-3">
            <div class="text-center position-relative py-2">
                <a href="/viewLaporan" class="text-reset text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16" style="color: green;">
                        <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5M11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"/>
                        <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118z"/>
                    </svg>
                    {{-- @if ($saranmasukan)
                        <span class="position-absolute top-0 end-75 translate-middle badge rounded-pill bg-danger p-3">
                            {{ $saranmasukan }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    @endif --}}
                    
                    <h6 style="margin-top: 10px;">Laporan</h6>
                </a>
            </div>
        </div>

    </div>
</div>
    
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('dashboard.js') }}"></script>
@endpush