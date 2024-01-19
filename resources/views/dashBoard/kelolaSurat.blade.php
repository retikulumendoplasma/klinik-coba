@extends('dashBoard.dashboard')

@section('container')
    <h2>Kelola Pengaju Surat</h2>

    <div class="table-responsive col-lg-10 mb-5">
        <div class="row">
            <div class="col-8">
                <h4>List Pengaju Surat</h4>
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
                    @if ($surat->status_surat == 'Pending')
                        <tr>
                            <td>{{ $nomordiproses++ }}</td>
                            <td>{{ $surat->jenis_surat }}</td>
                            <td>{{ $surat->nama }}</td>
                            <td>{{ $surat->nik }}</td>
                            <td>{{ $surat->status_surat }}</td>
                            <td>
                                <a href="/viewSurat/{{ $surat->id }}" class="badge bg-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                </a>
                                <form action="/terimaPengajusurat/{{ $surat->id }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="badge bg-success border-0" onclick="return confirm('Terima surat ini?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                        </svg>
                                    </button>
                                </form>

                                <!-- Form untuk reject -->
                                <form id="rejectForm{{ $surat->id }}" action="/kelolaPengajusurat/{{ $surat->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <div id="rejectInputContainer{{ $surat->id }}" class="mb-3" style="display: none;">
                                        <label for="tolak_surat" class="form-label">Pesan Penolakan</label>
                                        <textarea class="form-control" id="tolak_surat" name="tolak_surat" rows="3" required></textarea>
                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                        <button type="button" class="btn btn-secondary" onclick="hideRejectInput('{{ $surat->id }}')">Batal</button>
                                    </div>
                                    <button type="button" class="badge bg-danger border-0" onclick="showRejectInput('{{ $surat->id }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                        </svg>
                                        Tolak
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="table-responsive col-lg-10 mb-5">
        <div class="row">
            <div class="col-8">
                <h4>List Pengaju-Surat Dalam Proses</h4>
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
                                <a href="/viewSurat/{{ $surat->id }}" class="badge bg-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                </a>
                                <form action="/selesaiPengajusurat/{{ $surat->id }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="badge bg-success border-0" onclick="return confirm('Surat Selesai')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                        </svg>
                                    </button>
                                </form>

                                <!-- Form untuk reject -->
                                <form id="rejectForm{{ $surat->id }}" action="/kelolaPengajusurat/{{ $surat->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <div id="rejectInputContainer{{ $surat->id }}" class="mb-3" style="display: none;">
                                        <label for="tolak_surat" class="form-label">Pesan Penolakan</label>
                                        <textarea class="form-control" id="tolak_surat" name="tolak_surat" rows="3" required></textarea>
                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                        <button type="button" class="btn btn-secondary" onclick="hideRejectInput('{{ $surat->id }}')">Batal</button>
                                    </div>
                                    <button type="button" class="badge bg-danger border-0" onclick="showRejectInput('{{ $surat->id }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                        </svg>
                                        Tolak
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="table-responsive col-lg-10">
        <div class="row">
            <div class="col-8">
                <h4>List Pengaju Surat Selesai</h4>
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
                                <a href="/viewSurat/{{ $surat->id }}" class="badge bg-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function showRejectInput(id) {
            document.getElementById('rejectInputContainer' + id).style.display = 'block';
            document.getElementById('rejectForm' + id).getElementsByTagName('button')[3].style.display = 'block';
            document.getElementById('rejectForm' + id).getElementsByTagName('button')[4].style.display = 'none';
        }
    
        function hideRejectInput(id) {
            document.getElementById('rejectInputContainer' + id).style.display = 'none';
            document.getElementById('rejectForm' + id).getElementsByTagName('button')[3].style.display = 'none';
            document.getElementById('rejectForm' + id).getElementsByTagName('button')[4].style.display = 'block';
        }
    </script>
@endsection
