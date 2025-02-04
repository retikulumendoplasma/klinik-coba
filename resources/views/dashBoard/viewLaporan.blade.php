@extends('dashBoard.dashboard')

@section('container')
<h1>Laporan Bulanan: {{ \Carbon\Carbon::create()->month($filter_bulan)->translatedFormat('F') }} {{ $filter_tahun }}</h1>
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
    <!-- Form Filter -->
    <form method="GET" action="{{ route('laporan.bulanan') }}">
        <label for="bulan">Pilih Bulan:</label>
        <select name="bulan" id="bulan">
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ $i == $filter_bulan ? 'selected' : '' }}>
                    {{ Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                </option>
            @endfor
        </select>

        <label for="tahun">Pilih Tahun:</label>
        <select name="tahun" id="tahun">
            @for ($i = now()->year - 5; $i <= now()->year + 1; $i++)
                <option value="{{ $i }}" {{ $i == $filter_tahun ? 'selected' : '' }}>
                    {{ $i }}
                </option>
            @endfor
        </select>

        <button type="submit">Tampilkan</button>
    </form>
    
  <table class="table table-striped table-bordered">
      <thead>
        <tr>
            <th>Tanggal Laporan</th>
            <th>Total Kunjungan</th>
            <th>Total Biaya Obat</th>
            <th>Total Biaya Tindakan</th>
            <th>Total Pemasukan</th>
            <th>Aksi</th> <!-- Tambahkan kolom untuk tombol -->
        </tr>
      </thead>
      <tbody>
            @forelse ($laporanBulanan as $laporan)
                <tr>
                    <td>{{ $laporan->tanggal_laporan }}</td>
                    <td>{{ $laporan->total_kunjungan }}</td>
                    <td>Rp{{ number_format($laporan->total_biaya_obat, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($laporan->total_biaya_tindakan, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($laporan->total_pemasukan, 0, ',', '.') }}</td>
                    <td>
                        <!-- Tombol untuk mengarahkan ke laporan harian -->
                        <a href="/laporanHarian/{{ $laporan->tanggal_laporan }}" class="btn btn-sm btn-primary">Lihat Laporan</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada data transaksi untuk bulan {{ $bulan }} {{ $tahun }}</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th>Total Keseluruhan</th>
                <th>{{ $totalKeseluruhan['total_kunjungan'] }}</th>
                <th>Rp{{ number_format($totalKeseluruhan['total_biaya_obat'], 0, ',', '.') }}</th>
                <th>Rp{{ number_format($totalKeseluruhan['total_biaya_tindakan'], 0, ',', '.') }}</th>
                <th>Rp{{ number_format($totalKeseluruhan['total_pemasukan'], 0, ',', '.') }}</th>
                <th></th> <!-- Kosongkan kolom aksi di footer -->
            </tr>
        </tfoot>
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
