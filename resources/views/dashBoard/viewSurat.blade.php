@extends('dashBoard.dashboard')

@section('container')
<div class="row">
    <form action="/ajukansurat" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-6">
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                <input class="form-control" type="text" id="namaInput" value="{{ $data->nama }}" name="nama" aria-label="Disabled input example" disabled readonly>
            </div>
            <input type="hidden" id="tempat_lahirInput" name="tempat_lahir">
            <input type="hidden" id="tanggal_lahirInput" name="tanggal_lahir">
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tempat, tgl lahir</label>
                <input class="form-control" type="text" id="tempat_tanggal_lahirInput" value="{{ $data->tempat_lahir }}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1" class="form-label">Jenis kelamin</label>
                <input class="form-control" type="text" id="jenis_kelaminInput" value="{{ $data->jenis_kelamin }}" name="jenis_kelamin" aria-label="Disabled input example" disabled readonly>
            </div>
            {{-- <div class="form-group mb-3">
                <label for="exampleFormControlInput1" class="form-label">Foto KTP</label>
                <a href="{{ asset('storage/' . $data->foto_ktp) }}" target="_blank">Lihat foto KTP</a>
            </div> --}}
            <div class="form-group mb-3">
                <label for="formFile" class="form-label">Foto KTP</label>
                <div>
                    @if($data->foto_ktp)
                        <img src="{{ asset('storage/' . $data->foto_ktp) }}" alt="Foto KTP" style="max-width: 100%; max-height: 350px;">
                    @else
                        <p>Belum ada foto KTP.</p>
                    @endif
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="formFile" class="form-label">Foto KK</label>
                <div>
                    @if($data->foto_kk)
                        <img src="{{ asset('storage/' . $data->foto_kk) }}" alt="Foto KK" style="max-width: 100%; max-height: 350px;">
                    @else
                        <p>Belum ada foto KK.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1" class="form-label">Status perkawinan</label>
                <input class="form-control" type="text" id="status_perkawinanInput" value="{{ $data->status_perkawinan }}" name="status_perkawinan" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1" class="form-label">Agama</label>
                <input class="form-control" type="text" id="agamaInput" value="{{ $data->agama }}" name="agama" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pekerjaan</label>
                <input class="form-control" type="text" id="pekerjaanInput" value="{{ $data->pekerjaan }}" name="pekerjaan" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                <input class="form-control" type="text" id="alamatInput" value="{{ $data->alamat }}" name="alamat" aria-label="Disabled input example" disabled readonly>
            </div>
            @if ($data->foto_pendukung)
                <div class="form-group mb-3">
                <label for="formFile" class="form-label">Foto Pendukung</label>
                <div>
                    @if($data->foto_pendukung)
                        <img src="{{ asset('storage/' . $data->foto_pendukung) }}" alt="Foto Pendukung" style="max-width: 100%; max-height: 350px;">
                    @else
                        <p>Belum ada foto Pendukung.</p>
                    @endif
                </div>
            </div>
            @endif
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nomor Hp</label>
                <input class="form-control" type="text" id="nomor_hp" value="{{ $data->nomor_hp }}" name="nomor_hp" aria-label="Disabled input example" disabled readonly>
            </div>
        </div>
        <button type="submit" class="position end-0 m-2 btn btn-dark">Kirim</button>
    </form>
</div>


@endsection