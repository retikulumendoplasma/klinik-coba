@extends('dashBoard.dashboard')

@section('container')
<h2>Data Keuangan Desa</h2>
<div class="mt-5">
    <button type="submit" onclick="window.location.href='/buatLaporan'" class="nav-link px-3 bg-success border-0 text-white"><span data-feather="plus"></span>Tambah Data</button>
</div>
<div class="table-responsive col-lg-8 mb-5">
    <div class="row">
        <div class="col-8">
            <h4>List Rencana Anggaran</h4>
        </div>
    </div>
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Tahun Laporan</th>
        <th scope="col">Jenis Laporan</th>
        <th class="text-center" scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($dataLaporan as $laporan)
        @if ($laporan->jenis_laporan == 'Rencana Anggaran')
          <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $laporan->tahun_laporan }}</td>
              <td>{{ $laporan->jenis_laporan }}</td>
              <td>
                  <a href="/dataKeuangan/{{ $laporan->id }}/editKeuangan" class="badge bg-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                  </a>

                  <!-- Form untuk delete -->
                  <form action="/dataKeuangan/{{ $laporan->id }}" method="post" class="d-inline" >
                      @csrf
                      @method('DELETE')
                      <button class="badge bg-danger border-0" onclick="return confirm('Yakin Hapus Data?')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                          <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                        </svg>
                      </button>
                  </form>
              </td>
          </tr>
        @endif
      @endforeach
    </tbody>
  </table>
</div>

<div class="table-responsive col-lg-8 mb-5">
    <div class="row">
        <div class="col-8">
            <h4>List Laporan Keuangan</h4>
        </div>
    </div>
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Tahun Laporan</th>
        <th scope="col">Jenis Laporan</th>
        <th class="text-center" scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($dataLaporan as $laporan)
        @if ($laporan->jenis_laporan == 'Laporan Keuangan')
          <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $laporan->tahun_laporan }}</td>
              <td>{{ $laporan->jenis_laporan }}</td>
              <td>
                  <a href="/dataKeuangan/{{ $laporan->id }}/editKeuangan" class="badge bg-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                  </a>

                  <!-- Form untuk delete -->
                  <form action="/dataKeuangan/{{ $laporan->id }}" method="post" class="d-inline" >
                      @csrf
                      @method('DELETE')
                      <button class="badge bg-danger border-0" onclick="return confirm('are you sure')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                          <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                        </svg>
                      </button>
                  </form>
              </td>
          </tr>
        @endif
      @endforeach
    </tbody>
  </table>
</div>
@endsection


{{-- memisahkan pengaju yang diterima dan pending, hari ini menampilkan pengaju ke halaman voting tender, total pengaju yang sudah diterima, memperbaiki halaman keuangan desa menampilkan pdf dan berpindah tampilan, saran dan masukan di ubah sedikit, lanjut ke halaman keuangan admin untuk menambah file sesuai dengan jenis laporannya, buat halaman buat laporan --}}