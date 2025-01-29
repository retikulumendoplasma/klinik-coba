@extends('dashBoard.dashboard')

@section('container')
<h2>Data Laporan</h2>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
{{-- {!! $chart->cdn() !!} --}}
<!-- Alert Sukses/Error -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<!-- Tabel Data -->
<div class="table-responsive">
  <table class="table table-striped table-bordered">
      <thead>
          <tr>
              <th>No</th>
              <th>Tanggal Laporan Harian</th>
              <th>Total Kunjungan</th>
              <th>Total Tindakan</th>
              <th>Total Transaksi</th>
          </tr>
      </thead>
      <tbody>
            @forelse ($dataLaporan as $laporan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $laporan->tanggal }}</td> <!-- Tanggal -->
                    <td>{{ $laporan->total_kunjungan }}</td> <!-- Total kunjungan pasien -->
                    <td>Rp {{ number_format($laporan->total_harga_tindakan, 0, ',', '.') }}</td> <!-- Total harga tindakan -->
                    <td>Rp {{ number_format($laporan->total_transaksi, 0, ',', '.') }}</td> <!-- Total transaksi -->
                    <td>
                        <a href="/rekamMedisHarian/{{ $laporan->tanggal }}" class="btn btn-sm btn-primary">Lihat Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    
  </table>
    <div class="container px-4 mx-auto">

        <h1>Laporan Kunjungan Pasien Bulanan</h1>
        <div id="chart">
            {!! $chart->container() !!}
        </div>
        {!! $chart->script() !!}

    </div>
</div>

{{-- script agar tabel dapat di click --}}
<script>
  document.addEventListener('DOMContentLoaded', function() {
      const rows = document.querySelectorAll('tr[data-url]');
      rows.forEach(row => {
          row.addEventListener('click', function() {
              window.location.href = this.dataset.url;
          });
      });
  });
</script>
@endsection
