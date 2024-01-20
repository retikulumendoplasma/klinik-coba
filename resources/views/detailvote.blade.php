@extends('layouts.main')

@section('main')

<div class="container text-center pb-5 border border-dark my-5">
    <img src="{{ asset('storage/' . $dataProposal->foto_pengaju  ) }}" alt="Your Image" class="rounded-circle mx-auto p-3" height="250" width="250">
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
        <div class="container mt-5">
            <h2 class="head-text pb-3">Video presentasi</h2>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{ $dataProposal->link_vidio }}" allowfullscreen></iframe>
            </div>
        </div>
    @endif
    
</div>

@endsection