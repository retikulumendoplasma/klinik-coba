@extends('layouts.main')

@section('main')

<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Pengajuan Tender</h1>
            </div>
            <form action="/tender" method="post">
                <div class="form-group pb-3">
                    <label for="formFile" class="form-label">Upload Foto KTP</label>
                    <p>*wajib diisi</p>
                    <input class="form-control" type="file" id="formFile">
                </div>
                <div class="form-group pb-3">
                    <label for="formFile" class="form-label">Upload File Tender</label>
                    <p>*wajib diisi</p>
                    <input class="form-control" type="file" id="formFile">
                </div>
                <div class="form-group pb-3">
                    <label for="formFile" class="form-label">Upload Vidio Presentasi</label>
                    <p>**tidak wajib diisi</p>
                    <input class="form-control" type="file" id="formFile">
                </div>
                <button type="submit" class="btn btn-dark text-white btn-block mb-3" >Ajukan</button>
            </form>
        </div>
    </div>
</div>
    
@endsection