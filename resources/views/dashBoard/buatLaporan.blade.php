@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Buat Laporan </h1>
            </div>
            <form action="/buatLaporan" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group pb-3">
                    <label for="tahun_laporan">Tahun</label>
                    <input type="number" class="form-control" id="tahun_laporan" name="tahun_laporan" required placeholder="Silahkan Masukkan Tahun Laporan" min="1900" max="2100">
                </div>
                <div class="form-group pb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jenis Laporan</label>
                    <select class="form-select" name='jenis_laporan' aria-label="Default select example">
                        <option value="1">Rencana Anggaran</option>
                        <option value="2">Laporan Keuangan</option>
                    </select>
                </div>
                <div class="form-group pb-3">
                    <label for="file_proposal">File Laporan</label>
                    <input type="file" class="form-control" id="file_laporan" name="file_laporan" accept=".pdf,.docx" required>
                </div>
                <button type="submit" class="btn btn-success text-white btn-block mb-3" >Buat</button>
            </form>
        </div>
    </div>
</div>
@endsection