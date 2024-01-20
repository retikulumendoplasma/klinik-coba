@extends('dashBoard.dashboard')

@section('container')
    <h2 class="text-center">Detail Pengaju Proposal Tender</h2>

    <div class="container text-center pb-5 border border-dark my-5">
        <img src="{{ asset('storage/' . $dataProposal->foto_pengaju) }}" alt="Your Image" style="max-width: 100%; max-height: 300px;">
        <h2 class="head-text">{{ $dataProposal->nama }}</h2>
    
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Proposal</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $nomor = 1;
                                @endphp
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>File proposal pengaju</td>
                                    <td><a href="{{ asset('storage/' . $dataProposal->first()->file_proposal) }}">Download</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if ($dataProposal->link_vidio)
            <div class="container mt-5 pb-5">
                <h2 class="head-text pb-3">Vidio presentasi</h2>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{ $dataProposal->link_vidio }}" allowfullscreen></iframe>
                </div>
            </div>
        @endif
    

        @if ($dataProposal->status_pengajuan == 'Diterima')
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
        @endif
        
    </div>
    
@endsection

