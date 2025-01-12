@extends('dashBoard.dashboard')

@section('container')
  <div class="container">
    <div class="row pb-5">
        <h2>Surat Diajukan</h2>
        <div class="col-6">
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                <input class="form-control" type="text" id="namaInput" value="{{ $data->penduduk->nama }}" name="nama" aria-label="Disabled input example" disabled readonly>
            </div>
            <input type="hidden" id="tempat_lahirInput" name="tempat_lahir">
            <input type="hidden" id="tanggal_lahirInput" name="tanggal_lahir">
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tempat, tgl lahir</label>
                <input class="form-control" type="text" id="tempat_tanggal_lahirInput" value="{{ $data->penduduk->tempat_lahir }}" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1" class="form-label">Jenis kelamin</label>
                <input class="form-control" type="text" id="jenis_kelaminInput" value="{{ $data->penduduk->jenis_kelamin }}" name="jenis_kelamin" aria-label="Disabled input example" disabled readonly>
            </div>
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
                <input class="form-control" type="text" id="status_perkawinanInput" value="{{ $data->penduduk->status_perkawinan }}" name="status_perkawinan" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1" class="form-label">Agama</label>
                <input class="form-control" type="text" id="agamaInput" value="{{ $data->penduduk->agama }}" name="agama" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pekerjaan</label>
                <input class="form-control" type="text" id="pekerjaanInput" value="{{ $data->penduduk->pekerjaan }}" name="pekerjaan" aria-label="Disabled input example" disabled readonly>
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                <input class="form-control" type="text" id="alamatInput" value="{{ $data->penduduk->alamat }}" name="alamat" aria-label="Disabled input example" disabled readonly>
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
    </div>
    <a href="/kelolaSurat" class="badge btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
        </svg>
         Kembali
    </a>
    @if($data->status_surat == 'Proses')
        <form action="/kelolaPengajusurat/{{ $data->id }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="badge bg-success border-0" onclick="return confirm('Terima surat ini?')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
                Proses
            </button>
        </form>
    @endif
  </div>
@endsection