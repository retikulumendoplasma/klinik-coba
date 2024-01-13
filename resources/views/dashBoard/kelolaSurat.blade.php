@extends('dashBoard.dashboard')

@section('container')
    <h2>Kelola Pengaju Surat</h2>

    <div class="table-responsive col-lg-8 mb-5">
        <div class="row">
            <div class="col-8">
                <h4>List Pengaju Surat - Dalam Proses</h4>
            </div>
        </div>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Jenis Surat</th>
                  <th scope="col">Nama</th>
                  <th scope="col">NIK</th>
                  <th scope="col">Status</th>
                  <th class="text-center" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
              @php
                    $nomordiproses = 1;
                @endphp
                @foreach ($dataSurat as $surat)
                    @if ($surat->status_surat == 'Proses')
                        <tr>
                            <td>{{ $nomordiproses++ }}</td>
                            <td>{{ $surat->jenis_surat }}</td>
                            <td>{{ $surat->nama }}</td>
                            <td>{{ $surat->nik }}</td>
                            <td>{{ $surat->status_surat }}</td>
                            <td>
                                <a href="/viewsurat/{{ $surat->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
                                <form action="/kelolaPengajusurat/{{ $surat->id }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="badge bg-success" onclick="return confirm('Terima surat ini?')"><span data-feather="check-circle"></span></button>
                                </form>
                                <!-- Form untuk delete -->
                                <form action="/kelolaPengajusurat/{{ $surat->id }}" method="post" class="d-inline">
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
                <h4>List Pengaju Surat Diterima</h4>
            </div>
        </div>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Jenis Surat</th>
                  <th scope="col">Nama</th>
                  <th scope="col">NIK</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
              @php
                    $nomorditerima = 1;
                @endphp
                @foreach ($dataSurat as $surat)
                    @if ($surat->status_surat == 'Selesai')
                        <tr>
                            <td>{{ $nomorditerima++ }}</td>
                            <td>{{ $surat->jenis_surat }}</td>
                            <td>{{ $surat->nama }}</td>
                            <td>{{ $surat->nik }}</td>
                            <td>{{ $surat->status_surat }}</td>
                            <td>
                                <a href="/viewsurat/{{ $surat->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
                                <!-- Form untuk delete -->
                                <form action="/kelolaPengajusurat/{{ $surat->id }}" method="post" class="d-inline">
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
@endsection
