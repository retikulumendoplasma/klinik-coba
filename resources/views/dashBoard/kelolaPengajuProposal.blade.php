@extends('dashBoard.dashboard')

@section('container')
    <h2>Kelola Pengaju Proposal Tender</h2>

    <div class="table-responsive col-lg-8 mb-5">
        <div class="row">
            <div class="col-8">
                <h4>List Pengaju Tender - Pending</h4>
            </div>
        </div>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Pengaju</th>
                  <th scope="col">Status Pengajuan</th>
                  <th class="text-center" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuProposal as $proposal)
                    @if ($proposal->status_pengajuan == 'pending')
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $proposal->nama }}</td>
                            <td>{{ $proposal->status_pengajuan }}</td>
                            <td>
                                <a href="/viewProposal/{{ $proposal->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
                                <form action="/kelolaPengajuProposal/{{ $proposal->id }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="badge bg-success" onclick="return confirm('Terima Proposal ini?')"><span data-feather="check-circle"></span></button>
                                </form>
                                <!-- Form untuk delete -->
                                <form action="/kelolaPengajuProposal/{{ $proposal->id }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="badge bg-danger" onclick="return confirm('Tolak Permohonan ini?')"><span data-feather="x-circle"></span></button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="table-responsive col-lg-8">
        <div class="row">
            <div class="col-8">
                <h4>List Pengaju Tender Diterima</h4>
            </div>
        </div>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Pengaju</th>
                  <th scope="col">Status Pengajuan</th>
                  <th class="text-center" scope="col">Action</th>
                  <th scope="col">Total Voting</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuProposal as $proposal)
                    @if ($proposal->status_pengajuan == 'diterima')
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $proposal->nama }}</td>
                            <td>{{ $proposal->status_pengajuan }}</td>
                            <td>
                                <a href="/viewProposal/{{ $proposal->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
                                <!-- Form untuk delete -->
                                <form action="/kelolaPengajuProposal/{{ $proposal->id }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="badge bg-danger" onclick="return confirm('Tolak Permohonan ini?')"><span data-feather="x-circle"></span></button>
                                </form>
                            </td>
                            <td>
                                <?php
                                // Hitung total voting untuk setiap proposal
                                $totalVoting = \App\Models\voting_tender::where('proposal_id', $proposal->id)->count();
                                echo $totalVoting;
                                ?>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
