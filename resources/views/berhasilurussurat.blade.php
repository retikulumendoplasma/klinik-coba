@extends('layouts.main')

@section('main')

<div class="container py-5">
    <div class="card text-center">
        <div class="card-header">
          Status Pengajuan Proposal
        </div>
        <div class="card-body">
          <h5 class="card-title">Status : {{ $datasurat->status_surat }}</h5>
          <p class="card-text">Berhasil mengurus pembuatan surat, surat anda sedang diproses oleh kami.</p>
          <p>Terimakasih</p>
          <a href="#" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-footer text-muted">
          2 days ago
        </div>
      </div>
</div>

@endsection