@extends('layouts.main')

@section('main')

<div class="container py-5">
    <div class="card text-center">
        <div class="card-header">
          Status Pengajuan Proposal
        </div>
        <div class="card-body">
          <h5 class="card-title">Status : {{ $dataProposal->status_pengajuan }}</h5>
          <p class="card-text">Berhasil mengirim proposal, proposal anda sedang dalam pengecekan oleh kami.</p>
          <p>Terimakasih</p>
          <a href="#" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-footer text-muted">
          2 days ago
        </div>
      </div>
</div>

@endsection