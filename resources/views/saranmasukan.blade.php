@extends('layouts.main')

@section('main')
<div class="container m-5 mx-auto">
    <div class="row justify-content-center"> <!-- Menggunakan justify-content-center untuk centering -->
        <h2 class="pb-3">Silahkan masukkan saran atau masukan yang membangun untuk desa kita bersama Jatirejo</h2>
        <div class="col-lg-7 overflow-auto" style="max-height: 500px;"> <!-- Menambahkan overflow-auto dan max-height -->
            <div class="card">
                <div class="card-header bg-success text-white">Saran dan Masukan</div>
                @foreach ($saranmasukan as $saran)
                    <div class="card mb-3">
                        <h6 style="font-weight: bold;" class="card-header" >*user</h6>
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
                    </div>  
                @endforeach
            </div>
        </div>
        <div class="col-lg-5"> <!-- Menghapus mx-auto -->
            <div class="input-group mb-3">
                <form action="/berisaran" method="post">
                    @csrf
                    <h4>Silahkan masukkan saran dan masukan</h4>
                    <div class="form-group pb-3">
                        <input type="hidden" name="tanggal_saran_masuk" value="{{ now() }}">
                        <input type="text" class="form-control" id="isi_saran" name="isi_saran" required placeholder="Silahkan masukkan saran atau masukan" style="width: 500;">
                    </div>
                    <button type="submit" class="btn btn-success" >Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
