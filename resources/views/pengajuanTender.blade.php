@extends('layouts.main')

@section('main')

<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Form Upload Pengajuan Tender</div>

                <div class="card-body">
                    <form method="post" action="/pengajuanTender" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id_tender" value="{{ $tender->id }}">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="foto_ktp">Foto KTP</label>
                            <input type="file" class="form-control" id="foto_ktp" name="foto_ktp" accept="image/*" required>
                        </div>

                        <div class="form-group">
                            <label for="file_proposal">File Proposal</label>
                            <input type="file" class="form-control" id="file_proposal" name="file_proposal" accept=".pdf,.docx" required>
                        </div>

                        <div class="form-group">
                            <label for="link_vidio">Link Vidio</label>
                            <input type="text" class="form-control" id="link_vidio" name="link_vidio" required>
                        </div>

                        <div class="form-group">
                            <label for="foto_pengaju">Foto Pengaju</label>
                            <input type="file" class="form-control" id="foto_pengaju" name="foto_pengaju" accept="image/*" required>
                        </div>

                        <button type="submit" class="btn btn-dark">Ajukan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection