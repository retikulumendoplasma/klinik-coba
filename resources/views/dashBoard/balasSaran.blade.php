@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">Live Chat</div>
                  <div class="card">
                        <h6 style="font-weight: bold;" class="card-header" >*user</h6>
                        <div class="card-body">
                        <h5 class="card-title">{{ $saranmasukan->isi_saran }}</h5>
                        <small class="text-body-secondary">{{ $saranmasukan->tanggal_saran_masuk }}</small>
                        <hr class="dropdown-divider">
                        @if ($saranmasukan->isi_balasan)
                            <div class="align-items: flex-end;">
                                <h6 style="color: rgb(0, 110, 255); font-weight: bold;">*admin</h6>
                                <h5 class="card-title">{{ $saranmasukan->isi_balasan }}</h5>
                                <small class="text-body-secondary">{{ $saranmasukan->tanggal_balasan }}</small>
                            </div>
                        @endif
                        </div>
                        @if ($saranmasukan->isi_balasan)
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" collapsed>
                                            Edit balasan
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <form action="/editbalasan/{{ $saranmasukan->id }}" method="post" enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="mb-3">
                                                <label for="isi_balasan" class="form-label">Edit balasan</label>
                                                <input type="hidden" name="tanggal_balasan" value="{{ now() }}">
                                                <input type="text" class="form-control" id="isi_balasan" name="isi_balasan" value="{{ old('isi_balasan', $saranmasukan->isi_balasan) }}"  required>
                                            </div>  
                                            <button type="submit" class="btn btn-success">Edit Balasan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        @else
                        <div class="card-body">
                            <form action="/balasSaran/{{ $saranmasukan->id }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="isi_balasan" class="form-label">Balas saran dan masukan</label>
                                    <input type="hidden" name="tanggal_balasan" value="{{ now() }}">
                                    <input type="text" class="form-control" id="isi_balasan" name="isi_balasan"  required>
                                </div>  
                                <button type="submit" class="btn btn-success">Balas</button>
                            </form>
                        </div>
                        @endif
                        
                    </div>
            </div>
        </div>
    </div>
    <a href="/saranMasukanAdmin" class="badge btn-success mt-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
        </svg>
         Kembali
    </a>
</div>
@endsection