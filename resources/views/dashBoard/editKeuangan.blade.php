@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Edit Laporan </h1>
            </div>
            <form action="/buatLaporan/{{ $laporan->id }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group pb-3">
                    <label for="tahun_laporan">Tahun</label>
                    <input type="number" class="form-control" id="tahun_laporan" name="tahun_laporan" required placeholder="Silahkan Masukkan Judul" min="1900" max="2100" value="{{ old('tahun_laporan', $laporan->tahun_laporan) }}">
                </div>
                <div class="form-group pb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jenis Laporan</label>
                    <select class="form-select" name='jenis_laporan' aria-label="Default select example">
                        <option value="1">Rencana Anggaran</option>
                        <option value="2">Laporan Keuangan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="img" class="form-label">File</label>
                    <input type="file" class="form-control" id="file_laporan" name="file_laporan" accept=".pdf,.docx" value="{{ old('file_laporan', $laporan->file_laporan) }}">
                </div>
                <a href="/dataKeuangan" class="badge btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                    </svg>
                     Kembali
                </a>
                <button type="submit" class="badge btn-success border-0" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                     Edit
                </button>
            </form>
        </div>
    </div>
</div>
@endsection