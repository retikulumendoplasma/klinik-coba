@extends('layouts.main')

@section('main')

<div class="container mb-5">
    <div class="row">
        <div class="col-12 col-md-4">
            <h5 class="text-center mb-3">Histori Rencana Anggaran Desa</h5>
            <div class="list-group">
                @foreach ($dataLaporan as $laporan)
                    @if ($laporan->jenis_laporan == 'Rencana Anggaran')
                        <a href="{{ asset('storage/' . $laporan->file_laporan) }}" target="_blank">{{ $laporan->file_laporan }}</a>
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
                                <iframe id="pdf-viewer" src="{{ asset('storage/' . $laporan->file_laporan) }}" frameborder="0" width="100%" height="600px"></iframe>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const listGroupItems = document.querySelectorAll('.list-group a');

        listGroupItems.forEach(item => {
            item.addEventListener('click', function (event) {
                event.preventDefault();
                const pdfViewer = document.getElementById('pdf-viewer');
                pdfViewer.src = this.getAttribute('href');
            });
        });
    });
</script>

@endsection