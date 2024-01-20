@extends('layouts.main')

@section('main')

<div class="container py-5">
  <div class="table-responsive col-lg-10 border mb-5">
      <div class="row">
          <div class="col-8 pb-3">
              <h4>Pengajuan Proposal Tender</h4>
          </div>
      </div>
      <table class="table table-striped table-sm">
          <thead>
              <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Nama Tender</th>
                  <th scope="col">Status</th>
              </tr>
          </thead>
          <tbody>
              @php
              $nomordiproses = 1;
              @endphp
              @foreach ($pengaju as $proposal)
              @if ($proposal->id_user == auth()->user()->id && $proposal->status_pengajuan != 'Ditolak')
                <tr>
                  <td>{{ $nomordiproses++ }}</td>
                  <td>{{ $proposal->nama }}</td>
                  <td>{{ $proposal->judul_tender }}</td>
                  <td>{{ $proposal->status_pengajuan }}</td>
                </tr>
              @endif
              @endforeach
          </tbody>
      </table>
  </div>

  <div class="table-responsive col-lg-10 border mb-5">
    <div class="row">
        <div class="col-8 pb-3">
            <h4>Pengajuan Proposal Tender Ditolak</h4>
        </div>
    </div>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Nama Tender</th>
                <th scope="col">Alasan Ditolak</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @php
            $nomordiproses = 1;
            @endphp
            @foreach ($pengaju as $proposal)
            @if ($proposal->id_user == auth()->user()->id && $proposal->status_pengajuan == 'Ditolak')
              <tr>
                <td>{{ $nomordiproses++ }}</td>
                <td>{{ $proposal->nama }}</td>
                <td>{{ $proposal->judul_tender }}</td>
                <td>{{ $proposal->alasan_ditolak }}</td>
                <td class="text-danger">{{ $proposal->status_pengajuan }}</td>
              </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
</div>

@endsection