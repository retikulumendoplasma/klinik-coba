@extends('layouts.main')

@section('main')

<div class="container mb-5">
    <div class="row">
        <div class="col-12 col-md-4">
            <h5 class="text-center mb-3">Histori Rencana Anggaran Desa</h5>
            <div class="list-group">
                @foreach ($dataLaporan as $laporan)
                    @if ($laporan->jenis_laporan == 'Rencana Anggaran')
                        <a href="#" class="list-group-item list-group-item-action"
                        data-pdf-url="{{ url($laporan->file_laporan) }}">
                        {{ $laporan->tahun_laporan }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-success text-white text-center">PDF Viewer</div>
                            <div class="card-body">
                                <iframe id="pdf-viewer" src="" width="100%" height="600px"></iframe>
                            </div>
                            <div class="card-footer text-center">
                                <a class="btn btn-success" href="#" download>Download PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
