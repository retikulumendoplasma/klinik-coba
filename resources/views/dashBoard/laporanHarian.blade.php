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
    <h1>Laporan Harian Tanggal: {{ $tanggal }}</h1>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Rekam Medis</th>
                <th>Nama Pasien</th>
                <th>Total Biaya Obat</th>
                <th>Total Biaya Tindakan</th>
                <th>Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
              @forelse ($dataTransaksi as $laporan)
                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $laporan->nomor_rekam_medis }}</td> <!-- Tanggal -->
                      <td>{{ $laporan->nama_pasien }}</td> <!-- Total kunjungan pasien -->
                      <td>Rp {{ number_format($laporan->total_biaya_obat, 0, ',', '.') }}</td> <!-- Total biaya tindakan -->
                      <td>Rp {{ number_format($laporan->total_biaya_tindakan, 0, ',', '.') }}</td> <!-- Total biaya tindakan -->
                      <td>Rp {{ number_format($laporan->grand_total, 0, ',', '.') }}</td> <!-- Total transaksi -->
                  </tr>
              @empty
                  <tr>
                    <td colspan="6">Tidak ada data transaksi pada tanggal {{ $tanggal }}</td>
                  </tr>
              @endforelse
          </tbody>
          <tfoot>
            <tr>
                <th colspan="5">Grand Total (Omset Satu Hari)</th>
                <th>Rp{{ number_format($grandTotal, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
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

<script>
    document.getElementById('filter-type').addEventListener('change', function () {
        const filterType = this.value;

        // Input elements
        const filterDate = document.getElementById('filter-date'); // Input tunggal
        const startDate = document.getElementById('filter-start-date'); // Tanggal mulai
        const endDate = document.getElementById('filter-end-date'); // Tanggal selesai

        if (filterType === 'range') {
            // Sembunyikan input tanggal tunggal
            filterDate.style.display = 'none';

            // Tampilkan input range tanggal
            startDate.style.display = 'inline-block';
            endDate.style.display = 'inline-block';
        } else {
            // Tampilkan input tanggal tunggal
            filterDate.style.display = 'inline-block';

            // Sembunyikan input range tanggal
            startDate.style.display = 'none';
            endDate.style.display = 'none';
        }
    });

    document.getElementById('apply-filter').addEventListener('click', function () {
        const filterType = document.getElementById('filter-type').value;
        const filterDate = document.getElementById('filter-date').value;
        const startDate = document.getElementById('filter-start-date').value;
        const endDate = document.getElementById('filter-end-date').value;

        let url = `/laporan?filter_type=${filterType}`;
        if (filterType === 'range') {
            url += `&filter_start_date=${startDate}&filter_end_date=${endDate}`;
        } else {
            url += `&filter_date=${filterDate}`;
        }

        window.location.href = url;
    });


</script>
@endsection
