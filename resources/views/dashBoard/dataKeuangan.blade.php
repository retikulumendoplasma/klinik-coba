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
                  <a href="#" class="badge bg-info"><span data-feather="eye"></span></a>
                  <a href="#" class="badge bg-warning"><span data-feather="edit"></span></a>

                  <!-- Form untuk delete -->
                  <form action="#" method="post" class="d-inline" >
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
                  <a href="#" class="badge bg-info"><span data-feather="eye"></span></a>
                  <a href="#" class="badge bg-warning"><span data-feather="edit"></span></a>

                  <!-- Form untuk delete -->
                  <form action="#" method="post" class="d-inline" >
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


{{-- memisahkan pengaju yang diterima dan pending, hari ini menampilkan pengaju ke halaman voting tender, total pengaju yang sudah diterima, memperbaiki halaman keuangan desa menampilkan pdf dan berpindah tampilan, saran dan masukan di ubah sedikit, lanjut ke halaman keuangan admin untuk menambah file sesuai dengan jenis laporannya, buat halaman buat laporan --}}