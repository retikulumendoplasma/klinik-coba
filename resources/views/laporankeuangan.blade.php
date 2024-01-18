@extends('layouts.main')

@section('main')

<div class="container py-5">
    <div class="table-responsive col-lg-10 border mb-5">
        <div class="row">
            <div class="col-8 pb-3">
                <h4>Histori laporan keuangan desa</h4>
            </div>
        </div>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Laporan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $nomor = 1;
                @endphp
                @foreach ($dataLaporan as $laporan)
                <tr>
                    <td>{{ $nomor++ }}</td>
                    <td>{{ $laporan->jenis_laporan }} Tahun {{ $laporan->tahun_laporan }}</td>
                    <td><a href="{{ asset('storage/' . $dataLaporan->first()->file_laporan) }}">Download</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
