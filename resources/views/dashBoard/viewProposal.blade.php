@extends('dashBoard.dashboard')

@section('container')
    <h2 class="text-center">Detail Pengaju Proposal Tender</h2>

    <div class="container text-center pb-5 border border-dark my-5">
        <img src="{{ $dataProposal->foto_ktp }}" alt="Your Image" class="rounded-circle mx-auto p-3" height="250" width="250">
        <h2 class="head-text">{{ $dataProposal->nama }}</h2>
    
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-success text-white">Proposal</div>
                        <div class="card-body">
                            <embed id="pdf-viewer" src="{{ $dataProposal->file_proposal }}" type="application/pdf" width="100%" height="600px">
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-success" href="path/to/your/file.pdf" download>Download PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="container mt-5 pb-5">
            <h2 class="head-text pb-3">Vidio presentasi</h2>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{ $dataProposal->link_vidio }}" allowfullscreen></iframe>
            </div>
        </div>

        {{-- Tabel vote --}}
        <div class="table-responsive mx-auto">
                <h2>List Vote</h2>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Tender</th>
                      <th scope="col">Tanggal Vote</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataVote as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->penduduk->nama }}</td>
                            <td>{{ $data->tender->judul_tender }}</td>
                            <td>{{ $data->tanggal_vote }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection

