@extends('layouts.main')

@section('main')

<div class="container py-5">
    <div class="table-responsive col-lg-10 border mb-5">
        <div class="row">
            <div class="col-8 pb-3">
                <h4>Pengajuan surat</h4>
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
                </tr>
            </thead>
            <tbody>
                @php
                $nomordiproses = 1;
                @endphp
                @foreach ($dataSurat as $surat)
                @if ($surat->status_surat != 'Ditolak')
                <tr>
                    <td>{{ $nomordiproses++ }}</td>
                    <td>{{ $surat->jenis_surat }}</td>
                    <td>{{ $surat->nama }}</td>
                    <td>{{ $surat->nik }}</td>
                    <td>{{ $surat->status_surat }}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="table-responsive col-lg-10 border mb-5">
        <div class="row">
            <div class="col-8 pb-3">
                <h4>Pengajuan Ditolak</h4>
            </div>
        </div>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jenis Surat</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alasan Ditolak</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                $nomordiproses = 1;
                @endphp
                @foreach ($dataSurat as $surat)
                @if ($surat->status_surat == 'Ditolak')
                <tr>
                    <td>{{ $nomordiproses++ }}</td>
                    <td>{{ $surat->jenis_surat }}</td>
                    <td>{{ $surat->nama }}</td>
                    <td>{{ $surat->tolak_surat }}</td>
                    <td class="text-danger">{{ $surat->status_surat }}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
