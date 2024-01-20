@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card" style="max-height: 800px; overflow-y: auto;">
                <div class="card-header bg-success text-white">Live Chat</div>
                @foreach ($saranmasukan as $saran)
                    <div class="card">
                        <a href="/balasSaran/{{ $saran->id }}/balas" style="text-decoration: none; color: black;">
                            <h6 style="font-weight: bold;" class="card-header">*user</h6>
                            <div class="card-body">
                                <h5 class="card-title">{{ $saran->isi_saran }}</h5>
                                <small class="text-body-secondary">{{ $saran->tanggal_saran_masuk }}</small>
                                <hr class="dropdown-divider">
                                @if ($saran->isi_balasan)
                                    <div class="align-items: flex-end;">
                                        <h6 style="color: rgb(0, 110, 255); font-weight: bold;">*admin</h6>
                                        <h5 class="card-title">{{ $saran->isi_balasan }}</h5>
                                        <small class="text-body-secondary">{{ $saran->tanggal_balasan }}</small>
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>  
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection