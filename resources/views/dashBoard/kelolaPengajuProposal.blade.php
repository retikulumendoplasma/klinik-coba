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
            <!-- ... (header) ... -->
            <tbody>
                @foreach ($pengajuProposal as $proposal)
                    @if ($proposal->status_pengajuan == 'pending')
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $proposal->nama }}</td>
                            <td>{{ $proposal->status_pengajuan }}</td>
                            <td>
                                <a href="#" class="badge bg-info"><span data-feather="eye"></span></a>
                                <form action="/kelolaPengajuProposal/{{ $proposal->id }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="badge bg-success" onclick="return confirm('Terima Proposal ini?')"><span data-feather="check-circle"></span></button>
                                </form>
                                <!-- Form untuk delete -->
                                <form action="#" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="badge bg-danger" onclick="return confirm('are you sure')"><span data-feather="x-circle"></span></button>
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
            <!-- ... (header) ... -->
            <tbody>
                @foreach ($pengajuProposal as $proposal)
                    @if ($proposal->status_pengajuan == 'diterima')
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $proposal->nama }}</td>
                            <td>{{ $proposal->status_pengajuan }}</td>
                            <td>
                                <a href="#" class="badge bg-info"><span data-feather="eye"></span></a>
                                <!-- Form untuk delete -->
                                <form action="#" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="badge bg-danger" onclick="return confirm('are you sure')"><span data-feather="x-circle"></span></button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
