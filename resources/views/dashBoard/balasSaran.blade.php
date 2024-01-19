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
                        <form action="/balasSaran/{{ $saranmasukan->id }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="isi_balasan" class="form-label">Balas saran dan masukan</label>
                                <input type="hidden" name="tanggal_balasan" value="{{ now() }}">
                                {{-- <input type="hidden" name="id_user" value="{{ $saranmasukan->id_user }}">
                                <input type="hidden" name="isi_saran" value="{{ $saranmasukan->isi_saran }}">
                                <input type="hidden" name="tanggal_saran_masuk" value="{{ $saranmasukan->tanggal_saran_masuk }}"> --}}
                                <input type="text" class="form-control" id="isi_balasan" name="isi_balasan"  required>
                            </div>  
                            <button type="submit" class="btn btn-success">Balas</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection